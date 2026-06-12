<?php

namespace App\Models;

use App\helpers\Database;

class CategoriaModel
{
    public static function getTotalCategorias(): int
    {
        $db = Database::getPDO();

        $st = $db->query("SELECT COUNT(id) as total_categorias FROM categorias");

        return (int) $st->fetch()["total_categorias"];
    }
}
