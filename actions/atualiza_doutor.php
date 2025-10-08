<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require "../config/conexaodb.php";

    $id = $_POST["coddoutor"] ?? null;
    $nome = $_POST["nome"] ?? null;
    $email = $_POST["email"] ?? null;
    $status = $_POST["status"] ?? null;
    $novaSenha = $_POST["novaSenha"] ?? null;
    $confirmNovaSenha = $_POST["confirmNovaSenha"] ?? null;
    if (!$id) {
        $_SESSION['error'] = "ID do doutor não informado!";
        header("Location: ../pages/novo_doutor.php");
        exit();
    }
    if ($id && $nome && $email || $status) {
        $sql = "UPDATE DOUTOR SET nome = :nome, email = :email, status = :status";
        $params = [
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email,
            ':status' => $status
        ];
    
        if (!empty($novaSenha) || !empty($confirmNovaSenha)) {
            if ($novaSenha === $confirmNovaSenha) {
                $params[':senha'] = password_hash($novaSenha, PASSWORD_DEFAULT);
                $sql .= ", senha = :senha";
            } else {
                $_SESSION['error'] = "As senhas não conferem!";
                header("Location: ../pages/novo_doutor.php");
                exit();
            }
        }
    
        $sql .= " WHERE CODDOUTOR = :id";
    
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $_SESSION['success'] = "Doutor atualizado com sucesso!";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Erro ao atualizar no banco: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Preencha todos os campos obrigatórios!";
    }
        
    header("Location: ../pages/novo_doutor.php");
    exit();
?>
