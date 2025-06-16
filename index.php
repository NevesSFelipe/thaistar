<?php

    require_once 'vendor/autoload.php';

    use src\Configs\BancoDados;

    $bd = new BancoDados;
    $conexao = $bd->abrirConexao("mysql");