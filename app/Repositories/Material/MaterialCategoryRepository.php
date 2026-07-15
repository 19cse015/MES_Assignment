<?php

namespace App\Repositories\Material;

use App\Models\MaterialCategory;
use App\Repositories\BaseRepository;

class MaterialCategoryRepository extends BaseRepository
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

    public function __construct(MaterialCategory $model)
    {
        $this->model = $model;
    }
}
