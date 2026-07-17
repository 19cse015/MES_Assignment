<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class BomEndpoints
{
    #[OA\Get(
        path: "/boms",
        operationId: "getBoms",
        tags: ["BOM"],
        summary: "Get BOM List",
        description: "Retrieve BOMs with search, filter, sorting and pagination.",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "search",
                in: "query",
                description: "Search BOM",
                schema: new OA\Schema(
                    type: "string",
                    example: "Table"
                )
            ),

            new OA\Parameter(
                name: "product_id",
                in: "query",
                description: "Filter by Product ID",
                schema: new OA\Schema(
                    type: "integer",
                    example: 1
                )
            ),

            new OA\Parameter(
                name: "status",
                in: "query",
                description: "Filter by BOM status",
                schema: new OA\Schema(
                    type: "string",
                    enum: ["draft", "approved"],
                    example: "draft"
                )
            ),

            new OA\Parameter(
                name: "sort",
                in: "query",
                description: "Sort field (-created_at,name,version)",
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
                description: "BOMs retrieved successfully"
            ),

            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            )

        ]
    )]

    #[OA\Post(
        path: "/boms",
        operationId: "storeBom",
        tags: ["BOM"],
        summary: "Create BOM",
        description: "Create a new Bill of Materials (BOM).",
        security: [["bearerAuth" => []]],

        requestBody: new OA\RequestBody(

            required: true,

            content: new OA\JsonContent(

                required: [
                    "product_id",
                    "version",
                    "items"
                ],

                properties: [

                    new OA\Property(
                        property: "product_id",
                        type: "integer",
                        example: 1
                    ),

                    new OA\Property(
                        property: "version",
                        type: "integer",
                        example: 1
                    ),

                    new OA\Property(
                        property: "items",
                        type: "array",
                        items: new OA\Items(
                            ref: "#/components/schemas/BomItem"
                        )
                    )

                ]

            )

        ),

        responses: [

            new OA\Response(
                response: 201,
                description: "BOM created successfully"
            ),

            new OA\Response(
                response: 422,
                description: "Validation Error"
            ),

            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            )

        ]
    )]
    public function store() {}
    public function index() {}
    #[OA\Get(
        path: "/boms/{id}",
        operationId: "showBom",
        tags: ["BOM"],
        summary: "Get BOM Details",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "BOM ID",
                schema: new OA\Schema(type: "integer")
            )

        ],

        responses: [

            new OA\Response(
                response: 200,
                description: "BOM retrieved successfully"
            ),

            new OA\Response(
                response: 404,
                description: "BOM not found"
            )

        ]
    )]
    public function show() {}
    #[OA\Put(
        path: "/boms/{id}",
        operationId: "updateBom",
        tags: ["BOM"],
        summary: "Update BOM",
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

                required: [
                    "product_id",
                    "version",
                    "items"
                ],

                properties: [

                    new OA\Property(
                        property: "product_id",
                        type: "integer",
                        example: 1
                    ),

                    new OA\Property(
                        property: "version",
                        type: "integer",
                        example: 2
                    ),

                    new OA\Property(
                        property: "items",
                        type: "array",
                        items: new OA\Items(
                            ref: "#/components/schemas/BomItem"
                        )
                    )

                ]

            )

        ),

        responses: [

            new OA\Response(
                response: 200,
                description: "BOM updated successfully"
            ),

            new OA\Response(
                response: 404,
                description: "BOM not found"
            ),

            new OA\Response(
                response: 422,
                description: "Validation Error"
            )

        ]
    )]
    public function update() {}
    #[OA\Delete(
        path: "/boms/{id}",
        operationId: "deleteBom",
        tags: ["BOM"],
        summary: "Delete BOM",
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
                description: "BOM deleted successfully"
            ),

            new OA\Response(
                response: 404,
                description: "BOM not found"
            )

        ]
    )]
    public function destroy() {}
    #[OA\Patch(
        path: "/boms/{id}/approve",
        operationId: "approveBom",
        tags: ["BOM"],
        summary: "Approve BOM",
        description: "Approve a draft BOM so it can be used for production orders.",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "BOM ID",
                schema: new OA\Schema(type: "integer")
            )

        ],

        responses: [

            new OA\Response(
                response: 200,
                description: "BOM approved successfully"
            ),

            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            ),

            new OA\Response(
                response: 403,
                description: "Forbidden"
            ),

            new OA\Response(
                response: 404,
                description: "BOM not found"
            ),

            new OA\Response(
                response: 422,
                description: "BOM is already approved"
            )

        ]
    )]
    public function approve() {}
}
