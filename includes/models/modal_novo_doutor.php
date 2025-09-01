<div class="modal fade" id="modalNovoDoutor" tabindex="-1" aria-labelledby="modalNovoDoutorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoDoutorLabel">Novo Doutor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNovoDoutor" action="#" method="post">
                    <div class="mb-3">
                        <label for="nomeDoutor" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nomeDoutor" name="nomeDoutor" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailDoutor" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" id="emailDoutor" name="emailDoutor" required>
                    </div>
                    <div class="mb-3">
                        <label for="senhaDoutor" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="senhaDoutor" name="senhaDoutor" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="alterarSenha" name="alterarSenha">
                        <label class="form-check-label" for="alterarSenha">Ativo?</label>
                    </div>
                    <div class="mb-3">
                        <label for="corDoutor" class="form-label">Cor do Doutor</label>
                        <input type="color" class="form-control form-control-color" id="corDoutor" name="corDoutor">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="formNovoDoutor" class="btn btn-green">Salvar</button>
            </div>
        </div>
    </div>
</div>
