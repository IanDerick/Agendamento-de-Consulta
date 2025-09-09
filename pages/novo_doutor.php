<?php 
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }
    require "../actions/listar_doutor.php";
    $doutor = listarDoutor();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doutores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/estilo.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-1 col-lg-1 d-flex flex-column justify-content-between sidebar">
            <?php include '../includes/navbar.php'; ?>
        </nav>
        <main class="col-md-9 col-lg-11 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
                <h1 class="h1">Doutores</h1>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            <?= $_SESSION['success']; ?>
                            <?php unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            <?= $_SESSION['error']; ?>
                            <?php unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                <button type="button" class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalNovoDoutor">
                    <i class="bi bi-plus me-10"></i>
                </button>
            </div>

            <?php if (!empty($doutor)): ?>
                <?php foreach ($doutor as $d): ?>
                    <div class="d-flex justify-content-between align-items-center list-item pt-2 pb-2 mb-3 border-bottom">
                        <span><?=htmlspecialchars($d['nome']) ?></span>
                        <div class="button-group">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaDoutor" 
                                    data-id="<?= $d['coddoutor'] ?>"
                                    data-nome="<?= htmlspecialchars($d['nome']) ?>"
                                    data-email="<?= htmlspecialchars($d['email']) ?>"
                                    data-status="<?= htmlspecialchars($d['status']) ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="../actions/exclui_doutor.php?coddoutor=<?= htmlspecialchars($d['coddoutor']) ?>" class="btn btn-outline-danger btn-sm ms-2" onclick="return confirm('Deseja excluir este doutor?');">
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
<?php include '../includes/models/modal_novo_doutor.php'; ?>
<?php include '../includes/models/modal_edita_doutor.php';?>
<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
