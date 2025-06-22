<?php

namespace App\Models;

use App\Configs\Database;

class FuncionarioModel extends Database {

    public function autenticarFuncionario($email)
    {
        $sql = "SELECT * FROM funcionarios WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


}