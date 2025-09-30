<?php
require "../actions/adiciona_exame.php";

$codpaciente = $_GET['codpaciente'] ?? null;

if (!$codpaciente) {
    echo "<div class='text-muted'>Nenhum paciente selecionado.</div>";
    exit;
}

$exames = listarExame($codpaciente);

if (empty($exames)) {
    echo "<div class='text-muted'>Nenhum exame encontrado.</div>";
    exit;
}

foreach ($exames as $linha) {
    echo '<div class="mb-1">';
    echo '<a href="' . htmlspecialchars($linha['arquivo']) . '" target="_blank">'
         . basename($linha['arquivo']) . '</a>';
    echo '<small class="text-muted"> - '
         . date("d/m/Y H:i", strtotime($linha['reccreatedon'])) . '</small>';
    echo '</div>';
    echo '<div>';
    echo '<a href="../actions/exclui_exames.php?idexames='
         . $linha['idexames'] . '&codpaciente=' . $codpaciente
         . '" onclick="return confirm(\'Excluir?\')">Excluir</a>';
    echo '</div>';
}
?>
