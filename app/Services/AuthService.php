<?php

namespace App\Services;

use App\Interfaces\AuthRepoInterface;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(private AuthRepoInterface $authRepo)
    {
    }

    public function login(array $credentials)
    {
        $user = $this->authRepo->login(
            $credentials['email'],
            $credentials['password']
        );

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Invalid email or password',
                'data' => null
            ];
        }


        $token = $user->createToken('auth-token')->plainTextToken;

        return [
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ];
    }

    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();

            return [
                'success' => true,
                'message' => 'Logged out successfully'
            ];
        }

        return [
            'success' => false,
            'message' => 'User not authenticated'
        ];
    }

  
}