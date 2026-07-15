<?php

namespace App\Repositories\Product;

use App\Models\Bom;
use App\Repositories\BaseRepository;

class BomRepository extends BaseRepository
{
    protected array $relations = [
        'product',
        'items.material',
        'approver',
    ];

    /**
     * Searchable Columns
     */
    protected array $searchable = [
        'version',
    ];

    /**
     * Filterable Columns
     */
    protected array $filterable = [
        'product_id',
        'status',
    ];

    /**
     * Sortable Columns
     */
    protected array $sortable = [
        'id',
        'version',
        'status',
        'created_at',
    ];

    public function __construct(Bom $model)
    {
        $this->model = $model;
    }
}
