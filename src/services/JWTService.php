<?php

    namespace src\services;

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use src\Configs\VariaveisGlobais;

    class JWTService {

        public static function gerarToken($usuario) {
            
            $payload = [
                'iss' => '',
                'iat' => time(),
                'exp' => time() + 3600,
                'user' => $usuario,
            ];
            
            return JWT::encode($payload, VariaveisGlobais::DB_HOST_MYSQL, 'HS256');
        
        }

    }