<?php 
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit(); 
    }
    require "../actions/listar_agendamento.php";
    $dataSelecionada = $_GET['data'] ?? date('Y-m-d');

    $agendamentos = listarAgendamento($dataSelecionada);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h1">Agenda</h1>
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
                <button type="button" class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalNovoAgendamento">
                    <i class="bi bi-plus me-10"></i>
                </button>
            </div>
            <form method="get" class="d-flex justify-content-end mb-3">
                <div class="me-3">
                    <a class="btn btn-primary" href="relatorio.php">
                        <i class="bi bi-filetype-pdf"></i>
                        Relatório 
                    </a>
                </div>
                <input type="date" name="data" class="form-control me-2" style="max-width: 180px;"  
                    value="<?= htmlspecialchars($_GET['data'] ?? date('Y-m-d')) ?>">
                <button type="submit" class="btn btn-filtrar">Filtrar</button>
            </form> 
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Horário <i class="bi bi-clock"></i></th>
                        <th scope="col">Data <i class="bi bi-calendar2-week"></i></th>
                        <th scope="col">Nome <i class="bi bi-person"></i></th>
                        <th scope="col">Doutor <i class="bi bi-person"></i></th>
                        <th scope="col"><i class="bi bi-three-dots"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($agendamentos): ?>
                        <?php foreach ($agendamentos as $a): ?>
                            <tr>
                                <th scope="row">
                                    <?= htmlspecialchars($a['HORAINICIO']) ?> - <?= htmlspecialchars($a['HORAFIM']) ?>
                                </th>
                                <td><?= htmlspecialchars($a['DTCONSULTA']) ?></td>
                                <td><?= htmlspecialchars($a['PACIENTE']) ?></td>
                                <td><?= htmlspecialchars($a['DOUTOR']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"  data-bs-target="#modalEditaAgendamento"
                                            data-idagendamento="<?= $a['IDAGENDAMENTO'] ?>"
                                            data-codpaciente="<?= htmlspecialchars($a['CODPACIENTE']) ?>"
                                            data-nome="<?= htmlspecialchars($a['PACIENTE']) ?>"
                                            data-email="<?= htmlspecialchars($a['EMAIL'] ?? '') ?>"
                                            data-data="<?= htmlspecialchars($a['DTCONSULTA']) ?>"
                                            data-horainicio="<?= htmlspecialchars($a['HORAINICIO']) ?>"
                                            data-horafim="<?= htmlspecialchars($a['HORAFIM']) ?>"
                                            data-doutor="<?= (int)$a['CODDOUTOR'] ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <a href="../actions/exclui_agendamento.php?idagendamento=<?= (int)$a['IDAGENDAMENTO'] ?>"
                                    class="btn btn-outline-danger btn-sm ms-2 btn-excluir"
                                    data-id="<?= (int)$a['IDAGENDAMENTO'] ?>">
                                    <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">Nenhum agendamento encontrado</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>
<div id="loadingOverlay" 
     style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.25); display: none;
            align-items: center; justify-content: center; z-index: 9999;">
    <?php include '../includes/load.php'; ?>
</div>
<?php include '../includes/models/modal_novo_agendamento.php'; ?>
<?php include '../includes/models/modal_edita_agendamento.php'; ?>
<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
    