<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require "../config/conexaodb.php";
    
    $id = $_GET["idagendamento"] ?? null;
    if (!$id) {
        $_SESSION['error'] = "ID do agendamento não informado!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $pdo->prepare("DELETE FROM AGENDAMENTO WHERE IDAGENDAMENTO = ?");
        $stmt->execute([$id]);
        $_SESSION['success'] = "Agendamento deletado com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro ao excluir no banco: " . $e->getMessage();
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
?>