<?php

    namespace src\models;

    use PDO;
    use src\Configs\BancoDados;

    class FuncionarioModel {

        private PDO $pdo;
        private string $tabela = "funcionarios";

        public function __construct()
        {
            $bancoDados = new BancoDados;
            $this->pdo = $bancoDados->abrirConexao("mysql");
        }

        public function autenticarFuncionario($email)
        {
            try {
         
                $sql = "SELECT * FROM $this->tabela WHERE email = :email";
                $stmt = $this->pdo->prepare($sql);

                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);

            } catch (\PDOException $e) {
                throw new \Exception('Erro ao consultar o banco de dados.');
            }
        }

    }