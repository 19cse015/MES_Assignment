<?php

namespace App\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "BomItem"
)]
class BomItemSchema
{
    #[OA\Property(example: 1)]
    public int $material_id;

    #[OA\Property(example: 10)]
    public float $quantity;
}
