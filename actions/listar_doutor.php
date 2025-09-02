<?php
require "../config/conexaodb.php";

function listarDoutor() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT coddoutor, nome, email FROM doutor ORDER BY coddoutor ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar usuários: " . $e->getMessage());
        return [];
    }
}
