<?php
    session_start();

    require "../config/conexaodb.php";

    $email = $_POST["email"] ?? '';
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = $_POST["senha"] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


    $stmt = $pdo->prepare("SELECT * FROM doutor WHERE email = ?");
    $stmt->execute([$email]);
    $doutor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['senha'])) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'tipo' => 'usuario'
        ];
        header("Location: ../pages/agenda.php");
        exit();
    } elseif ($doutor && password_verify($password, $doutor['senha']) && $doutor['status'] == 1) {
        $_SESSION['doutor'] = [
            'id' => $doutor['coddoutor'],
            'nome' => $doutor['nome'],
            'status' => $doutor['status']
        ];
        header("Location: ../pages/agendaDoutor.php");
        exit();
    } else {
        $_SESSION['error'] = "Usuário ou senha inválido!";
        header("Location: ../index.php");
        exit();
    }
?>