<?php

namespace App\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Product"
)]
class ProductSchema
{
    #[OA\Property(example: 1)]
    public int $id;

    #[OA\Property(
        ref:"#/components/schemas/ProductCategory"
    )]
    public object $category;

    #[OA\Property(
        example:"Office Table"
    )]
    public string $name;

    #[OA\Property(
        example:"TAB-001"
    )]
    public string $sku;

    #[OA\Property(
        example:"120x60 cm wooden office table"
    )]
    public ?string $specification;

    #[OA\Property(
        example:"active"
    )]
    public string $status;

    #[OA\Property(
        example:"2026-07-16T18:00:00Z"
    )]
    public string $created_at;

    #[OA\Property(
        example:"2026-07-16T18:00:00Z"
    )]
    public string $updated_at;
}
