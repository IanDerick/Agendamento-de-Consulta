<?php
    session_start();
    require "../config/conexaodb.php";

    function listarAgendamento($data = null) {
        global $pdo;
        try {
            if (!$data) {
                $data = date('Y-m-d'); // padrão: hoje
            }
    
            $sql = "SELECT 
                        AGENDAMENTO.IDAGENDAMENTO,
                        PACIENTE.CODPACIENTE,
                        PACIENTE.NOME AS PACIENTE,
                        PACIENTE.EMAIL AS EMAIL,
                        DATE_FORMAT(DTCONSULTA, '%d/%m/%Y') AS DTCONSULTA,
                        DATE_FORMAT(HORAINICIO, '%H:%i') AS HORAINICIO,
                        DATE_FORMAT(HORAFIM, '%H:%i')   AS HORAFIM,
                        DOUTOR.CODDOUTOR,
                        DOUTOR.NOME AS DOUTOR
                    FROM 
                        AGENDAMENTO
                    INNER JOIN DOUTOR 
                        ON DOUTOR.CODDOUTOR = AGENDAMENTO.CODDOUTOR
                    INNER JOIN PACIENTE 
                        ON PACIENTE.CODPACIENTE = AGENDAMENTO.CODPACIENTE
                    WHERE DATE(dtconsulta) = :data
                    ORDER BY DTCONSULTA, HORAINICIO ASC";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':data' => $data]);
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar agendamentos: " . $e->getMessage());
            return [];
        }
    }    
?>