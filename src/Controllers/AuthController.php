<?php

namespace App\Controllers;

class AuthController
{
    public function index(): void
    {
        require "../src/Views/login.html";
    }
}
