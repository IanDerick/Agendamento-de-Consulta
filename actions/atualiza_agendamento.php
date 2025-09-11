<?php
    session_start();
    require "../config/conexaodb.php";

    $id = $_POST["idagendamento"] ?? null;
    $nome = $_POST["nomePaciente"] ?? null;
    $email = $_POST["emailPaciente"] ?? null;
    $data = $_POST["dataConsulta"] ?? null;
    $horaInicio = $_POST["horarioInicial"] ?? null;
    $horaFim = $_POST["horariFinal"] ?? null;
    $coddoutor = $_POST["SelectDoutor"] ?? null;

    if (!$id) {
        $_SESSION['error'] = "ID do agendamento não informado!";
        header("Location: ../pages/agenda.php");
        exit();
    }

    try {
        $sql = "UPDATE AGENDAMENTO 
                SET DTCONSULTA = :dt,
                    HORAINICIO = :hinicio,
                    HORAFIM = :hfim,
                    CODDOUTOR = :doutor
                WHERE IDAGENDAMENTO = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
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
?>