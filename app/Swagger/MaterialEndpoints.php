<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class MaterialEndpoints
{
    #[OA\Get(
        path: "/materials",
        operationId: "getMaterials",
        tags: ["Materials"],
        summary: "Get Materials",
        description: "Retrieve materials with search, filter, sorting and pagination.",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "search",
                in: "query",
                description: "Search by material name",
                schema: new OA\Schema(
                    type: "string",
                    example: "Steel"
                )
            ),

            new OA\Parameter(
                name: "category_id",
                in: "query",
                description: "Filter by category",
                schema: new OA\Schema(
                    type: "integer",
                    example: 1
                )
            ),

            new OA\Parameter(
                name: "unit",
                in: "query",
                description: "Filter by unit",
                schema: new OA\Schema(
                    type: "string",
                    example: "kg"
                )
            ),

            new OA\Parameter(
                name: "sort",
                in: "query",
                description: "Sort field (-created_at,name,unit)",
                schema: new OA\Schema(
                    type: "string",
                    example: "-created_at"
                )
            ),

            new OA\Parameter(
                name: "per_page",
                in: "query",
                schema: new OA\Schema(
                    type: "integer",
                    default: 10
                )
            )

        ],

        responses: [

            new OA\Response(
                response: 200,
                description: "Materials retrieved successfully"
            ),

            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            )

        ]
    )]
    public function index() {}
    #[OA\Post(
        path: "/materials",
        operationId: "storeMaterial",
        tags: ["Materials"],
        summary: "Create Material",
        security: [["bearerAuth" => []]],

        requestBody: new OA\RequestBody(

            required: true,

            content: new OA\JsonContent(

                required: [

                    "category_id",
                    "name",
                    "unit"

                ],

                properties: [

                    new OA\Property(
                        property: "category_id",
                        type: "integer",
                        example: 1
                    ),

                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "Steel Rod"
                    ),

                    new OA\Property(
                        property: "unit",
                        type: "string",
                        example: "kg"
                    )

                ]

            )

        ),

        responses: [

            new OA\Response(
                response: 201,
                description: "Material created successfully"
            ),

            new OA\Response(
                response: 422,
                description: "Validation Error"
            )

        ]
    )]
    public function store() {}
    #[OA\Get(
        path: "/materials/{id}",
        operationId: "showMaterial",
        tags: ["Materials"],
        summary: "Get Material Details",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(
                    type: "integer"
                )
            )

        ],

        responses: [

            new OA\Response(
                response: 200,
                description: "Material retrieved successfully"
            ),

            new OA\Response(
                response: 404,
                description: "Material not found"
            )

        ]
    )]
    public function show() {}
    #[OA\Put(
        path: "/materials/{id}",
        operationId: "updateMaterial",
        tags: ["Materials"],
        summary: "Update Material",
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
                        property: "category_id",
                        type: "integer",
                        example: 1
                    ),

                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "Steel Rod"
                    ),

                    new OA\Property(
                        property: "unit",
                        type: "string",
                        example: "kg"
                    )

                ]

            )

        ),

        responses: [

            new OA\Response(
                response: 200,
                description: "Material updated successfully"
            ),

            new OA\Response(
                response: 404,
                description: "Material not found"
            )

        ]
    )]
    public function update() {}
    #[OA\Delete(
        path: "/materials/{id}",
        operationId: "deleteMaterial",
        tags: ["Materials"],
        summary: "Delete Material",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(
                    type: "integer"
                )
            )

        ],

        responses: [

            new OA\Response(
                response: 200,
                description: "Material deleted successfully"
            ),

            new OA\Response(
                response: 404,
                description: "Material not found"
            )

        ]
    )]
    public function destroy() {}
}
