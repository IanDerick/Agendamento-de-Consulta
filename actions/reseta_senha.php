<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require "../config/conexaodb.php";

    $email = $_POST["email"] ?? null;
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $novaSenha = $_POST["novaSenha"] ?? null;
    $confirmNovaSenha = $_POST["confirmNovaSenha"] ?? null;

    if (!$email) {
        $_SESSION['error'] = "Informe o e-mail!";
        header("Location: ../index.php");
        exit();
    }

    if ($novaSenha && $confirmNovaSenha) {
        if ($novaSenha === $confirmNovaSenha) {
            try {
                $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
                $sql1 = "UPDATE usuarios SET senha = :senha WHERE email = :email";
                $stmt1 = $pdo->prepare($sql1);
                $stmt1->execute([
                    ':senha' => $senhaHash,
                    ':email' => $email
                ]);
                if ($stmt1->rowCount() > 0) {
                    $_SESSION['success'] = "Senha do usuário atualizada com sucesso!";
                } else {
                    $sql2 = "UPDATE doutor SET senha = :senha WHERE email = :email";
                    $stmt2 = $pdo->prepare($sql2);
                    $stmt2->execute([
                        ':senha' => $senhaHash,
                        ':email' => $email
                    ]);
                    if ($stmt2->rowCount() > 0) {
                        $_SESSION['success'] = "Senha do doutor atualizada com sucesso!";
                    } else {
                        $_SESSION['error'] = "E-mail não encontrado em usuários ou doutores.";
                    }
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = "Erro ao atualizar no banco: " . $e->getMessage();
            }
        } else {
            $_SESSION['error'] = "As senhas não conferem!";
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Preencha os dois campos de senha!";
    }
    header("Location: ../index.php");
    exit();
?>
