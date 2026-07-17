<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="ValidationError",
 *     type="object",
 *
 *     @OA\Property(
 *          property="message",
 *          type="string",
 *          example="The given data was invalid."
 *     ),
 *
 *     @OA\Property(
 *          property="errors",
 *          type="object",
 *
 *          example={
 *              "email":{"The email field is required."},
 *              "password":{"The password field is required."}
 *          }
 *     )
 * )
 */
class ValidationErrorSchema
{
}
