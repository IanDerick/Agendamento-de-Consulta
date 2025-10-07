<div class="modal fade" id="modalEditaAgendamento" tabindex="-1" aria-labelledby="modalEditaAgendamentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditaAgendamentoLabel">Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditaAgendamento" action="../actions/atualiza_agendamento.php" method="post">
                    <input type="hidden" id="idagendamento" name="idagendamento">
                    <div class="mb-3 position-relative">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" autocomplete="off" required>
                        <input type="hidden" id="codPacienteHidden" name="codpaciente">
                        <div id="sugestoesPaciente" class="list-group position-absolute w-100"></div>
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
                        <select name="selectDoutorEdita" id="selectDoutorEdita" class="form-control" required>
                            <option value="">Selecione</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="formEditaAgendamento"  class="btn btn-primary">Salvar</button>
                    </div>
                </form>
                                <!-- Upload de exame -->
                <form id="salvaExame" action="../actions/adiciona_exame.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="codpaciente_exame" name="codpaciente_exame">
                    <div class="mb-3 mt-3">
                        <label for="imagem" class="form-label">Enviar exame (JPG ou PNG):</label>
                        <input type="file" class="form-control" name="imagem" id="imagem" accept=".jpg,.png">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="btnSalvaExame" class="btn btn-warning" disabled>Enviar Exame</button>
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