<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class MaterialCategoryEndpoints
{
    #[OA\Get(
        path: "/material-categories",
        operationId: "getMaterialCategories",
        tags: ["Material Categories"],
        summary: "Get Material Categories",
        description: "Retrieve all material categories.",
        security: [["bearerAuth" => []]],

        parameters: [

            new OA\Parameter(
                name: "search",
                in: "query",
                description: "Search by category name",
                schema: new OA\Schema(
                    type: "string",
                    example: "Steel"
                )
            ),

            new OA\Parameter(
                name: "name",
                in: "query",
                description: "Filter by category name",
                schema: new OA\Schema(
                    type: "string",
                    example: "Steel"
                )
            ),

            new OA\Parameter(
                name: "sort",
                in: "query",
                description: "Sort by field. Prefix '-' for descending.",
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
                description: "Material categories retrieved successfully"
            ),

            new OA\Response(
                response: 401,
                description: "Unauthenticated"
            )

        ]
    )]
    public function index() {}
    #[OA\Post(
        path: "/material-categories",
        operationId: "storeMaterialCategory",
        tags: ["Material Categories"],
        summary: "Create Material Category",
        security: [["bearerAuth" => []]],

        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name"],
                properties: [

                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "Steel"
                    ),

                    new OA\Property(
                        property: "description",
                        type: "string",
                        example: "Steel Raw Materials"
                    )

                ]
            )
        ),

        responses: [

            new OA\Response(
                response: 201,
                description: "Material category created successfully"
            ),

            new OA\Response(
                response: 422,
                description: "Validation Error"
            )

        ]
    )]
    public function store() {}
    #[OA\Get(
        path: "/material-categories/{id}",
        operationId: "showMaterialCategory",
        tags: ["Material Categories"],
        summary: "Get Material Category",
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
                description: "Material category retrieved successfully"
            ),

            new OA\Response(
                response: 404,
                description: "Material category not found"
            )

        ]
    )]
    public function show() {}
    #[OA\Put(
        path: "/material-categories/{id}",
        operationId: "updateMaterialCategory",
        tags: ["Material Categories"],
        summary: "Update Material Category",
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
                        example: "Steel"
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
                description: "Material category updated successfully"
            ),

            new OA\Response(
                response: 404,
                description: "Material category not found"
            )

        ]
    )]
    public function update() {}
    #[OA\Delete(
        path: "/material-categories/{id}",
        operationId: "deleteMaterialCategory",
        tags: ["Material Categories"],
        summary: "Delete Material Category",
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
                description: "Material category deleted successfully"
            ),

            new OA\Response(
                response: 404,
                description: "Material category not found"
            )

        ]
    )]
    public function destroy() {}
}
