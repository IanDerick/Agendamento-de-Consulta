<div class="modal fade" id="modalNovoPaciente" tabindex="-1" aria-labelledby="modalNovoPacienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoPacienteLabel">Novo Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNovoPaciente" action="../actions/adiciona_paciente.php" method="post">
                    <div class="row">
                        <div class="col-md-20">
                            <div class="d-flex justify-content-center">
                                <div class="mb-3 text-center">
                                    <i class="bi bi-person-circle display-1 text-secondary"></i>
                                    <small class="d-block mt-2 ">Nome</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nomePaciente" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF:</label>
                                <input type="number" class="form-control" id="CPFPaciente" name="cpf" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="email" class="form-control" id="emailPaciente" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone:</label>
                                <input type="tel" class="form-control" id="telefonePaciente" name="telefone" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                <button type="submit" form="formNovoPaciente" class="btn btn-green">Salvar</button>
            </div>
                </form>
            </div>
        </div>
    </div>
</div>