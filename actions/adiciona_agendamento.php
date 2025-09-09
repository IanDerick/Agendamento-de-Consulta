<?php
    session_start();
    require "../config/conexaodb.php"; // ajuste o caminho se necessário

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $codpaciente = $_POST["codpaciente"] ?? null;
        $dtconsulta = $_POST["dtconsulta"] ?? null;
        $horainicio = $_POST["horainicio"] ?? null;
        $horafim = $_POST["horafim"] ?? null;
        $coddoutor = $_POST["SelectDoutor"] ?? null;

        if ($codpaciente && $dtconsulta && $horainicio && $horafim && $coddoutor) {
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO agendamento (codpaciente, dtconsulta, horainicio, horafim, coddoutor)
                    VALUES (:codpaciente, :dtconsulta, :horainicio, :horafim, :coddoutor)
                ");
                $stmt->execute([
                    ":codpaciente" => $codpaciente,
                    ":dtconsulta" => $dtconsulta,
                    ":horainicio" => $horainicio,
                    ":horafim" => $horafim,
                    ":coddoutor" => $coddoutor
                ]);
                $_SESSION['success'] = "Agendmaento criado com sucesso!";
                // redireciona de volta para a agenda
                header("Location: ../pages/agenda.php");
                exit;
            } catch (PDOException $e) {
                $_SESSION['error'] = "Erro ao salvar no banco: " . $e->getMessage();
            }
        } else {
            $_SESSION['error'] = "Erro ao salvar no banco: " . $e->getMessage();
        }
    } else {
        header("Location: ../pages/agenda.php");
        exit;
    }
?>