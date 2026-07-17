<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class ProductEndpoints
{
    #[OA\Get(
        path: "/products",

        operationId: "productIndex",

        tags: ["Products"],

        summary: "Get Product List",

        security: [
            ["bearerAuth" => []]
        ],

        responses: [

            new OA\Response(

                response: 200,

                description: "Product List",

                content: new OA\JsonContent(

                    properties: [

                        new OA\Property(
                            property: "success",
                            type: "boolean",
                            example: true
                        ),

                        new OA\Property(
                            property: "message",
                            type: "string",
                            example: "Products retrieved successfully."
                        ),

                        new OA\Property(

                            property: "data",

                            type: "array",

                            items: new OA\Items(

                                ref: "#/components/schemas/Product"

                            )

                        )

                    ]

                )

            ),

            new OA\Response(

                response: 401,

                description: "Unauthenticated"

            )

        ]

    )]

    public function index() {}
    #[OA\Post(
        path: "/products",
        operationId: "storeProduct",
        tags: ["Products"],
        summary: "Create Product",
        security: [["bearerAuth" => []]],

        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["category_id", "name", "sku", "status"],
                properties: [
                    new OA\Property(property: "category_id", type: "integer", example: 1),
                    new OA\Property(property: "name", type: "string", example: "Office Table"),
                    new OA\Property(property: "sku", type: "string", example: "TAB-001"),
                    new OA\Property(
                        property: "specification",
                        type: "string",
                        example: "120x60 cm wooden office table"
                    ),
                    new OA\Property(
                        property: "status",
                        type: "string",
                        example: "active"
                    ),
                ]
            )
        ),

        responses: [
            new OA\Response(
                response: 201,
                description: "Product created successfully"
            ),
            new OA\Response(
                response: 422,
                description: "Validation Error"
            )
        ]
    )]
    public function store() {}
    #[OA\Get(
    path: "/products/{id}",
    operationId: "showProduct",
    tags: ["Products"],
    summary: "Get Product Details",
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
            description: "Product Details"
        ),
        new OA\Response(
            response: 404,
            description: "Product not found"
        )
    ]
)]
public function show()
{
}
#[OA\Put(
    path: "/products/{id}",
    operationId: "updateProduct",
    tags: ["Products"],
    summary: "Update Product",
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
        content: new OA\JsonContent(ref: "#/components/schemas/Product")
    ),

    responses: [
        new OA\Response(
            response: 200,
            description: "Product updated successfully"
        ),
        new OA\Response(
            response: 404,
            description: "Product not found"
        )
    ]
)]
public function update()
{
}
#[OA\Delete(
    path: "/products/{id}",
    operationId: "deleteProduct",
    tags: ["Products"],
    summary: "Delete Product",
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
            description: "Product deleted successfully"
        ),
        new OA\Response(
            response: 404,
            description: "Product not found"
        )
    ]
)]
public function destroy()
{
}
}
