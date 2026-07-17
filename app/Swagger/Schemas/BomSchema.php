<?php

namespace App\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Bom"
)]
class BomSchema
{
    #[OA\Property(example: 1)]
    public int $product_id;

    #[OA\Property(example: 1)]
    public int $version;

    #[OA\Property(example: "draft")]
    public string $status;

    #[OA\Property(
        type: "array",
        items: new OA\Items(
            ref: "#/components/schemas/BomItem"
        )
    )]
    public array $items;
}
