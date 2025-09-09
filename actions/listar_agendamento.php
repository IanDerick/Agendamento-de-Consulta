<?php
    session_start();
    require "../config/conexaodb.php";

    function listarAgendamento() {
        global $pdo;
        try {
            $sql = "SELECT 
                        AGENDAMENTO.IDAGENDAMENTO,
                        PACIENTE.CODPACIENTE,
                        PACIENTE.NOME AS PACIENTE,
                        DATE_FORMAT(DTCONSULTA, '%d/%m/%Y') AS DTCONSULTA,
                        DATE_FORMAT(HORAINICIO, '%H:%i') AS HORAINICIO,
                        DATE_FORMAT(HORAFIM, '%H:%i')   AS HORAFIM,
                        DOUTOR.CODDOUTOR,
                        DOUTOR.NOME AS DOUTOR
                    FROM 
                        AGENDAMENTO
                    INNER JOIN DOUTOR ON
                    (
                        DOUTOR.CODDOUTOR = AGENDAMENTO.CODDOUTOR
                    )
                    INNER JOIN PACIENTE ON
                    (
                        PACIENTE.CODPACIENTE = AGENDAMENTO.CODPACIENTE
                    )
                    ORDER BY DTCONSULTA, HORAINICIO ASC
                    ";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar usuários: " . $e->getMessage());
            return [];
        }
    }
?>