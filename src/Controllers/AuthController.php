<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AuthController
{
    public function index(): void
    {
        require "../src/Views/login.html";
    }

    public function autenticar(): void
    {
        $email = $_POST["email"] ?? "";
        $senha = $_POST["senha"] ?? "";

        $result = AuthModel::autenticar($email, $senha);

        if ($result === false) {
            header("Location: /");
            exit;
        }

        header("Location: /admin/dashboard");
    }

    public function sair(): void
    {
        unset($_SESSION["usuario-logado"]);

        header("Location: /");
    }

    public static function verificarAutenticacao(): void
    {
        if (isset($_SESSION["usuario-logado"]) === false) {
            header("Location: /");
            exit;
        }
    }
}
