<?php

    namespace src\helpers;

    class RespostaHttp {

        public static function exibirMsgRetorno($data, $status = 200) {
            http_response_code($status);
            header('Content-Type: application/json');
            echo json_encode($data);
            exit;
        }

    }