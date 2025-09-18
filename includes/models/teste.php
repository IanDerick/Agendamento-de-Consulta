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

        if ($extensao !== "jpg" && $extensao !== "png") {
            die("Tipo de arquivo não aceito");
        }

        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

        if (move_uploaded_file($arquivo['tmp_name'], $path)) {
            try {
                $sql = "INSERT INTO EXAMES (codpaciente, arquivo, reccreatedon)
                        VALUES (:codpaciente, :arquivo, NOW())";

                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':codpaciente', 1, PDO::PARAM_INT);
                $stmt->bindValue(':arquivo', $path, PDO::PARAM_STR);
                $stmt->execute();

                echo "<p>Registro inserido com sucesso!</p>";
            } catch (PDOException $e) {
                echo "Erro ao inserir: " . $e->getMessage();
            }
        } else {
            echo "Falha ao enviar arquivo";
        }
    }

    $sql_query = $pdo->query("SELECT arquivo, reccreatedon FROM EXAMES ORDER BY reccreatedon DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploads</title>
</head>
<body>
    <form enctype="multipart/form-data" method="post" action="">
        <input type="file" name="imagem" accept=".jpg,.png">
        <button name="upload" type="submit">Enviar</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>Arquivo</th>
                <th>Data de envio</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($linha = $sql_query->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td>
                    <a href="<?php echo htmlspecialchars($linha['arquivo']); ?>" target="_blank">
                        <?php echo basename($linha['arquivo']); ?>
                    </a>
                </td>
                <td><?php echo date("d/m/Y H:i", strtotime($linha['reccreatedon'])); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
