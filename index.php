<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Agendamento Online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">
    
    <div class="card-login">
        <h1 class="text-center mb-4">Agendamento Online</h1>
        <form action="actions/login.php" method="post">
            <div class="mb-3">
                <?php
                    if (isset($_SESSION["error"])) {
                        echo "<p style='color:red'>". $_SESSION["error"] ."</p>";
                        unset($_SESSION["error"]);
                    }
                ?>
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-lg btn-entrar">Entrar</button>
            </div>
            <div class="text-center mt-3">
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalResetSenha">Esqueci minha senha</button>
            </div>
        </form>
    </div>

    <?php include 'includes/models/modal_reset_senha.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
