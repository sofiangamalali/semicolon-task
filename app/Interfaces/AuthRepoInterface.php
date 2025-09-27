<?php

namespace App\Interfaces;

interface AuthRepoInterface
{
    public function findByEmail(string $email);

    public function login(string $email, string $password);
}