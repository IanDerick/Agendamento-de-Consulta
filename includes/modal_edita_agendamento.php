<div class="modal fade" id="modalEditaAgendamento" tabindex="-1" aria-labelledby="modalEditaAgendamentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditaAgendamentoLabel">Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="nomePaciente" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomePaciente" name="nomePaciente" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailPaciente" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="emailPaciente" name="emailPaciente" required>
                    </div>
                    <div class="mb-3">
                        <label for="dataConsulta" class="form-label">Data</label>
                        <input type="date" class="form-control" id="dataConsulta" name="dataConsulta" required>
                    </div>
                    <div class="mb-3">
                        <label for="horarioInicial" class="form-label">Horário Inicial</label>
                        <input type="time" class="form-control" id="horarioInicial" name="horarioInicial" required>
                    </div>
                    <div class="mb-3">
                        <label for="horariFinal" class="form-label">Horário Final</label>
                        <input type="time" class="form-control" id="horariFinal" name="horariFinal" required>
                    </div>
                    <div class="mb-3">
                        <label for="frutas">Exames</label>
                        <select id="frutas" name="frutas">
                            <option value="">Selecione</option>
                            <option value="maca">Anamnese</option>
                            <option value="banana">Panoramica</option>
                            <option value="laranja">Teleradiografia</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="formNovoDoutor" class="btn btn-green">Salvar</button>
            </div>
        </div>
    </div>
</div>