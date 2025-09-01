<div class="modal fade" id="modalEditaPaciente" tabindex="-1" aria-labelledby="modalEditaPacienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditaPacienteLabel">Novo Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-md-20">
                            <div class="d-flex justify-content-center">
                                <div class="mb-3 text-center">
                                    <i class="bi bi-person-circle display-1 text-secondary"></i>
                                    <small class="d-block mt-2 ">Nome:</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nomePaciente" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nomePaciente" name="nomePaciente" required>
                            </div>
                            <div class="mb-3">
                                <label for="CPFPaciente" class="form-label">CPF:</label>
                                <input type="number" class="form-control" id="CPFPaciente" name="CPFPaciente">
                            </div>
                            <div class="mb-3">
                                <label for="emailPaciente" class="form-label">E-mail:</label>
                                <input type="email" class="form-control" id="emailPaciente" name="emailPaciente" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefonePaciente" class="form-label">Telefone:</label>
                                <input type="tel" class="form-control" id="telefonePaciente" name="telefonePaciente">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary form-control" onclick="mostrarInformacoes(event)">
                                    Exames
                                <i id="iconeSeta" class="bi bi-arrow-down"></i>
                                </button>
                                <div id="infoEditaAgendamento">
                                <li class="itemExames">
                                    <button type="button" class="btn btn-outline-primary form-control" onclick="document.getElementById('inputArquivo').click()">
                                        Adicionar exame<i class="bi bi-plus"></i>
                                    </button>
                                    <input type="file" id="inputArquivo" name="arquivo" style="display: none;"/>
                                </li>
                                <ul class="exames">
                                    <li class="itemExames">
                                        <a href="caminho/para/seu-arquivo.pdf" download>
                                            <button class="btn btn-ligh">
                                                Anamnese 
                                                <i class="bi bi-download"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li class="itemExames">
                                        <a href="caminho/para/seu-arquivo.pdf" download>
                                            <button class="btn btn-ligh">
                                                Panoramica 
                                                <i class="bi bi-download"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li class="itemExames">
                                        <a href="caminho/para/seu-arquivo.pdf" download>
                                            <button class="btn btn-ligh">
                                                Telerradiografia
                                                <i class="bi bi-download"></i>
                                            </button>
                                        </a>
                                    </li>
                                </ul>
                                </div>
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