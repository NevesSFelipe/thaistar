<?php

    namespace src\Configs;

    use PDO;
    use PDOException;

    use src\Configs\VariaveisGlobais;

    class BancoDados {

        private array $dadosConexao;

        public function __construct() {
            
            $this->dadosConexao = array(
            
                "mysql" => array(
                    "host"      => VariaveisGlobais::DB_HOST_MYSQL,
                    "nome"     => VariaveisGlobais::DB_NOME_MYSQL,
                    "usuario"  => VariaveisGlobais::DB_USUARIO_MYSQL,
                    "senha"     => VariaveisGlobais::DB_SENHA_MYSQL,
                    "porta"     => VariaveisGlobais::DB_PORTA_MYSQL
                )
    
            );
            
        }

        public function abrirConexao($banco)
        {
        
            try {

                $host = $this->dadosConexao[$banco]['host'];
                $nome = $this->dadosConexao[$banco]['nome'];
                $usuario = $this->dadosConexao[$banco]['usuario'];
                $senha = $this->dadosConexao[$banco]['senha'];
                $porta = $this->dadosConexao[$banco]['porta'];

                $dsn = "mysql:host={$host};dbname={$nome};port={$porta};charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ];

                return new PDO($dsn, $usuario, $senha, $options);

            } catch (PDOException $e) {
                die('Connection error: ' . $e->getMessage());
            }

        }

    }