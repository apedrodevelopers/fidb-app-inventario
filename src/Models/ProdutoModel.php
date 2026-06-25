<?php

namespace App\Models;

use App\helpers\Database;
use PDO;

class ProdutoModel
{
    public static function getTotalProdutos(): int
    {
        $db = Database::getPDO();

        $st = $db->query("SELECT COUNT(id) as total_produtos FROM produtos");

        return (int) $st->fetch(PDO::FETCH_ASSOC)["total_produtos"];
    }

    public static function getTotalProdutosAbaixoDoEstoqueMinimo(): int
    {
        $db = Database::getPDO();

        $st = $db->query("SELECT COUNT(id) as total FROM produtos WHERE quantidade <= quantidade_minima");

        return (int) $st->fetch(PDO::FETCH_ASSOC)["total"];
    }

    public static function getProdutosAbaixoDoEstoqueMinimo(): array
    {
        $db = Database::getPDO();

        $st = $db->query("
            SELECT id, nome, quantidade, quantidade_minima
            FROM produtos
            WHERE 
                quantidade <= quantidade_minima
            ORDER BY nome
            LIMIT 5
        ");

        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProdutos(string $pesquisa = ""): array
    {
        $db = Database::getPDO();

        $st = $db->prepare("
            SELECT p.*, c.nome AS categoria FROM produtos p 
                INNER JOIN categorias c ON (p.categoria_id = c.id) 
                WHERE p.nome LIKE :nome
                ORDER BY p.nome
        ");

        $nome = "%" . $pesquisa . "%";

        $st->bindParam(":nome", $nome);

        $st->execute();

        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProdutosByCategoria(int $categoriaId, string $pesquisa = ""): array
    {
        $db = Database::getPDO();

        $st = $db->prepare("
            SELECT p.*, c.nome AS categoria FROM produtos p 
                INNER JOIN categorias c ON (p.categoria_id = c.id) 
                WHERE c.id = :categoria_id AND p.nome LIKE :nome
                ORDER BY p.nome
        ");

        $nome = "%" . $pesquisa . "%";

        $st->bindParam(":categoria_id", $categoriaId);
        $st->bindParam(":nome", $nome);

        $st->execute();

        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $dados): void
    {
        $db = Database::getPDO();

        $st = $db->prepare(
            "
        INSERT INTO produtos (nome, descricao, preco, quantidade, quantidade_minima, categoria_id) 
        VALUES (:nome, :descricao, :preco, :quantidade, :quantidade_minima, :categoria_id)"
        );

        $st->execute($dados);
    }

    public static function getProdutoById(int $id): mixed
    {
        $db = Database::getPDO();

        $st = $db->prepare("
            SELECT p.*, c.nome AS categoria FROM produtos p 
                INNER JOIN categorias c ON (p.categoria_id = c.id) 
                WHERE p.id = :id
        ");

        $st->bindParam(":id", $id);

        $st->execute();

        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete(int $id): void
    {
        $db = Database::getPDO();

        $st = $db->prepare("
            DELETE FROM produtos WHERE id = :id
        ");

        $st->bindParam(":id", $id);

        $st->execute();
    }

    public static function update(int $id, array $dados): void
    {
        $db = Database::getPDO();

        $st = $db->prepare(
            "
        UPDATE produtos SET 
            nome = :nome, 
            descricao = :descricao, 
            preco = :preco, 
            quantidade = :quantidade,
            quantidade_minima = :quantidade_minima , categoria_id = :categoria_id
        WHERE id = :id
        "
        );

        $dados["id"] = $id;

        $st->execute($dados);
    }
}
