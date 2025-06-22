<?php

namespace App\Helpers;

class Validacoes
{
    public static function validarCampoVazio($campo)
    {
        return empty($campo);
    }

    public static function validarEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validarSessao($ultimoAcesso = "")
    {
 
        $tempoMaximo = 1800; // 30 minutos em segundos (1800)

        if ( empty($ultimoAcesso) || time() - $ultimoAcesso > $tempoMaximo ) {
            
            header("Location: deslogar-funcionario");
            exit();
        
        }

    }
}