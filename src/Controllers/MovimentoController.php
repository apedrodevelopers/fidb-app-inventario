<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\MovimentoModel;
use App\Models\ProdutoModel;

class MovimentoController
{

    public function index(): void
    {

        $filtrarTipo = false;
        $filtrarCategoriaId = false;

        if (isset($_GET["tipo"])) {
            if ($_GET["tipo"] != 0) {
                $filtrarTipo = true;
            }
        }

        if (isset($_GET["categoria_id"])) {
            if ($_GET["categoria_id"] != 0) {
                $filtrarCategoriaId = true;
            }
        }

        $categorias = CategoriaModel::getCategorias();

        $movimentos = [];

        if ($filtrarTipo === false && $filtrarCategoriaId === false) {
            $movimentos = MovimentoModel::getMovimentos();
        }

        if ($filtrarTipo === true && $filtrarCategoriaId === true) {
            $tipo = $_GET["tipo"];
            $categoriaId = (int) $_GET["categoria_id"];

            $movimentos = MovimentoModel::getMovimentosByTipoAndCategoria($tipo, $categoriaId);
        }

        if ($filtrarTipo === true && $filtrarCategoriaId === false) {
            $tipo = $_GET["tipo"];

            $movimentos = MovimentoModel::getMovimentosByTipo($tipo);
        }

        if ($filtrarTipo === false && $filtrarCategoriaId === true) {
            $categoriaId = (int) $_GET["categoria_id"];

            $movimentos = MovimentoModel::getMovimentosByCategoria($categoriaId);
        }

        require "../src/Views/movimentos/lista.php";
    }

    public function create (): void {
        $produtos = ProdutoModel::getProdutos();
        
        require "../src/Views/movimentos/novo.php";
    }
}
