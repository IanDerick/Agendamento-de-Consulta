<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require "../config/conexaodb.php";
    
    $id = $_GET["coddoutor"] ?? null;
    if (!$id) {
        $_SESSION['error'] = "ID do doutor não informado!";
        header("Location: ../pages/novo_paciente.php");
        exit();
    }
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $pdo->prepare("DELETE FROM DOUTOR WHERE CODDOUTOR = ?");
        $stmt->execute([$id]);
        //$_SESSION['success'] = "Doutor deletado com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro ao excluir no banco: " . $e->getMessage();
    }
    header("Location: ../pages/novo_doutor.php");
    exit();
?>