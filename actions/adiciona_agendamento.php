<?php
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

            // redireciona de volta para a agenda
            header("Location: ../pages/agenda.php");
            exit;
        } catch (PDOException $e) {
            die("Erro ao salvar agendamento: " . $e->getMessage());
        }
    } else {
        die("Preencha todos os campos.");
    }
} else {
    header("Location: agenda.php");
    exit;
}
