<?php
session_start();
require "../config/conexaodb.php";

$id = $_POST["idagendamento"] ?? null;
$codpaciente = $_POST["codpaciente"] ?? null;
$nome = $_POST["nome"] ?? null;
$email = $_POST["email"] ?? null;
$data = $_POST["dtconsulta"] ?? null;
$horaInicio = $_POST["horainicio"] ?? null;
$horaFim = $_POST["horafim"] ?? null;
$coddoutor = $_POST["selectDoutorEdita"] ?? null;

if (!$id) {
    $_SESSION['error'] = "ID do agendamento não informado!";
    header("Location: ../pages/agenda.php");
    exit();
}

if (empty($codpaciente) || !is_numeric($codpaciente)) {
    $_SESSION['error'] = "Paciente inválido ou não selecionado!";
    header("Location: ../pages/agenda.php");
    exit();
}

try {
    $sql = "UPDATE AGENDAMENTO 
            SET CODPACIENTE = :codpaciente,
                DTCONSULTA = :dt,
                HORAINICIO = :hinicio,
                HORAFIM = :hfim,
                CODDOUTOR = :doutor
            WHERE IDAGENDAMENTO = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':codpaciente' => $codpaciente,
        ':dt' => $data,
        ':hinicio' => $horaInicio,
        ':hfim' => $horaFim,
        ':doutor' => $coddoutor,
        ':id' => $id
    ]);

    $_SESSION['success'] = "Agendamento atualizado com sucesso!";
} catch (PDOException $e) {
    $_SESSION['error'] = "Erro ao atualizar agendamento: " . $e->getMessage();
}

header("Location: ../pages/agenda.php");
exit();
