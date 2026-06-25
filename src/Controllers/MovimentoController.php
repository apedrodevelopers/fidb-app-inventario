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

    public function create(): void
    {
        $produtos = ProdutoModel::getProdutos();

        require "../src/Views/movimentos/novo.php";
    }

    public function store(): void
    {
        $produtoId = (int) $_POST["produto_id"];
        $tipoMovimento = $_POST["tipo"];
        $quantidade = (int) $_POST["quantidade"];
        $obs = $_POST["observacao"];

        if ($produtoId === 0) {
            header("Location: /admin/movimentos/create");
            exit;
        }

        if ($tipoMovimento === "saida") {
            $produto = ProdutoModel::getProdutoById($produtoId);
            $estoqueAtual = (int) $produto["quantidade"];

            if ($estoqueAtual < $quantidade) {
                header("Location: /admin/movimentos/create");
                exit;
            }
        }

        $utilizadorId = (int) $_SESSION["usuario-logado"]["id"];

        if ($tipoMovimento === "saida") {
            MovimentoModel::registarSaida($produtoId, $quantidade, $obs, $utilizadorId);
        } else {
            MovimentoModel::registarEntrada($produtoId, $quantidade, $obs, $utilizadorId);
        }

        header("Location: /admin/movimentos/lista");
    }
}
