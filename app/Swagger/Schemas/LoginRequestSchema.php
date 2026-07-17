<?php

namespace App\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "LoginRequest",
    required: ["email","password"]
)]
class LoginRequestSchema
{
    #[OA\Property(
        example: "admin@example.com"
    )]
    public string $email;

    #[OA\Property(
        example: "password"
    )]
    public string $password;
}
