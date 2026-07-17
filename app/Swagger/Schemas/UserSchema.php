<?php

namespace App\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "User"
)]
class UserSchema
{
    #[OA\Property(example: 1)]
    public int $id;

    #[OA\Property(example: "Admin User")]
    public string $name;

    #[OA\Property(example: "admin@example.com")]
    public string $email;

    #[OA\Property(example: "system_admin")]
    public string $role;
}
