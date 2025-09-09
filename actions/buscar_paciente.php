<?php
session_start();
require "../config/conexaodb.php";

$nome = $_GET["nome"] ?? "";

if ($nome) {
    try {
        $stmt = $pdo->prepare("
            SELECT codpaciente, nome, email 
            FROM paciente 
            WHERE nome LIKE :nome 
            LIMIT 10
        ");
        $stmt->execute([":nome" => "%$nome%"]);
        $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($pacientes);
    } catch (PDOException $e) {
        echo json_encode(["erro" => $e->getMessage()]);
    }
}
