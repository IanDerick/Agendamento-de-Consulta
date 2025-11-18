<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../config/conexaodb.php";

// Upload de arquivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {
    $codpaciente = filter_input(INPUT_POST, 'codpaciente_exame', FILTER_VALIDATE_INT);
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

    // Valida Extensão
    $nomeOriginal = $arquivo['name'];
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    if (!in_array($extensao, ['jpg', 'jpeg', 'png'])) {
        $_SESSION['msg'] = "Tipo de arquivo não aceito.";
        header("Location: ../pages/novo_paciente.php");
        exit;
    }

    // Lê o arquivo binário temporário
    $fileTmp = $arquivo['tmp_name'];
    $fileData = file_get_contents($fileTmp);

    // Descobre o mime real (segurança!)
    $mime = mime_content_type($fileTmp);

    // Converte em base64 completo
    $base64Final = "data:$mime;base64," . base64_encode($fileData);

    // SALVAR NO BANCO (sem mover arquivo)
    try {
        $sql = "INSERT INTO exames (codpaciente, arquivo, reccreatedon)
                VALUES (:codpaciente, :arquivo, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':codpaciente', $codpaciente, PDO::PARAM_INT);
        $stmt->bindValue(':arquivo', $base64Final, PDO::PARAM_STR);
        $stmt->execute();

        $_SESSION['msg'] = "Imagem enviada e salva com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['msg'] = "Erro ao salvar no banco: " . $e->getMessage();
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
