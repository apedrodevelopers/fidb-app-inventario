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

    public static function getProdutos(): array
    {
        $db = Database::getPDO();

        $st = $db->query("
            SELECT p.*, c.nome AS categoria FROM produtos p INNER JOIN categorias c ON (p.categoria_id = c.id) ORDER BY p.nome
        ");

        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function pesquisarProdutosPorNomeECategoria(string $nome): void {

    }
}
