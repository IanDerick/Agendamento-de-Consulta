<?php
    session_start();
    require "../config/conexaodb.php";
    $id = $_POST["codpaciente"] ?? null;
    $nome = $_POST["nome"] ?? null;
    $cpf = preg_replace('/\D/', '', $_POST['cpf']);
    $email = trim($_POST['email'] ?? '');
    $telefone = preg_replace('/\D/', '', $_POST['telefone']);
    $tamanho = strlen($telefone);
    $tamanhoCPF = strlen($cpf);
    if (!$id) {
        $_SESSION['error'] = "ID do paciente não informado!";
        header("Location: ../pages/novo_paciente.php");
        exit();
    }
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!$nome || !$cpf || !$email || !$telefone) {
        $_SESSION['error'] = "Todos os campos são obrigatórios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "E-mail inválido!";
    } elseif ($tamanho < 11) {
        $_SESSION['error'] = "Número de celular inválido!";
    } elseif ($tamanhoCPF < 11) {
        $_SESSION['error'] = "Número de CPF inválido!";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE PACIENTE SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone WHERE CODPACIENTE = :id");
            $stmt->execute([
                ':id' => $id,
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':email' => $email,
                ':telefone' => $telefone,
            ]);
            $_SESSION['success'] = "Paciente atualizado com sucesso!";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Erro ao atualizar no banco: " . $e->getMessage();
        }
    }
    header("Location: ../pages/novo_paciente.php");
    exit();
?>