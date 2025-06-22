<?php

use App\Controllers\HomeController;
use App\Controllers\FuncionarioController;

$endPoint = $_GET['url'] ?? '/';

switch($endPoint) {

    case 'login-funcionario':

        $controller = new FuncionarioController;
        $controller->index();

    break;

    case 'autenticar-funcionario':

        $controller = new FuncionarioController;
        $controller->autenticarFuncionario();

    break;

    case 'deslogar-funcionario':

        $controller = new FuncionarioController;
        $controller->deslogarFuncionario();

    break;

    case 'painel-administrativo':

        $controller = new FuncionarioController;
        $controller->painelAdministrativo();

    break;

    default:
        
        $controller = new HomeController;
        $controller->index();

    break;

}