<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class ProductCategoryEndpoints
{
    #[OA\Get(
        path: "/product-categories",
        operationId: "getProductCategories",
        tags: ["Product Categories"],
        summary: "Get Product Categories",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "search",
                in: "query",
                description: "Search by category name",
                schema: new OA\Schema(
                    type: "string",
                    example: "Furniture"
                )
            ),

            new OA\Parameter(
                name: "name",
                in: "query",
                description: "Filter by category name",
                schema: new OA\Schema(
                    type: "string",
                    example: "Furniture"
                )
            ),

            new OA\Parameter(
                name: "sort",
                in: "query",
                description: "Sort field (-created_at, created_at, name, -name)",
                schema: new OA\Schema(
                    type: "string",
                    example: "-created_at"
                )
            ),

            new OA\Parameter(
                name: "per_page",
                in: "query",
                description: "Items per page",
                schema: new OA\Schema(
                    type: "integer",
                    default: 10
                )
            )
        ],

        responses: [
            new OA\Response(
                response: 200,
                description: "Product categories retrieved successfully"
            )
        ]
    )]
    public function index() {}
    #[OA\Post(
        path: "/product-categories",
        operationId: "storeProductCategory",
        tags: ["Product Categories"],
        summary: "Create a product category",
        security: [["bearerAuth" => []]],

        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name"],
                properties: [

                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "Furniture"
                    ),

                    new OA\Property(
                        property: "description",
                        type: "string",
                        example: "Wooden furniture"
                    )

                ]
            )
        ),

        responses: [

            new OA\Response(
                response: 201,
                description: "Category created successfully"
            ),

            new OA\Response(
                response: 422,
                description: "Validation Error"
            )

        ]
    )]
    public function store() {}
    #[OA\Get(
        path: "/product-categories/{id}",
        operationId: "showProductCategory",
        tags: ["Product Categories"],
        summary: "Get product category by ID",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )

        ],

        responses: [

            new OA\Response(
                response: 200,
                description: "Category retrieved successfully"
            ),

            new OA\Response(
                response: 404,
                description: "Category not found"
            )

        ]
    )]
    public function show() {}
    #[OA\Put(
        path: "/product-categories/{id}",
        operationId: "updateProductCategory",
        tags: ["Product Categories"],
        summary: "Update product category",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )

        ],

        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(

                properties: [

                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "Furniture"
                    ),

                    new OA\Property(
                        property: "description",
                        type: "string",
                        example: "Updated Description"
                    )

                ]

            )
        ),

        responses: [

            new OA\Response(
                response: 200,
                description: "Category updated successfully"
            ),

            new OA\Response(
                response: 404,
                description: "Category not found"
            )

        ]
    )]
    public function update() {}
    #[OA\Delete(
        path: "/product-categories/{id}",
        operationId: "deleteProductCategory",
        tags: ["Product Categories"],
        summary: "Delete product category",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )

        ],

        responses: [

            new OA\Response(
                response: 200,
                description: "Category deleted successfully"
            ),

            new OA\Response(
                response: 404,
                description: "Category not found"
            )

        ]
    )]
    public function destroy() {}
}
