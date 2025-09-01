<div class="modal fade" id="modalResetSenha" tabindex="-1" aria-labelledby="modalResetSenhaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalResetSenhaLabel">Redefinir Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-md-20">
                            <div class="mb-3">
                                <label for="emailPaciente" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="emailPaciente" name="emailPaciente" required>
                            </div>
                            <div class="mb-3">
                                <label for="novaSenha" class="form-label">Nova senha</label>
                                <input type="password" class="form-control" id="novaSenha" name="novaSenha" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmaNovaSenha" class="form-label">Confirme a senha</label>
                                <input type="password" class="form-control" id="confirmaNovaSenha" name="confirmaNovaSenha" required>
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