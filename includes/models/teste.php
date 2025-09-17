<?php
    include "../../config/conexaodb.php";

    if (isset($_FILES['imagem'])) {
        $arquivo = $_FILES['imagem']; 

        if ($arquivo['error']) {
            die("Falha ao enviar arquivo");
        }

        $pasta = "arquivos/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    
        if ($extensao != "jpg" && $extensao != "png") {
            die("Tipo de arquivo não aceito");
        }

        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

        $deu_certo = move_uploaded_file($arquivo['tmp_name'], $path);

        if ($deu_certo) {
            try {
                $sql = "INSERT INTO EXAMES (codpaciente, arquivo, reccreatedon)
                        VALUES (:codpaciente, :arquivo, NOW())";
            
                $stmt = $pdo->prepare($sql);
            
                // Bind de parâmetros
                $stmt->bindValue(':codpaciente', 1, PDO::PARAM_INT);
                $stmt->bindValue(':arquivo', $path, PDO::PARAM_STR);
            
                $stmt->execute();
            
                echo "<p>Registro inserido com sucesso!</p>";
            } catch (PDOException $e) {
                echo "Erro ao inserir: " . $e->getMessage();
            }
        }else {
            echo "Falha ao enviar arquivo";
        }
    }
?>

$sql_query
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data" method="post" action="">
        <input type="file" name="imagem">
        <button name="upload" type="submit">Enviar</button>
    </form>
</body>
</html>
