<?php

namespace App\Models;

use App\helpers\Database;
use PDO;

class AuthModel
{

    public static function autenticar(string $email, string $senha): bool
    {
        $db = Database::getPDO();

        $st = $db->prepare("
            SELECT id, nome, perfil, email FROM utilizadores WHERE email = :email AND senha = :senha AND estado = 'ativo'
        ");
        $st->bindParam(":email", $email);
        $st->bindParam(":senha", $senha);

        $st->execute();

        $result = $st->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return false;
        }

        $_SESSION["usuario-logado"] = $result;

        return true;
    }
}
