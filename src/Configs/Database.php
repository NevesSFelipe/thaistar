<?php

namespace App\Configs;

use PDO;
use PDOException;

class Database
{
 
    protected $conexao;

    public function __construct()
    {
        try {
            
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];

            $this->conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die('Erro de conexão: ' . $e->getMessage());
        }
    }
}