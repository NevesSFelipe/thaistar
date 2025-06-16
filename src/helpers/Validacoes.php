<?php

    namespace src\helpers;

    class Validacoes {

        public static function validarCampoVazio($campo)
        {
            return empty($campo);   
        }

        public static function validarEmail($email)
        {
            return filter_var($email);
        }

    }