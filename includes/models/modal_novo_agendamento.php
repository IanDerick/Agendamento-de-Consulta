<div class="modal fade" id="modalNovoAgendamento" tabindex="-1" aria-labelledby="modalNovoAgendamentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoAgendamentoLabel">Novo agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNovoAgendamento" action="../actions/adiciona_agendamento.php" method="post">
                    <div class="mb-3 position-relative">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" autocomplete="off" required>
                        <input type="hidden" id="codPacienteHidden" name="codpaciente">
                        <div id="sugestoesPaciente" class="list-group position-absolute w-100"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="dtconsulta" class="form-label">Data</label>
                        <input type="date" class="form-control" id="dtconsulta" name="dtconsulta" required>
                    </div>
                    <div class="mb-3">
                        <label for="horainicio" class="form-label">Horário Inicial</label>
                        <input type="time" class="form-control" id="horainicio" name="horainicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="horafim" class="form-label">Horário Final</label>
                        <input type="time" class="form-control" id="horafim" name="horafim" required>
                    </div>
                    <div class="mb-3">
                        <label for="cars" class="form-label">Doutor</label>
                        <br>
                        <select name="SelectDoutor" id="selectDoutorNovo" class="form-control" required>
                            <option value="">Selecione</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="formNovoAgendamento" class="btn btn-green">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>