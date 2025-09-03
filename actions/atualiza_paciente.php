<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require "../config/conexaodb.php";
    $id = $_POST["codpaciente"] ?? null;
    $nome = $_POST["nome"] ?? null;
    $cpf = $_POST["cpf"] ?? null;
    $email = $_POST["email"] ?? null;
    $telefone = $_POST["telefone"] ?? null;
    if (!$id) {
        $_SESSION['error'] = "ID do paciente não informado!";
        header("Location: ../pages/novo_paciente.php");
        exit();
    }
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $pdo->prepare("UPDATE PACIENTE SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone WHERE CODPACIENTE = :id");
        $stmt->execute([
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':email' => $email,
            ':telefone' => $telefone,
            ':id' => $id
        ]);
        $_SESSION['success'] = "Paciente atualizado com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro ao atualizar no banco: " . $e->getMessage();
    }
    header("Location: ../pages/novo_paciente.php");
    exit();
?>