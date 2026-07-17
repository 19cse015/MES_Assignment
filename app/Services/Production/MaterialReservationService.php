<?php

namespace App\Services\Production;

use App\Models\Bom;
use App\Models\ProductionOrder;
use App\Models\RawMaterialInventory;
use App\Models\MaterialReservation;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MaterialReservationService
{
    public function reserve(
        ProductionOrder $order,
        int $userId
    ): void {

        DB::transaction(function () use ($order, $userId) {

            $bom = Bom::with('items.material')
                ->findOrFail($order->bom_id);

            foreach ($bom->items as $item) {

                $requiredQuantity =
                    $item->quantity * $order->quantity;

                $this->reserveMaterial(

                    productionOrder: $order,

                    materialId: $item->material_id,

                    quantity: $requiredQuantity,

                    userId: $userId,

                );
            }
        });
    }

    protected function reserveMaterial(
        ProductionOrder $productionOrder,
        int $materialId,
        float $quantity,
        int $userId
    ): void {

        /**
         * Inventory Row Lock
         */
        $inventory = RawMaterialInventory::where(
            'material_id',
            $materialId
        )
            ->lockForUpdate()
            ->firstOrFail();

        /**
         * Available Stock Check
         */
        $available = $inventory->available_quantity
            - $inventory->reserved_quantity;

        if ($available < $quantity) {

            throw ValidationException::withMessages([

                'inventory' => [

                    "Insufficient inventory for material #{$materialId}"

                ]

            ]);
        }

        /**
         * Material Reservation Create
         */
        MaterialReservation::create([

            'production_order_id' => $productionOrder->id,

            'material_id' => $materialId,

            'reserved_quantity' => $quantity,

            'status' => 'reserved',

            'reserved_at' => now(),

        ]);

        /**
         * Update Reserved Quantity
         */
        $inventory->increment(
            'reserved_quantity',
            $quantity
        );

        /**
         * Inventory Transaction Log
         */
        InventoryTransaction::create([

            'production_order_id' => $productionOrder->id,

            'material_id' => $materialId,

            'transaction_type' => 'RESERVE',

            'quantity' => $quantity,

            'remarks' => 'Material reserved for production order.',

            'created_by' => $userId,

        ]);
    }
}
