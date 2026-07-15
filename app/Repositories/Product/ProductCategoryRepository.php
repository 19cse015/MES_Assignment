<?php

namespace App\Repositories\Product;

use App\Models\ProductCategory;
use App\Repositories\BaseRepository;

class ProductCategoryRepository extends BaseRepository
{
    protected array $searchable = [
        'name'
    ];

    protected array $filterable = [
        'name'
    ];

    protected array $sortable = [
        'id',
        'name',
        'created_at'
    ];

    public function __construct(ProductCategory $model)
    {
        $this->model = $model;
    }
}
