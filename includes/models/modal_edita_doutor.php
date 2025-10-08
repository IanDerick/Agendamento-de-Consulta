<div class="modal fade" id="modalEditaDoutor" tabindex="-1" aria-labelledby="modalEditaDoutorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditaDoutorLabel">Edita Doutor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditaDoutor" action="../actions/atualiza_doutor.php" method="post">
                    <div class="row">
                        <div class="col-md-20">
                            <div class="d-flex justify-content-center">
                                <div class="mb-3 text-center">
                                    <i class="bi bi-person-circle display-1 text-secondary"></i>
                                    <small class="d-block mt-2 " id="previewNome"></small>
                                </div>
                            </div>
                            <input type="hidden" id="coddoutor" name="coddoutor">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="novaSenha" class="form-label">Nova Senha:</label>
                                <input type="password" class="form-control" id="novaSenha" name="novaSenha">
                            </div>
                            <div class="mb-3">
                                <label for="confirmNovaSenha" class="form-label">Confirmar nova senha:</label>
                                <input type="password" class="form-control" id="confirmNovaSenha" name="confirmNovaSenha">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="radio" class="form-check-input" id="ativo" name="status" value="1">
                                <label class="form-check-label" for="ativo">Ativo</label>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="radio" class="form-check-input" id="inativo" name="status" value="0">
                                <label class="form-check-label" for="inativo">Inativo</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="formEditaDoutor" class="btn btn-green">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>