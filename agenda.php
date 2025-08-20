<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h1">Agenda</h1>
                <button type="button" class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalNovoAgendamento">
                    <i class="bi bi-plus me-10"></i>
                </button>
            </div>
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Horário
                        <i class="bi bi-clock"></i>
                    </th>
                    <th scope="col">Dia-semana
                        <i class="bi bi-calendar2-week"></i>
                    </th>
                    <th scope="col">Nome
                        <i class="bi bi-person"></i>
                    </th>
                    <th scope="col">Doutor
                        <i class="bi bi-person"></i>
                    </th>
                    <th scope="col">
                        <i class="bi bi-three-dots"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">09:00 - 10:00 </th>
                <td>Segunda-feira</td>
                <td>Andrea Silmara</td>
                <td>Dr. Rafaela</td>
                <td>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaAgendamento">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                </tr>
                <tr>
                <th scope="row">10:00 - 11:00</th>
                <td>Segunda-feira</td>
                <td>Ian Derick</td>
                <td>Dr. Bruno</td>
                <td>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaAgendamento">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                </tr>
                <tr>
                <th scope="row">11:00 - 12:00</th>
                <td>Segunda-Feira</td>
                <td>Bruna Camille</td>
                <td>Dr. Rafaela</td>
                <td>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaAgendamento">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                </tr>
                <tr>
                <th scope="row">13:00 - 14:00 </th>
                <td>Segunda-feira</td>
                <td>Caio Santos</td>
                <td>Dr. Bruno</td>
                <td>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaAgendamento">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                </tr>
                <tr>
                <th scope="row">14:00 - 15:00 </th>
                <td>Segunda-feira</td>
                <td>João Rieger</td>
                <td>Dr. Bruno</td>
                <td>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaAgendamento">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                </tr>
                <tr>
                <th scope="row">15:00 - 16:00 </th>
                <td>Segunda-feira</td>
                <td>Paula Leão</td>
                <td>Dr. Rafaela</td>
                <td>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaAgendamento">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                </tr>
                <tr>
                <th scope="row">16:00 - 17:00 </th>
                <td>Segunda-feira</td>
                <td>Munique Nascimento</td>
                <td>Dr. Rafaela</td>
                <td>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaAgendamento">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                </tr>
                <tr>
                <th scope="row">17:00 - 18:00 </th>
                <td>Segunda-feira</td>
                <td>Ivan Rodrigues</td>
                <td>Dr. Bruno</td>
                <td>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditaAgendamento">
                        <i class="bi bi-pencil"></i>
                    </button>
                </td>
                </tr>
            </tbody>
            </table>
        </main>
    </div>
</div>
    <?php include 'includes/modal_novo_agendamento.php'; ?>
    <?php include 'includes/modal_edita_agendamento.php'; ?>
    <script src="/agendamento-de-consulta/assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>