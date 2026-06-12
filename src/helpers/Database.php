<?php

namespace App\helpers;

use PDO;

class Database
{
    const DSN = "mysql:host=localhost;dbname=fidb_inventario;charset=utf8mb4";
    const MYSQL_USER = "root";
    const MYSQL_PASSWORD = "0000";

    public static function getPDO(): PDO
    {
        return new PDO(self::DSN, self::MYSQL_USER, self::MYSQL_PASSWORD);
    }
}
