<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected array $relations = [
        'category',
    ];

    protected array $searchable = [
        'name',
        'sku',
    ];

    protected array $filterable = [
        'category_id',
        'status',
    ];

    protected array $sortable = [
        'id',
        'name',
        'sku',
        'created_at',
    ];

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
