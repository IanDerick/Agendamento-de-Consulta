<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require "listar_paciente.php";
$usuarios = listarUsuarios();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-1 col-lg-1 d-flex flex-column justify-content-between sidebar">
            <div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="agenda.php"><i class="bi bi-calendar fs-3"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="novo_paciente.php"><i class="bi bi-people-fill fs-3"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="novo_doutor.php"><i class="bi bi-person-fill fs-3"></i></a></li>
                </ul>
            </div>
            <div class="menu-inferior">
                <a href="logout.php" class="nav-link"><i class="bi bi-box-arrow-right fs-3"></i></a>
            </div>
        </nav>

        <main class="col-md-9 col-lg-11 px-md-4 main-content">
             <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h1">Pacientes</h1>
                <button type="button" class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalNovoPaciente">
                    <i class="bi bi-plus me-10"></i>
                </button>
            </div>

            <!-- LISTA DE USUÁRIOS -->
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $u): ?>
                    <div class="d-flex justify-content-between align-items-center list-item pt-2 pb-2 mb-3 border-bottom">
                        <span><?= htmlspecialchars($u['nome']) ?></span>
                        <div class="button-group">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaPaciente" data-id="<?= $u['id'] ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="excluir_usuario.php?id=<?= $u['id'] ?>" class="btn btn-outline-danger btn-sm ms-2" onclick="return confirm('Deseja excluir este usuário?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Nenhum usuário cadastrado.</p>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php include 'includes/modal_novo_paciente.php'; ?>
<?php include 'includes/modal_edita_paciente.php'; ?>
<script src="/agendamento-de-consulta/assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/agendamento-de-consulta/js/script.js"></script>
</body>
</html>
