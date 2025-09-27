<?php

namespace App\Repositories;

use App\Interfaces\AuthRepoInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepo implements AuthRepoInterface
{
    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function login(string $email, string $password)
    {
        $user = $this->findByEmail($email);

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return null;
    }
}