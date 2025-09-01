<?php
session_start();

require "../config/conexaodb.php";

$email = $_POST["email"] ?? '';
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$password = $_POST["senha"] ?? '';

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($password, $usuario['senha'])) {
    session_regenerate_id(true);
    $_SESSION['usuario'] = $usuario['nome'];
    header("Location: ../pages/agenda.php");
    exit();
} else {
    $_SESSION['error'] = "Usuário ou senha inválido!";
    header("Location: ../index.php");
    exit();
}
