<?php

namespace App\Models;

use App\helpers\Database;

use PDO;

class MovimentoModel
{
    public static function getTotalMovimentosDoMesCorrente(): int
    {
        $db = Database::getPDO();

        $st = $db->query("
            SELECT 
                COUNT(id) AS total 
            FROM 
                movimentos 
            WHERE 
                MONTH(criado_em) = MONTH( CURRENT_DATE() ) AND YEAR(criado_em) = YEAR(CURRENT_DATE())
        ");

        return (int) $st->fetch(PDO::FETCH_ASSOC)["total"];
    }

    public static function getUltimosMovimentos(): array
    {
        $db = Database::getPDO();

        $st = $db->query("
            SELECT 
                m.id,
                p.nome,
                m.tipo,
                m.quantidade,
                DATE_FORMAT( m.criado_em, '%y/%m' ) as data
            FROM 
                produtos p INNER JOIN movimentos m ON (p.id = m.produto_id) 
            WHERE 
                MONTH(m.criado_em) = MONTH( CURRENT_DATE() ) AND YEAR(m.criado_em) = YEAR(CURRENT_DATE())
            ORDER BY p.nome
            LIMIT 5
        ");

        return  $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMovimentos(): array
    {
        $db = Database::getPDO();

        $st = $db->query("
            SELECT 
                m.id,
                p.nome,
                c.nome AS categoria,
                m.tipo,
                m.quantidade,
                m.observacao,
                u.nome AS utilizador,
                m.criado_em AS data
            FROM 
                movimentos m 
                INNER JOIN produtos p ON (p.id = m.produto_id) 
                INNER JOIN categorias c ON (c.id = p.categoria_id)
                INNER JOIN utilizadores u ON (u.id = m.utilizador_id)
            ORDER BY p.nome
        ");

        return  $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMovimentosByTipoAndCategoria(string $tipo, int $categoriaId): array
    {
        $db = Database::getPDO();

        $st = $db->prepare("
            SELECT 
                m.id,
                p.nome,
                c.nome AS categoria,
                m.tipo,
                m.quantidade,
                m.observacao,
                u.nome AS utilizador,
                m.criado_em AS data
            FROM 
                movimentos m 
                INNER JOIN produtos p ON (p.id = m.produto_id) 
                INNER JOIN categorias c ON (c.id = p.categoria_id)
                INNER JOIN utilizadores u ON (u.id = m.utilizador_id)
            WHERE m.tipo = :tipo AND p.categoria_id = :categoria_id
            ORDER BY p.nome
        ");

        $st->execute([
            "tipo" => $tipo,
            "categoria_id" => $categoriaId
        ]);

        return  $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMovimentosByTipo(string $tipo): array
    {
        $db = Database::getPDO();

        $st = $db->prepare("
            SELECT 
                m.id,
                p.nome,
                c.nome AS categoria,
                m.tipo,
                m.quantidade,
                m.observacao,
                u.nome AS utilizador,
                m.criado_em AS data
            FROM 
                movimentos m 
                INNER JOIN produtos p ON (p.id = m.produto_id) 
                INNER JOIN categorias c ON (c.id = p.categoria_id)
                INNER JOIN utilizadores u ON (u.id = m.utilizador_id)
            WHERE m.tipo = :tipo
            ORDER BY p.nome
        ");

        $st->execute([
            "tipo" => $tipo,
        ]);

        return  $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMovimentosByCategoria(string $categoriaId): array
    {
        $db = Database::getPDO();

        $st = $db->prepare("
            SELECT 
                m.id,
                p.nome,
                c.nome AS categoria,
                m.tipo,
                m.quantidade,
                m.observacao,
                u.nome AS utilizador,
                m.criado_em AS data
            FROM 
                movimentos m 
                INNER JOIN produtos p ON (p.id = m.produto_id) 
                INNER JOIN categorias c ON (c.id = p.categoria_id)
                INNER JOIN utilizadores u ON (u.id = m.utilizador_id)
            WHERE p.categoria_id = :categoria_id
            ORDER BY p.nome
        ");

        $st->execute([
            "categoria_id" => $categoriaId,
        ]);

        return  $st->fetchAll(PDO::FETCH_ASSOC);
    }
}
