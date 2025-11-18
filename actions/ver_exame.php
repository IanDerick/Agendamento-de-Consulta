<?php
    require "../config/conexaodb.php";
    $idexame = $_GET['id'] ?? null;
    if (!$idexame) {
        exit("ID inválido.");
    }
    $sql = $pdo->prepare("SELECT arquivo FROM exames WHERE idexames = :id");
    $sql->bindValue(':id', $idexame, PDO::PARAM_INT);
    $sql->execute();
    $exame = $sql->fetch(PDO::FETCH_ASSOC);
    if (!$exame) {
        exit("Exame não encontrado.");
    }
    $base64 = $exame['arquivo'];
    if (str_starts_with($base64, "data:")) {
        $base64 = preg_replace('/^data:image\/\w+;base64,/', '', $base64);
    }
    $mime = "";
    $first = substr($base64, 0, 5);
    if (str_starts_with($base64, "/9j/")) {
        $mime = "image/jpeg";
    } else {
        $mime = "image/png";
    }

    header("Content-Type: $mime");
    echo base64_decode($base64);
    exit;
?>