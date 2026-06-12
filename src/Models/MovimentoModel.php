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
}
