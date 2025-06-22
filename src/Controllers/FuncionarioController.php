<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Validacoes;
use App\Models\FuncionarioModel;

class FuncionarioController extends Controller {

    public function __construct()
    {
        session_start();
    }

    public function index($arrayMsg = array())
    {
        $this->view('login-funcionario', $arrayMsg);
    }

    public function autenticarFuncionario()
    {

        $email = $_REQUEST['email'];
        $senha = $_REQUEST['senha'];

        $isEmptyEmail = Validacoes::validarCampoVazio($email);
        $isEmailValido = Validacoes::validarEmail($email);
        $isEmptySenha = Validacoes::validarCampoVazio($senha);
        
        if ( $isEmptyEmail || !$isEmailValido || $isEmptySenha ) {

            $arrayRetorno = array("msg" => "Por favor, verifique os dados inseridos.");
            $this->view('login-funcionario', $arrayRetorno);
            return;

        }

        $funcionarioModel = new FuncionarioModel;
        $funcionarioCadastrado = $funcionarioModel->autenticarFuncionario($email);

        if ( empty($funcionarioCadastrado) || password_verify($senha, $funcionarioCadastrado['senha']) === false ) {

            $arrayRetorno = array("msg" => "Email / Senha incorreto.");
            $this->view('login-funcionario', $arrayRetorno);
            return;

        }

        $_SESSION['ultimoAcesso'] = time();
        header('Location: painel-administrativo');
    
    }

    public function deslogarFuncionario()
    {
        session_unset(); // Limpa variáveis da sessão
        session_destroy(); // Destrói a sessão
        header('Location: login-funcionario?msg=Funcionário%20Deslogado');


    }

    public function painelAdministrativo()
    {
        Validacoes::validarSessao($_SESSION['ultimoAcesso']);
        $this->view('painel-administrativo');
    }

}