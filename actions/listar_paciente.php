<?php
require "../config/conexaodb.php";

function listarPaciente() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT codpaciente, nome, email FROM paciente ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar usuários: " . $e->getMessage());
        return [];
    }
}
