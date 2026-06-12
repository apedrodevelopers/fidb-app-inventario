<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\MovimentoModel;
use App\Models\ProdutoModel;

class DashboardController
{
    public function index(): void
    {

        $dados = [
            "total_produtos_abaixo_estoque_minimo" => ProdutoModel::getTotalProdutosAbaixoDoEstoqueMinimo(),
            "total_produtos_cadastrados" => ProdutoModel::getTotalProdutos(),
            "lista_produtos_abaixo_estoque_minimo" => ProdutoModel::getProdutosAbaixoDoEstoqueMinimo(),
            "total_categorias_cadastradas" => CategoriaModel::getTotalCategorias(),
            "total_movimentos_do_mes" => MovimentoModel::getTotalMovimentosDoMesCorrente(),
            "lista_dos_ultimos_movimentos" => MovimentoModel::getUltimosMovimentos()
        ];

        require "../src/Views/dashboard.php";
    }
}
