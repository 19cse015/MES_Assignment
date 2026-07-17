<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class AuthEndpoints
{
    #[OA\Post(
        path: "/auth/login",
        operationId: "login",

        tags: ["Authentication"],

        summary: "User Login",

        requestBody: new OA\RequestBody(
            required: true,

            content: new OA\JsonContent(
                ref: "#/components/schemas/LoginRequest"
            )
        ),

        responses: [

            new OA\Response(

                response: 200,

                description: "Login Success",

                content: new OA\JsonContent(
                    ref: "#/components/schemas/LoginResponse"
                )

            ),

            new OA\Response(
                response: 401,
                description: "Invalid Credentials"
            ),

            new OA\Response(
                response: 422,
                description: "Validation Error"
            )

        ]
    )]

    public function login() {}
    #[OA\Get(
        path: "/auth/profile",
        operationId: "profile",
        tags: ["Authentication"],
        summary: "Get authenticated user profile",
        security: [
            ["bearerAuth" => []]
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Profile retrieved successfully",
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
                            example: "Profile retrieved successfully."
                        ),
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/User"
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
    public function profile() {}
    #[OA\Post(
        path: "/auth/logout",
        operationId: "logout",
        tags: ["Authentication"],
        summary: "Logout authenticated user",
        security: [
            ["bearerAuth" => []]
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Logout successful",
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
                            example: "Logout successful."
                        ),
                        new OA\Property(
                            property: "data",
                            nullable: true,
                            example: null
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
    public function logout() {}
}
