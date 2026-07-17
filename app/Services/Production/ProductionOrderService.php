<?php

namespace App\Services\Production;

use App\Enums\BomStatusEnum;
use App\Enums\ProductionOrderStatusEnum;
use App\Models\Bom;
use App\Models\ProductionOrder;
use App\Repositories\Production\ProductionOrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Services\Production\MaterialReservationService;



class ProductionOrderService
{
    public function __construct(
            protected ProductionOrderRepository  $repository,
        protected MaterialReservationService $materialReservationService,
    ) {}

    public function index(
        array $filters,
        ?string $search,
        ?string $sort,
        int $perPage
    ) {
        return $this->repository->paginate(
            filters: $filters,
            search: $search,
            sort: $sort,
            perPage: $perPage,
        );
    }

    public function show(int $id): ProductionOrder
    {
        return $this->repository->find($id);
    }

    public function update(
        int $id,
        array $data
    ): ProductionOrder {

        $order = $this->repository->find($id);

        if (
            in_array(
                $order->status,
                [
                    ProductionOrderStatusEnum::RELEASED->value,
                    ProductionOrderStatusEnum::IN_PRODUCTION->value,
                    ProductionOrderStatusEnum::COMPLETED->value,
                    ProductionOrderStatusEnum::CLOSED->value,
                    ProductionOrderStatusEnum::CANCELLED->value,
                ]
            )
        ) {
            throw ValidationException::withMessages([
                'status' => [
                    'This production order cannot be updated.'
                ]
            ]);
        }

        $this->validateBom(
            $data['product_id'],
            $data['bom_id']
        );

        return DB::transaction(function () use ($id, $data) {

            $this->repository->update($id, [

                'product_id' => $data['product_id'],

                'bom_id' => $data['bom_id'],

                'quantity' => $data['quantity'],

                'remarks' => $data['remarks'] ?? null,

                'planned_at' => $data['planned_at'] ?? null,

            ]);

            return $this->repository->find($id);
        });
    }

    public function destroy(
        int $id
    ): bool {

        $order = $this->repository->find($id);

        if (
            $order->status !== ProductionOrderStatusEnum::DRAFT->value
        ) {

            throw ValidationException::withMessages([

                'status' => [
                    'Only draft production order can be deleted.'
                ]

            ]);
        }

        return $this->repository->delete($id);
    }

    public function store(
        array $data,
        int $userId
    ): ProductionOrder {

        $this->validateBom(
            $data['product_id'],
            $data['bom_id']
        );

        return DB::transaction(function () use ($data, $userId) {

            $order = $this->repository->create([

                'order_number' => $this->generateOrderNumber(),

                'product_id' => $data['product_id'],

                'bom_id' => $data['bom_id'],

                'created_by' => $userId,

                'quantity' => $data['quantity'],

                'status' => $data['status'],

                'remarks' => $data['remarks'] ?? null,

                'planned_at' => $data['planned_at'] ?? null,

            ]);

            return $this->repository->find($order->id);
        });
    }
    public function plan(
        int $id
    ): ProductionOrder {

        $order = $this->repository->find($id);

        return $this->changeStatus(

            $order,

            ProductionOrderStatusEnum::DRAFT,

            ProductionOrderStatusEnum::PLANNED,

            [
                'planned_at' => now(),
            ]

        );
    }
    public function release(
        int $id,
        int $userId
    ): ProductionOrder {

        $order = $this->repository->find($id);

        $order = $this->changeStatus(

            $order,

            ProductionOrderStatusEnum::PLANNED,

            ProductionOrderStatusEnum::RELEASED,

            [
                'released_at' => now(),
            ]

        );

        $this->materialReservationService
            ->reserve(
                $order,
                $userId
            );

        return $order;
    }

    public function start(
    int $id
): ProductionOrder {

    $order = $this->repository->find($id);

    return $this->changeStatus(

        $order,

        ProductionOrderStatusEnum::RELEASED,

        ProductionOrderStatusEnum::IN_PRODUCTION,

        [
            'started_at' => now(),
        ]

    );

}

public function complete(
    int $id
): ProductionOrder {

    $order = $this->repository->find($id);

    return $this->changeStatus(

        $order,

        ProductionOrderStatusEnum::IN_PRODUCTION,

        ProductionOrderStatusEnum::COMPLETED,

        [
            'completed_at' => now(),
        ]

    );

}
public function close(
    int $id
): ProductionOrder {

    $order = $this->repository->find($id);

    return $this->changeStatus(

        $order,

        ProductionOrderStatusEnum::COMPLETED,

        ProductionOrderStatusEnum::CLOSED,

        [
            'closed_at' => now(),
        ]

    );

}
    protected function generateOrderNumber(): string
    {
        return 'PO-' . now()->format('YmdHis');
    }

    protected function validateBom(
        int $productId,
        int $bomId
    ): void {

        $bom = Bom::findOrFail($bomId);

        if ($bom->product_id !== $productId) {
            throw ValidationException::withMessages([
                'bom_id' => [
                    'Selected BOM does not belong to the selected product.'
                ]
            ]);
        }

        if ($bom->status !== BomStatusEnum::APPROVED->value) {
            throw ValidationException::withMessages([
                'bom_id' => [
                    'Only approved BOM can be used.'
                ]
            ]);
        }
    }
    protected function changeStatus(
        ProductionOrder $order,
        ProductionOrderStatusEnum $from,
        ProductionOrderStatusEnum $to,
        array $extra = []
    ): ProductionOrder {

        if ($order->status !== $from->value) {

            throw ValidationException::withMessages([

                'status' => [
                    "Production Order must be {$from->value} before changing to {$to->value}."
                ]

            ]);
        }

        $this->repository->update(
            $order->id,
            array_merge(
                [
                    'status' => $to->value,
                ],
                $extra
            )
        );

        return $this->repository->find($order->id);
    }
}
