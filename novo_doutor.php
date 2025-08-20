<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doutores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-1 col-lg-1 d-md-block sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="agenda.php">
                            <i class="bi bi-calendar fs-3"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="novo_doutor.php">
                            <i class="bi bi-person-fill fs-3"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="novo_paciente.php">
                            <i class="bi bi-people-fill fs-3"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 col-lg-11 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h1">Doutores</h1>
                <button type="button" class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalNovoDoutor">
                    <i class="bi bi-plus me-10"></i>
                </button>
            </div>

            <div class="d-flex justify-content-between align-items-center list-item pt-10 pb-2 mb-3 border-bottom">
                <span>Dr. Bruno</span>
                <div class="button-group">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalNovoDoutor">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm ms-2">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center list-item pt-10 pb-2 mb-3 border-bottom">
                <span>Dra. Rafaela</span>
                <div class="button-group">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalNovoDoutor">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <a href="#" class="btn btn-outline-danger btn-sm ms-2">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include 'includes/modal_novo_doutor.php'; ?>
<script src="/agendamento-de-consulta/assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
