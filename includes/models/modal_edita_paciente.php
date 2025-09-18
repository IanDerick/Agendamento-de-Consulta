<?php
session_start();
include "../../config/conexaodb.php";

// ======== PROCESSAMENTO DE UPLOAD ========
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {

    $arquivo = $_FILES['imagem'];

    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['msg'] = "Falha ao enviar arquivo.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Caminho físico para salvar os arquivos
    $pasta = __DIR__ . "/../../includes/models/arquivos/";
    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }

    $nomeOriginal = $arquivo['name'];
    $novoNome     = uniqid();
    $extensao     = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    if (!in_array($extensao, ['jpg', 'png'])) {
        $_SESSION['msg'] = "Tipo de arquivo não aceito.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    $caminhoFisico = $pasta . $novoNome . "." . $extensao;
    $caminhoBanco  = "/Agendamento-de-Consulta/includes/models/arquivos/" . $novoNome . "." . $extensao;

    if (move_uploaded_file($arquivo['tmp_name'], $caminhoFisico)) {
        try {
            $sql = "INSERT INTO EXAMES (codpaciente, arquivo, reccreatedon)
                    VALUES (:codpaciente, :arquivo, NOW())";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':codpaciente', 1, PDO::PARAM_INT);
            $stmt->bindValue(':arquivo', $caminhoBanco, PDO::PARAM_STR);
            $stmt->execute();

            $_SESSION['msg'] = "Registro inserido com sucesso!";
        } catch (PDOException $e) {
            $_SESSION['msg'] = "Erro ao inserir: " . $e->getMessage();
        }
    } else {
        $_SESSION['msg'] = "Falha ao mover arquivo.";
    }

    // Redireciona para evitar reenvio no F5
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// ======== CONSULTA PARA LISTAGEM ========
$sql_query = $pdo->query(
    "SELECT arquivo, reccreatedon FROM EXAMES ORDER BY reccreatedon DESC"
);
?>

<div class="modal fade" id="modalEditaPaciente" tabindex="-1" aria-labelledby="modalEditaPacienteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditaPacienteLabel">Editar Paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Exibe mensagens de sucesso/erro -->
        <?php
        if (!empty($_SESSION['msg'])) {
            echo '<div class="alert alert-info">' . htmlspecialchars($_SESSION['msg']) . '</div>';
            unset($_SESSION['msg']);
        }
        ?>

        <!-- ÚNICO FORMULÁRIO: dados do paciente + upload -->
        <form id="formEditaPaciente" action="../actions/atualiza_paciente.php" method="post" enctype="multipart/form-data">

          <input type="hidden" id="codpaciente" name="codpaciente">

          <div class="mb-3 text-center">
            <i class="bi bi-person-circle display-1 text-secondary"></i>
            <small class="d-block mt-2" id="previewNome"></small>
          </div>

          <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
          </div>

          <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input type="number" class="form-control" id="cpf" name="cpf">
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="tel" class="form-control" id="telefone" name="telefone">
          </div>
          <div class="modal-footer">
                <button type="submit" id="formEditaPaciente" class="btn btn-primary">Salvar e Enviar</button>
            </div>
        </form>
          <!-- Upload de exame -->
        <form id="salvaExame" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="imagem" class="form-label">Enviar exame (JPG ou PNG):</label>
                <input type="file" class="form-control" name="imagem" id="imagem" accept=".jpg,.png">
            </div>

            <div class="modal-footer">
                <button type="submit" id="salvaExame" class="btn btn-primary">Salvar e Enviar</button>
            </div>
        </form>
        <hr>
        <!-- LISTAGEM DOS EXAMES -->
        <h6>Exames enviados</h6>
        <?php while ($linha = $sql_query->fetch(PDO::FETCH_ASSOC)) { ?>
          <div class="mb-1">
            <a href="<?php echo htmlspecialchars($linha['arquivo']); ?>" target="_blank">
              <?php echo basename($linha['arquivo']); ?>
            </a>
            <small class="text-muted">
              - <?php echo date("d/m/Y H:i", strtotime($linha['reccreatedon'])); ?>
            </small>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
