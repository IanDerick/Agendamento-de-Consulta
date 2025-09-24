<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require "../config/conexaodb.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {
        $codpaciente = filter_input(INPUT_POST, 'codpaciente', FILTER_VALIDATE_INT);
        $arquivo = $_FILES['imagem'];
        var_dump($codpaciente);
        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['msg'] = "Falha ao enviar arquivo.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    
        // Caminho físico para salvar os arquivos
        $pasta = __DIR__ . "../../includes/models/arquivos/";
        var_dump($pasta);
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
                $stmt->bindValue(':codpaciente', $codpaciente, PDO::PARAM_INT);
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
        header("Location: ../pages/novo_paciente.php");
        exit;
    }
    
    // ======== CONSULTA PARA LISTAGEM ========
    $sql_query = $pdo->query(
        "SELECT idexames, arquivo, reccreatedon FROM EXAMES ORDER BY reccreatedon DESC"
    );
?>

