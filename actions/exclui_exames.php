<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require "../config/conexaodb.php";

    $id = filter_input(INPUT_GET, 'idexames', FILTER_VALIDATE_INT);
    if (!$id) {
        $_SESSION['msg'] = "ID inválido.";
        header("Location: ../pages/novo_paciente.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT arquivo FROM EXAMES WHERE idexames = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $caminho = $_SERVER['DOCUMENT_ROOT'] . $row['arquivo'];
        if (file_exists($caminho)) {
            unlink($caminho);
        }

        $del = $pdo->prepare("DELETE FROM EXAMES WHERE idexames = :id");
        $del->bindValue(':id', $id, PDO::PARAM_INT);
        $del->execute();
        $_SESSION['msg'] = "Exame excluído com sucesso.";
    } else {
        $_SESSION['msg'] = "Exame não encontrado.";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
?>