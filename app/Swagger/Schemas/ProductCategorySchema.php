<?php

namespace App\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductCategory"
)]
class ProductCategorySchema
{
    #[OA\Property(
        example: 1
    )]
    public int $id;

    #[OA\Property(
        example: "Furniture"
    )]
    public string $name;

    #[OA\Property(
        example: "Wooden furniture products"
    )]
    public ?string $description;

    #[OA\Property(
        example: "2026-07-16T18:00:00Z"
    )]
    public string $created_at;

    #[OA\Property(
        example: "2026-07-16T18:00:00Z"
    )]
    public string $updated_at;
}
