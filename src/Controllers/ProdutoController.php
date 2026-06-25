<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\ProdutoModel;

use Rakit\Validation\Validator;

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

    public function create(): void
    {
        $categorias = CategoriaModel::getCategorias();

        require "../src/Views/produtos/novo.php";
    }

    public function store(): void
    {
        // Recuperar os dados da requisicao

        // Validar (rakit/validation => packgist.org)
        $validator = new Validator();

        $validation  = $validator->validate(
            $_POST,
            [
                "nome" => "required|min:3|max:150",
                "descricao" => "required",
                "preco" => "required|numeric",
                "categoria_id" => "required|numeric",
                "quantidade" => "required|numeric",
                "quantidade_minima" => "required|numeric",
            ]
        );

        if ($validation->fails()) {
            $erros = $validation->errors()->firstOfAll();

            header("Location: /admin/produtos/novo");
            exit;
        }

        // Salvar atraves do Model
        ProdutoModel::create($_POST);

        // Redirecionar para a listagem
        header("Location: /admin/produtos/lista");
    }

    public function showDeletePage(int $id): void
    {
        $produto = ProdutoModel::getProdutoById($id);

        if ($produto === false) {
            header("Location: /admin/produtos/lista");
            exit;
        }

        require "../src/Views/produtos/apagar.php";
    }

    public function delete(int $id): void
    {
        ProdutoModel::delete($id);

        header("Location: /admin/produtos/lista");
    }

    public function edit(int $id): void
    {

        $categorias = CategoriaModel::getCategorias();
        $produto = ProdutoModel::getProdutoById($id);

        if ($produto === false) {
            header("Location: /admin/produtos/lista");
            exit;
        }

        require "../src/Views/produtos/editar.php";
    }

    public function update(int $id): void
    {
        // Recuperar os dados da requisicao

        // Validar (rakit/validation => packgist.org)
        $validator = new Validator();

        $validation  = $validator->validate(
            $_POST,
            [
                "nome" => "required|min:3|max:150",
                "descricao" => "required",
                "preco" => "required|numeric",
                "categoria_id" => "required|numeric",
                "quantidade" => "required|numeric",
                "quantidade_minima" => "required|numeric",
            ]
        );

        if ($validation->fails()) {
            $erros = $validation->errors()->firstOfAll();

            header("Location: /admin/produtos/$id/editar");
            exit;
        }


        // Salvar atraves do Model

        ProdutoModel::update($id, $_POST);

        // Redirecionar para a listagem
        header("Location: /admin/produtos/lista");
    }
}
