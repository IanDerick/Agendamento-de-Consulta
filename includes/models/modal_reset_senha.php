<div class="modal fade" id="modalResetSenha" tabindex="-1" aria-labelledby="modalResetSenhaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalResetSenhaLabel">Redefinir Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formResetSenha" action="<?php echo dirname($_SERVER['PHP_SELF']); ?>/actions/reseta_senha.php" method="post">
                    <div class="row">
                        <div class="col-md-20">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="novaSenha" class="form-label">Nova senha</label>
                                <input type="password" class="form-control" id="novaSenha" name="novaSenha" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmNovaSenha" class="form-label">Confirme a senha</label>
                                <input type="password" class="form-control" id="confirmNovaSenha" name="confirmNovaSenha" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="formResetSenha" class="btn btn-green">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>