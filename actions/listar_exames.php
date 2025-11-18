<?php
    require "../actions/adiciona_exame.php";

    $codpaciente = $_GET['codpaciente'] ?? null;

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

        echo '<a href="../actions/ver_exame.php?id=' . $linha['idexames'] . '" target="_blank">
                Visualizar exame
            </a>';
        echo '<small class="text-muted ms-2"> - '
            . date("d/m/Y H:i", strtotime($linha['reccreatedon'])) .
            '</small>';
        echo '<a href="../actions/exclui_exames.php?idexames='
            . $linha['idexames'] . '&codpaciente=' . $codpaciente
            . '" class="ms-auto btn-excluir-exame" data-idexame="' . (int)$linha['idexames'] . '">';
        echo '<i class="bi bi-trash"></i></a>';
        echo '</div>';
    }
?>
