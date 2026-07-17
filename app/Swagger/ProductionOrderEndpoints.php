<?php

namespace App\Swagger;

use App\Models\ProductionOrder;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;


class ProductionOrderEndpoints
{
    #[OA\Post(
        path: '/api/v1/production-orders',
        operationId: 'storeProductionOrder',
        tags: ['Production Orders'],
        summary: 'Create Production Order',
        description: 'Creates a new production order using the latest approved BOM for the selected product.',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['product_id', 'quantity'],
                properties: [
                    new OA\Property(
                        property: 'product_id',
                        type: 'integer',
                        example: 1
                    ),
                    new OA\Property(
                        property: 'quantity',
                        type: 'integer',
                        example: 100
                    ),
                    new OA\Property(
                        property: 'remarks',
                        type: 'string',
                        example: 'Urgent production order'
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Production order created successfully'
            ),
            new OA\Response(
                response: 422,
                description: 'Validation failed or approved BOM not found'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthorized'
            )
        ]
    )]
    public function store(Request $request)
    {
        //
    }

    #[OA\Patch(
        path: '/api/v1/production-orders/{productionOrder}/plan',
        operationId: 'planProductionOrder',
        tags: ['Production Orders'],
        summary: 'Plan Production Order',
        description: 'Changes the production order status from Draft to Planned.',
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'productionOrder',
                description: 'Production Order ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Production order planned successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Production order not found'
            ),
            new OA\Response(
                response: 422,
                description: 'Only draft production orders can be planned'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthorized'
            )
        ]
    )]
    public function plan(ProductionOrder $productionOrder)
    {
        //
    }

    #[OA\Patch(
        path: '/api/v1/production-orders/{productionOrder}/release',
        operationId: 'releaseProductionOrder',
        tags: ['Production Orders'],
        summary: 'Release Production Order',
        description: 'Checks raw material inventory, reserves inventory, and changes the production order status from Planned to Released.',
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'productionOrder',
                description: 'Production Order ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Production order released successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Production order not found'
            ),
            new OA\Response(
                response: 422,
                description: 'Insufficient raw material inventory or invalid production order status'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthorized'
            )
        ]
    )]
    public function release(ProductionOrder $productionOrder)
    {
        //
    }
}
