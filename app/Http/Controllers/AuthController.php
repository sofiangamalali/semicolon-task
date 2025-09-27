<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $response = $this->authService->login($credentials);

        return response()->json($response, $response['success'] ? 200 : 401);
    }

    public function logout()
    {
        $response = $this->authService->logout();

        return response()->json($response, $response['success'] ? 200 : 401);
    }
}
