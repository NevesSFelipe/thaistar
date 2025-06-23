<?php

namespace App\Models;

use App\Configs\Database;

class FuncionarioModel extends Database {

    private $tabelaFuncionarios;

    public function __construct()
    {
        $this->tabelaFuncionarios = "horarios_atendimento";
        parent::__construct(); // Chama o construtor de Database (responsável pela conexão)
    }

    public function autenticarFuncionario($email)
    {
        $sql = "SELECT * FROM funcionarios WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


}