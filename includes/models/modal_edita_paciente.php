<div class="modal fade" id="modalEditaPaciente" tabindex="-1" aria-labelledby="modalEditaPacienteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditaPacienteLabel">Editar Paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <?php
        if (!empty($_SESSION['msg'])) {
            echo '<div class="alert alert-info">' . htmlspecialchars($_SESSION['msg']) . '</div>';
            unset($_SESSION['msg']);
        }
        ?>

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
                <button type="submit" id="formEditaPaciente" class="btn btn-primary">Salvar</button>
            </div>
        </form>
          <!-- Upload de exame -->
        <form id="salvaExame" action="../actions/adiciona_exame.php" method="post" enctype="multipart/form-data">
          <input type="hidden" id="codpaciente_exame" name="codpaciente_exame">
            <div class="mb-3">
                <label for="imagem" class="form-label">Enviar exame (JPG ou PNG):</label>
                <input type="file" class="form-control" name="imagem" id="imagem" accept=".jpg,.png">
            </div>

            <div class="modal-footer">
                <button type="submit" id="salvaExame" class="btn btn-primary">Enviar Exame</button>
            </div>
        </form>
        <hr>
        <!-- LISTAGEM DOS EXAMES -->
        <h6>Exames enviados</h6>
        <div id="listaExames" class="mb-3">
          <div class="text-muted">Carregando exames...</div>
        </div>

      </div>
    </div>
  </div>
</div>
