<?php
require "../config/conexaodb.php";

function listarUsuarios() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT id, nome, email, tipo FROM usuarios ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar usuários: " . $e->getMessage());
        return [];
    }
}
