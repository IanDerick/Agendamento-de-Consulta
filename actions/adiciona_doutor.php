<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require "../config/conexaodb.php";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');
        $status = $_POST['status'];

        if (!$nome || !$email || !$senha || $status === null) {
            $_SESSION['error'] = "Todos os campos são obrigatórios.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "E-mail inválido!";
        } else {
            $stmt = $pdo->prepare("SELECT EMAIL FROM DOUTOR WHERE EMAIL = ?");
            $stmt->execute([$email]);

            if ($stmt->fetch()) {
                $_SESSION['error'] = "E-mail já cadastrado.";
            } else {
                try {
                    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO DOUTOR (nome, email, senha, status) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$nome, $email, $senhaHash, $status]);
                    $_SESSION['success'] = "Doutor criado com sucesso!";
                } catch (PDOException $e) {
                    $_SESSION['error'] = "Erro ao salvar no banco: " . $e->getMessage();
                }
            }
        }
        header("Location: ../pages/novo_doutor.php");
        exit();
    } else {
        header("Location: ../pages/novo_doutor.php");
        exit();
    }
?>