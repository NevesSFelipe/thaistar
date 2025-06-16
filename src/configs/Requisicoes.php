<?php

    namespace src\configs;

    class Requisicoes {

        public static function recuperarDadosRequest()
        {

            $metodoRequisicao = strtoupper($_SERVER['REQUEST_METHOD']);
            $tipoConteudo = $_SERVER['CONTENT_TYPE'] ?? '';
        
            if ( $metodoRequisicao == 'POST' ) {
        
                if (stripos($tipoConteudo, 'application/json') !== false) { // type HTTP Request send with JSON
        
                    $body = file_get_contents('php://input');
                    $dadosParametros = json_decode($body, true);                    
                    return (json_last_error() !== JSON_ERROR_NONE) ? [] : $dadosParametros;
        
                }
        
                return $_POST;
                
            }
        
            return $_GET;
            
        }

    }