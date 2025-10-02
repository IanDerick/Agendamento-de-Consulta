<?php
    require 'vendor/autoload.php';
    require "../config/conexaodb.php";

use Dompdf\Dompdf;

try {
    $sql = "SELECT
                doutor.nome,
                COUNT(agendamento.idagendamento) AS total_agendamentos
            FROM 
                agendamento
            INNER JOIN doutor ON
            (
                doutor.coddoutor = agendamento.coddoutor
            )
            GROUP BY
                doutor.nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);

    $html = "<h2>Relatório de Agendamentos</h2>";

    if (count($resultados) > 0) {
        $html .= "<table border='1' cellspacing='0' cellpadding='5' width='100%'>";
        $html .= "<tr style='background-color:#f2f2f2;'>
                    <th>Doutor</th>
                    <th>Quantidade Consulta</th>
                  </tr>";

        foreach ($resultados as $row) {
            $html .= "<tr>";
            $html .= "<td>" . $row->nome . "</td>";
            $html .= "<td>" . $row->total_agendamentos . "</td>";
            $html .= "</tr>";
        }

        $html .= "</table>";
    } else {
        $html .= "Nenhum agendamento encontrado.";
    }

    // Gerar o PDF com Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream("relatorio_agendamentos.pdf", ["Attachment" => false]); // false = abre no navegador

} catch (PDOException $e) {
    error_log("Erro ao buscar agendamentos: " . $e->getMessage());
    echo "Erro ao buscar dados.";
}
?>