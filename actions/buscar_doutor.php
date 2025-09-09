<?php
session_start();
require "../config/conexaodb.php";

try {
    $stmt = $pdo->prepare("SELECT CODDOUTOR, NOME FROM DOUTOR WHERE STATUS = 1 ORDER BY NOME");
    $stmt->execute();
    $doutores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($doutores);
} catch (PDOException $e) {
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode(["erro" => $e->getMessage()]);
}
