<?php

namespace App\Controllers;

class ProdutoController
{
    public function index(): void
    {
        require "../src/Views/produtos/lista.php";
    }
}
