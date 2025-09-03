<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require "../config/conexaodb.php";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $status = 1;
        $tamanho = strlen($telefone);

        if (!$nome || !$cpf || !$email || !$telefone) {
            $_SESSION['error'] = "Todos os campos são obrigatórios.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "E-mail inválido!";
        } elseif ($tamanho < 11) {
            $_SESSION['error'] = "Número de celular inválido!";
        } else {
            $stmt = $pdo->prepare("SELECT CPF FROM PACIENTE WHERE CPF = ?");
            $stmt->execute([$cpf]);

            if ($stmt->fetch()) {
                $_SESSION['error'] = "CPF já cadastrado.";
            } else {
                try {
                    $stmt = $pdo->prepare("INSERT INTO PACIENTE (nome, cpf, email, telefone, status) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$nome, $cpf, $email, $telefone, $status]);
                    $_SESSION['success'] = "Paciente criado com sucesso!";
                } catch (PDOException $e) {
                    $_SESSION['error'] = "Erro ao salvar no banco: " . $e->getMessage();
                }
            }
        }

        header("Location: ../pages/novo_paciente.php");
        exit();
    } else {
        header("Location: ../pages/novo_paciente.php");
        exit();
    }
?>