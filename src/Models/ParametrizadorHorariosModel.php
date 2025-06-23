<?php

namespace App\Models;

use App\Configs\Database;
use PDO;

class ParametrizadorHorariosModel extends Database {

    private $tabelaHorariosAtendimento;

    public function __construct()
    {
        $this->tabelaHorariosAtendimento = "horarios_atendimento";
        parent::__construct(); // Chama o construtor de Database (responsável pela conexão)
    }

    public function salvarHorariosAtendimento($horarios)
    {
        $statusGeral = true; // Assume sucesso

        if ( !isset($horarios['data_especifica']) ) {

            // Deleta o registro de 'data_especifica' se existir
            $sql = "DELETE FROM $this->tabelaHorariosAtendimento WHERE diaSemana = 'data_especifica'";
            $stmt = $this->conexao->prepare($sql);
            $executou = $stmt->execute();

            if (!$executou) {
                $statusGeral = false;
            }

        }

        foreach($horarios as $diaSemana => $horariosDoDia) {

            $jsonHorarios = json_encode($horariosDoDia);

            $sql = "INSERT INTO $this->tabelaHorariosAtendimento (diaSemana, horarios) 
                    VALUES (?, ?) 
                    ON DUPLICATE KEY UPDATE horarios = VALUES(horarios)";

            $stmt = $this->conexao->prepare($sql);
            $executou = $stmt->execute([$diaSemana, $jsonHorarios]);

            if (!$executou) {
                $statusGeral = false; // Se falhou, marca falso
            }
        }

        return $statusGeral;
    }

    public function carregarHorariosAtendimento()
    {
        
        $sql = "SELECT diaSemana, horarios FROM $this->tabelaHorariosAtendimento";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}