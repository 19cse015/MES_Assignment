<?php

namespace App\Repositories\Production;

use App\Models\ProductionOrder;
use App\Repositories\BaseRepository;

class ProductionOrderRepository extends BaseRepository
{
    protected array $relations = [
        'product',
        'bom',
        'creator',
    ];

    protected array $searchable = [
        'order_number',
    ];

    protected array $filterable = [
        'product_id',
        'status',
    ];

    protected array $sortable = [
        'order_number',
        'planned_at',
        'created_at',
    ];

    public function __construct(ProductionOrder $model)
    {
        $this->model = $model;
    }
}
