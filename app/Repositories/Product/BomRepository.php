<?php

namespace App\Repositories\Product;

use App\Models\Bom;
use App\Repositories\BaseRepository;

class BomRepository extends BaseRepository
{
    protected array $filterable = [
        'product_id',
        'status'
    ];

    protected array $sortable = [
        'id',
        'version',
        'created_at'
    ];

    public function __construct(Bom $model)
    {
        $this->model = $model;
    }
}
