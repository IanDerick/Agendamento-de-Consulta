<div class="modal fade" id="modalNovoDoutor" tabindex="-1" aria-labelledby="modalNovoDoutorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoDoutorLabel">Novo Doutor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNovoDoutor" action="../actions/adiciona_doutor.php" method="post">
                    <div class="d-flex justify-content-center">
                        <div class="mb-3 text-center">
                            <i class="bi bi-person-circle display-1 text-secondary"></i>
                            <small class="d-block mt-2 ">Nome</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nomeDoutor" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" id="emailDoutor" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="senhaDoutor" name="senha" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" id="ativo" name="status" value="1">
                        <label class="form-check-label" for="ativo">Ativo</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" id="inativo" name="status" value="0">
                        <label class="form-check-label" for="inativo">Inativo</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                        <button type="submit" form="formNovoDoutor" class="btn btn-green">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
