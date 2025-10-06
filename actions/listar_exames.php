<?php
require "../actions/adiciona_exame.php";

$codpaciente = $_GET['codpaciente'] ?? null;

// Função para listar exames
function listarExame($codpaciente) {
    global $pdo;

    try {
        $sql = "SELECT 
                    idexames,
                    codpaciente,
                    arquivo,
                    reccreatedon
                FROM exames
                WHERE codpaciente = :codpaciente
                ORDER BY reccreatedon ASC";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':codpaciente', $codpaciente, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar exames: " . $e->getMessage());
        return [];
    }
}

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
    echo '<div class="mb-3 d-flex align-items-center">';
    echo '<a href="' . htmlspecialchars($linha['arquivo']) . '" target="_blank">'
        . basename($linha['arquivo']) . '</a>';
    echo '<small class="text-muted ms-2"> - '  // Pequena margem para separar data do arquivo
        . date("d/m/Y H:i", strtotime($linha['reccreatedon'])) . '</small>';
    echo '<a href="../actions/exclui_exames.php?idexames='
        . $linha['idexames'] . '&codpaciente=' . $codpaciente
        . '" onclick="return confirm(\'Excluir?\')" class="ms-auto">';
    echo '<i class="bi bi-trash"></i></a>'; 
    echo '</div>';
}
?>
