<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../config/conexaodb.php";

// Função para listar exames
function listarExame($codpaciente) {
    global $pdo;

    try {
        $sql = "SELECT 
                    idexames,
                    codpaciente,
                    arquivo,
                    reccreatedon
                FROM exames
                WHERE codpaciente = :codpaciente
                ORDER BY reccreatedon DESC";



        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':codpaciente', $codpaciente, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar exames: " . $e->getMessage());
        return [];
    }
}


// Upload de arquivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {
    $codpaciente = filter_input(INPUT_POST, 'codpaciente', FILTER_VALIDATE_INT);
    $arquivo = $_FILES['imagem'];

    if (!$codpaciente) {
        $_SESSION['msg'] = "Paciente inválido.";
        header("Location: ../pages/novo_paciente.php");
        exit;
    }

    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['msg'] = "Erro ao enviar arquivo.";
        header("Location: ../pages/novo_paciente.php");
        exit;
    }

    $pasta = __DIR__ . "../../includes/models/arquivos/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }

    $nomeOriginal = $arquivo['name'];
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    $novoNome = uniqid() . "." . $extensao;

    if (!in_array($extensao, ['jpg', 'jpeg', 'png'])) {
        $_SESSION['msg'] = "Tipo de arquivo não aceito.";
        header("Location: ../pages/novo_paciente.php");
        exit;
    }

    $caminhoFisico = $pasta . $novoNome;
    $caminhoBanco = "/Agendamento-de-Consulta/includes/models/arquivos/" . $novoNome;

    if (move_uploaded_file($arquivo['tmp_name'], $caminhoFisico)) {
        try {
            $sql = "INSERT INTO exames (codpaciente, arquivo, reccreatedon)
                    VALUES (:codpaciente, :arquivo, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':codpaciente', $codpaciente, PDO::PARAM_INT);
            $stmt->bindValue(':arquivo', $caminhoBanco, PDO::PARAM_STR);
            $stmt->execute();
            $_SESSION['msg'] = "Arquivo enviado com sucesso!";
        } catch (PDOException $e) {
            $_SESSION['msg'] = "Erro ao salvar no banco: " . $e->getMessage();
        }
    } else {
        $_SESSION['msg'] = "Falha ao mover arquivo.";
    }

    header("Location: ../pages/novo_paciente.php?codpaciente=" . $codpaciente);
    exit;
}
?>