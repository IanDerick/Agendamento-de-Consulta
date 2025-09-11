<div class="modal fade" id="modalEditaAgendamento" tabindex="-1" aria-labelledby="modalEditaAgendamentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditaAgendamentoLabel">Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditaAgendamento" action="#" method="post">
                    <input type="hidden" id="idagendamento" name="idagendamento">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" >
                    </div>
                    <div class="mb-3">
                        <label for="dtconsulta" class="form-label">Data</label>
                        <input type="date" class="form-control" id="dtconsulta" name="dtconsulta" >
                    </div>
                    <div class="mb-3">
                        <label for="horainicio" class="form-label">Horário Inicial</label>
                        <input type="time" class="form-control" id="horainicio" name="horainicio" >
                    </div>
                    <div class="mb-3">
                        <label for="horafim" class="form-label">Horário Final</label>
                        <input type="time" class="form-control" id="horafim" name="horafim" >
                    </div>
                    <div class="mb-3">
                        <label for="cars" class="form-label">Doutor</label>
                        <br>
                        <select name="SelectDoutor" id="selectDoutorEdita" class="form-control" required>
                            <option value="">Selecione</option>
                        </select>
                    </div>
                    <!--<div class="mb-3">
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
                    </div>-->
                    <div class="modal-footer">
                        <button type="submit" form="formEditaAgendamento" class="btn btn-green">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>