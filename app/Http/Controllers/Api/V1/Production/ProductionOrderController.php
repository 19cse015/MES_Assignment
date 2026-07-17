<?php

namespace App\Http\Controllers\Api\V1\Production;

use App\Enums\BomStatusEnum;
use App\Enums\ProductionOrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Bom;
use App\Models\InventoryTransaction;
use App\Models\ProductionAssignment;
use App\Models\ProductionOrder;
use App\Models\RawMaterialInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],

        ]);

        $Bom = Bom::query()->where('product_id', '=', $request->product_id)
            ->where('status', BomStatusEnum::APPROVED)->latest('version')->first();
        if (! $Bom) {
            return response()->json([
                'message' => 'No approved BOM found for this product.'
            ], 422);
        }

        ProductionOrder::insert([
            "order_number" => "PO" . now()->format("YmdHis"),
            "product_id" => $request->product_id,
            "bom_id" => $Bom->id,
            "created_by" => 2,
            'status' => ProductionOrderStatusEnum::DRAFT,
            'remarks' => $request->remarks,
            'quantity' => $request->quantity,
            'created_at' => now(),



        ]);

        return response()->json([
            "message" => "production order created successfully"


        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function plan(ProductionOrder $productionOrder)
    {
        if ($productionOrder->status !== ProductionOrderStatusEnum::DRAFT->value) {
            return response()->json([
                'message' => 'Only draft orders can be planned.'
            ], 422);
        }

        $productionOrder->update([
            'status' => ProductionOrderStatusEnum::PLANNED,
            'planned_at' => now(),
        ]);

        return response()->json([
            'message' => 'Production order planned successfully.'
        ]);
    }
    public function release(ProductionOrder $productionOrder)
    {
        if ($productionOrder->status !== ProductionOrderStatusEnum::PLANNED->value) {
            return response()->json([
                'message' => 'Only planned production orders can be released.',
            ], 422);
        }


        DB::transaction(function () use ($productionOrder) {

            $productionOrder->load('bom.items');



            foreach ($productionOrder->bom->items as $item) {

                $requiredQuantity = $item->quantity * $productionOrder->quantity;

                $inventory = RawMaterialInventory::where(
                    'material_id',
                    $item->material_id
                )
                    ->lockForUpdate()
                    ->first();

                if (! $inventory) {
                    throw new \Exception(
                        "Inventory not found for material ID {$item->material_id}"
                    );
                }

                if ($inventory->available_quantity < $requiredQuantity) {
                    throw new \Exception(
                        "Insufficient stock for material ID {$item->material_id}"
                    );
                }


                $inventory->available_quantity -= $requiredQuantity;
                $inventory->reserved_quantity += $requiredQuantity;

                $inventory->save();
            }

            $productionOrder->update([
                'status' => ProductionOrderStatusEnum::RELEASED,
                'released_at' => now('Asia/Dhaka')->format('Y-m-d h:m:s A'),
            ]);
        });

        return response()->json([
            'message' => 'Production order released successfully.',
        ]);
    }
    public function start(Request $request,$id)
    {
        DB::beginTransaction();

        try {

            $productionOrder = ProductionOrder::with([
                'materialReservations',
                'productionAssignments'
            ])->findOrFail($id);


            if ($productionOrder->status !== 'released') {

                return response()->json([
                    'message' => 'Only released production orders can be started.'
                ], 422);
            }



            $assignment = $productionOrder
                ->productionAssignments
                ->first();

            if (!$assignment) {

                return response()->json([
                    'message' => 'Production assignment not found.'
                ], 404);
            }


            $machineBusy = ProductionAssignment::where(
                'machine_id',
                $assignment->machine_id
            )
                ->where('status', 'running')
                ->where('production_order_id', '!=', $productionOrder->id)
                ->exists();

            if ($machineBusy) {

                return response()->json([
                    'message' => 'Machine is already running another production order.'
                ], 422);
            }



            $runningOrders = ProductionAssignment::where(
                'workstation_id',
                $assignment->workstation_id
            )
                ->where('status', 'running')
                ->count();

            $workstation = $assignment->workstation;

            if ($runningOrders >= $workstation->capacity) {

                return response()->json([
                    'message' => 'Workstation capacity exceeded.'
                ], 422);
            }


            foreach ($productionOrder->materialReservations as $reservation) {

                $inventory = RawMaterialInventory::where(
                    'material_id',
                    $reservation->material_id
                )
                    ->lockForUpdate()
                    ->first();

                if (!$inventory) {

                    throw new \Exception(
                        'Inventory not found.'
                    );
                }

                if (
                    $inventory->reserved_quantity <
                    $reservation->reserved_quantity
                ) {

                    throw new \Exception(
                        'Reserved quantity is insufficient.'
                    );
                }



                $inventory->reserved_quantity -=
                    $reservation->reserved_quantity;

                $inventory->save();



                InventoryTransaction::create([

                    'production_order_id' => $productionOrder->id,

                    'material_id' => $reservation->material_id,

                    'transaction_type' => 'consume',

                    'quantity' => $reservation->reserved_quantity,

                    'remarks' => 'Material consumed for production',

                    'created_by' => $request->user()->id(),

                    'created_at' => now(),
                ]);



                $reservation->status = 'consumed';

                $reservation->save();
            }



            $assignment->status = 'running';

            $assignment->save();



            $productionOrder->status = 'in_production';

            $productionOrder->started_at = now();

            $productionOrder->save();

            DB::commit();

            return response()->json([

                'message' => 'Production started successfully.',

                'data' => $productionOrder->fresh()

            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([

                'message' => $e->getMessage()

            ], 500);
        }
    }
}
