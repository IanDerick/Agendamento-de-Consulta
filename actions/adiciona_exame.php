<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require "../config/conexaodb.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {

        $arquivo = $_FILES['imagem'];
    
        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['msg'] = "Falha ao enviar arquivo.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    
        // Caminho físico para salvar os arquivos
        $pasta = __DIR__ . "/../../includes/models/arquivos/";
        if (!is_dir($pasta)) {
            mkdir($pasta, 0755, true);
        }
    
        $nomeOriginal = $arquivo['name'];
        $novoNome     = uniqid();
        $extensao     = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    
        if (!in_array($extensao, ['jpg', 'png'])) {
            $_SESSION['msg'] = "Tipo de arquivo não aceito.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    
        $caminhoFisico = $pasta . $novoNome . "." . $extensao;
        $caminhoBanco  = "/Agendamento-de-Consulta/includes/models/arquivos/" . $novoNome . "." . $extensao;
    
        if (move_uploaded_file($arquivo['tmp_name'], $caminhoFisico)) {
            try {
                $sql = "INSERT INTO EXAMES (codpaciente, arquivo, reccreatedon)
                        VALUES (:codpaciente, :arquivo, NOW())";
    
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':codpaciente', 1, PDO::PARAM_INT);
                $stmt->bindValue(':arquivo', $caminhoBanco, PDO::PARAM_STR);
                $stmt->execute();
    
                $_SESSION['msg'] = "Registro inserido com sucesso!";
            } catch (PDOException $e) {
                $_SESSION['msg'] = "Erro ao inserir: " . $e->getMessage();
            }
        } else {
            $_SESSION['msg'] = "Falha ao mover arquivo.";
        }
    
        // Redireciona para evitar reenvio no F5
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    
    // ======== CONSULTA PARA LISTAGEM ========
    $sql_query = $pdo->query(
        "SELECT idexames, arquivo, reccreatedon FROM EXAMES ORDER BY reccreatedon DESC"
    );
?>

