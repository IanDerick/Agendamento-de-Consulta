<?php
require "../config/conexaodb.php";

function listarDoutor() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT coddoutor, nome, email, status FROM doutor ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar usuários: " . $e->getMessage());
        return [];
    }
}
