<?php

namespace App\Controllers;

use App\Models\MovimentoModel;

class MovimentoController
{

    public function index(): void
    {
        $movimentos = MovimentoModel::getMovimentos();
        
        require "../src/Views/movimentos/lista.php";
    }
}
