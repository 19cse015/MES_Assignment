<?php

namespace App\Repositories\Material;

use App\Models\Material;
use App\Repositories\BaseRepository;

class MaterialRepository extends BaseRepository
{
    protected array $relations = [
        'category'
    ];

    protected array $searchable = [
        'name'
    ];

    protected array $filterable = [
        'category_id'
    ];

    protected array $sortable = [
        'id',
        'name',
        'created_at'
    ];

    public function __construct(Material $model)
    {
        $this->model = $model;
    }
}
