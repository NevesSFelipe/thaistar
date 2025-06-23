<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Validacoes;
use App\Models\FuncionarioModel;
use App\Models\ParametrizadorHorariosModel;

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
        $this->view('painel-administrativo', $_SESSION);
    }

    public function parametrizadorHorario()
    {
        Validacoes::validarSessao($_SESSION['ultimoAcesso']);

        $parametrizadorHorariosModel = new ParametrizadorHorariosModel;
        $horariosSalvos = $parametrizadorHorariosModel->carregarHorariosAtendimento();

        $this->view('parametrizador-horarios', $this->tratarArrayHorariosSalvos($horariosSalvos));

    }

    public function salvarHorariosAtendimento()
    {
        Validacoes::validarSessao($_SESSION['ultimoAcesso']);
        $horarios = $_REQUEST['horarios'];

        $segSextaValido = strtotime($horarios['semana']['segsex']['inicio']) < strtotime($horarios['semana']['segsex']['fim']);
        $sabadoValido = strtotime($horarios['semana']['sabado']['inicio']) < strtotime($horarios['semana']['sabado']['fim']);
        $domingoValido = strtotime($horarios['semana']['domingo']['inicio']) < strtotime($horarios['semana']['domingo']['fim']);

        if ( $segSextaValido === false || $sabadoValido === false || $domingoValido === false ) {
            header('Location: parametrizador-horarios?msg=Verifique%20os%20horários%20antes%20de%20salvar.');
            exit();
        }

        if ( isset($horarios['data_especifica']) ) {

            foreach($horarios['data_especifica'] as $arrayDataEspecifica) {

                if ( strtotime($arrayDataEspecifica['inicio']) > strtotime($arrayDataEspecifica['fim']) ) {
                    header('Location: parametrizador-horarios?msg=Verifique%20os%20horários%20antes%20de%20salvar.');
                    exit();
                }

            }

        }

        $parametrizadorHorariosModel = new ParametrizadorHorariosModel;
        $statusInsert = $parametrizadorHorariosModel->salvarHorariosAtendimento($this->tratarArrayHorarios($horarios));

        if ( $statusInsert ) {
            header('Location: parametrizador-horarios?msg=Horários%20parametrizados%20com%20sucesso.');
        }

    }

    private function tratarArrayHorarios($horarios)
    {

        // dias comuns
        foreach($horarios['semana'] as $diaSemana => $horario) {

            if ( $diaSemana === "segsex" ) {
                $dadosParaInserir['segsex'] = array(
                    "segunda_" . $horario['inicio'] . "x" . $horario['fim'],
                    "terca_" . $horario['inicio'] . "x" . $horario['fim'],
                    "quarta_" . $horario['inicio'] . "x" . $horario['fim'],
                    "quinta_" . $horario['inicio'] . "x" . $horario['fim'],
                    "sexta_" . $horario['inicio'] . "x" . $horario['fim']
                );
            }

            if ( $diaSemana === "sabado" ) {
                $dadosParaInserir['sabado'] = array("sabado_" . $horario['inicio'] . "x" . $horario['fim']);
            }

            if ( $diaSemana === "domingo" ) {
                $dadosParaInserir['domingo'] = array("domingo_" . $horario['inicio'] . "x" . $horario['fim']);
            }

        }

        // data especifica
        if ( isset($horarios['data_especifica']) ) {

            foreach($horarios['data_especifica'] as $key => $detalheDataEspecifica) {
    
                $arrayData = explode('-', $detalheDataEspecifica['dia']);
    
                $descricaoDataEspecifica = $arrayData[0] . $arrayData[1] . $arrayData[2]; 
    
                $dadosParaInserir['data_especifica'][] = "{$descricaoDataEspecifica}_{$detalheDataEspecifica['inicio']}x{$detalheDataEspecifica['fim']}";
    
            }

        }

        return $dadosParaInserir;

    }

    private function tratarArrayHorariosSalvos($resultados)
    {
        $arrayResultado = array();

        foreach($resultados as $item) {
            
            if ( $item['diaSemana'] !== "data_especifica" ) {

                $arrayHorario = json_decode($item['horarios']);

                $horarioSemTratativa = explode("_", $arrayHorario[0]);
                $arrayHorario = explode("x", $horarioSemTratativa[1]);

                $arrayResultado[$item['diaSemana']] = array("inicio" => $arrayHorario[0], "fim" => $arrayHorario[1]);

            }

            if ( $item['diaSemana'] === "data_especifica" ) {

                $arrayHorario = json_decode($item['horarios']);

                foreach($arrayHorario as $dadosDataEspecifica) {

                    $arrayDetalhamentoDataEspecifica = explode("_", $dadosDataEspecifica);

                    $dia = substr($arrayDetalhamentoDataEspecifica[0], 0, 4) . "-" . substr($arrayDetalhamentoDataEspecifica[0], 4, 2) . "-" . substr($arrayDetalhamentoDataEspecifica[0], 6, 2);

                    $horaInicio = substr($arrayDetalhamentoDataEspecifica[1], 0, 5);
                    $horaFim = substr($arrayDetalhamentoDataEspecifica[1], 6, 10);

                    $arrayResultado['data_especifica'][] = array(
                        
                        "dia" => $dia,
                        "inicio" => $horaInicio,
                        "fim" => $horaFim

                    );


                }

            }

        }

        return $arrayResultado;
    }

}