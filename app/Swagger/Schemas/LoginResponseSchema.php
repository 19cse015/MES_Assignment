<?php

namespace App\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "LoginResponse"
)]
class LoginResponseSchema
{
    #[OA\Property(
        example: true
    )]
    public bool $success;

    #[OA\Property(
        example: "Login successful."
    )]
    public string $message;

    #[OA\Property]
    public LoginData $data;
}

#[OA\Schema]
class LoginData
{
    #[OA\Property]
    public string $token;

    #[OA\Property(ref:"#/components/schemas/User")]
    public object $user;
}
