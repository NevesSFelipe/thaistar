<?php

    require_once __DIR__ . '/../vendor/autoload.php';

    use src\configs\Requisicoes;

    $dados = Requisicoes::recuperarDadosRequest();

    $endPoint = explode("/", $dados['endPoint']);
    $controller = "src\\controllers\\" . ucfirst($endPoint[0]) . "Controller";
    $metodo = $endPoint[1];

    unset($dados['endPoint']);

    $c = new $controller;
    $c->$metodo($dados);