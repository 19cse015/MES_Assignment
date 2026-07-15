<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Repositories\Contracts\AuthRepositoryInterface;

class AuthService
{
    public function __construct(
        protected AuthRepositoryInterface $repository
    ) {}

    public function login(array $data): array
    {
        $user = $this->repository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout($user): void
    {
        $user->currentAccessToken()?->delete();
    }
}
