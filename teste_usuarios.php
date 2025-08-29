<?php
require "config/conexaodb.php";

$stmt = $pdo->query("SELECT * FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($usuarios);
echo "</pre>";
