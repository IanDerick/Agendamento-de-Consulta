<div class="modal fade" id="modalNovoPaciente" tabindex="-1" aria-labelledby="modalNovoPacienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoPacienteLabel">Novo Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="nomePaciente" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nomePaciente" name="nomePaciente" required>
                            </div>
                            <div class="mb-3">
                                <label for="emailPaciente" class="form-label">E-mail:</label>
                                <input type="email" class="form-control" id="emailPaciente" name="emailPaciente" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefonePaciente" class="form-label">Telefone:</label>
                                <input type="tel" class="form-control" id="telefonePaciente" name="telefonePaciente">
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="mb-3">
                                <i class="bi bi-person-circle display-1 text-secondary"></i>
                                <small class="d-block mt-2">Nome:</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="formNovoPaciente" class="btn btn-green">Salvar</button>
            </div>
        </div>
    </div>
</div>