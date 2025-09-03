<?php
try {
    //$pdo = new PDO("mysql:host=localhost;port=3307;dbname=meubanco", "root", "");//casa
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=meubanco;charset=utf8","root","root");//
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
