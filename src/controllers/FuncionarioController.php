<?php

    namespace src\controllers;

    use Firebase\JWT\JWT;

    use src\helpers\Validacoes;
    use src\helpers\RespostaHttp;

    use src\models\FuncionarioModel;
    
    use src\services\JWTService;

    class FuncionarioController {

        private FuncionarioModel $funcionarioModel;

        public function __construct()
        {
            $this->funcionarioModel = new FuncionarioModel;
        }

        public function efetuarLogin($dadosFuncionrio)
        {
            if ( Validacoes::validarCampoVazio($dadosFuncionrio['email']) === true || Validacoes::validarEmail($dadosFuncionrio['email']) === false || Validacoes::validarCampoVazio($dadosFuncionrio['senha']) === true ) {

                RespostaHttp::exibirMsgRetorno([
                    "status"    => false,
                    "msg"       => "Por favor, preencha todos os campos corretamente."
                ], 422);

            }

            $dadosFuncionarioLogado = $this->funcionarioModel->autenticarFuncionario($dadosFuncionrio['email']);

            if ( isset($dadosFuncionarioLogado['senha']) === false || password_verify($dadosFuncionrio['senha'], $dadosFuncionarioLogado['senha']) === false ) {

                RespostaHttp::exibirMsgRetorno([
                    "status"    => false,
                    "msg"       => "Email / Senha Inválido."
                ], 401);

            }

            session_start();
            $_SESSION['token_autorizacao'] = JWTService::gerarToken($dadosFuncionarioLogado['email']);
            RespostaHttp::exibirMsgRetorno([
                "status"    => true,
                "msg"       => "Acesso permitido.",
            ], 200);
        }

    }