<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\ProdutoModel;

class ProdutoController
{
    public function index(): void
    {
        $pesquisa = isset($_GET["pesquisa"]) ? $_GET["pesquisa"] : "";
        $categoriaId = isset($_GET["categoria_id"]) ? (int) $_GET["categoria_id"] : 0;

        $produtos = [];
        $categorias = [];

        if ($categoriaId === 0) {
            $produtos = ProdutoModel::getProdutos($pesquisa);
        } else {
            $produtos = ProdutoModel::getProdutosByCategoria($categoriaId, $pesquisa);
        }

        $categorias = CategoriaModel::getCategorias();

        require "../src/Views/produtos/lista.php";
    }
}
