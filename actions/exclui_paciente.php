<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require "../config/conexaodb.php";
    
    $id = $_GET["codpaciente"] ?? null;
    if (!$id) {
        $_SESSION['error'] = "ID do paciente não informado!";
        header("Location: ../pages/novo_paciente.php");
        exit();
    }
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $pdo->prepare("DELETE FROM PACIENTE WHERE CODPACIENTE = ?");
        $stmt->execute([$id]);
        $_SESSION['success'] = "Paciente deletado com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro ao excluir no banco: " . $e->getMessage();
    }
    header("Location: ../pages/novo_paciente.php");
    exit();
?>