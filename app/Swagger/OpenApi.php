<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Manufacturing Execution System API',
    description: 'REST API documentation'
)]
#[OA\Server(
    url:  "http://127.0.0.1:8001/api/v1",
    description: 'Local Development Server'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'Sanctum'
)]
final class OpenApi
{
}
