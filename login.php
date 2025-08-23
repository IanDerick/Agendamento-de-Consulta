<?php
session_start();

try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=meubanco", "root", "");//casa
    //$pdo = new PDO("mysql:host=localhost;port=3307;dbname=meubanco", "root", "root"); //faculdade
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao se conectar ao banco: " . $e->getMessage());
}

$email = $_POST["email"] ?? '';
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$password = $_POST["senha"] ?? '';

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($password, $usuario['senha'])) {
    session_regenerate_id(true);
    $_SESSION['usuario'] = $usuario['nome'];
    header("Location: agenda.php");
    exit();
} else {
    $_SESSION['error'] = "Usuário ou senha inválido!";
    header("Location: index.php");
    exit();
}
?>