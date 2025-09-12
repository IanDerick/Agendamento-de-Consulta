<?php
    $mensagem = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {
        $permitidos = ['image/jpeg', 'image/png'];
        $tamanho_max = 2 * 1024 * 1024;
        $arquivo = $_FILES['imagem'];

        if ($arquivo['error'] === UPLOAD_ERR_OK) {
            if (in_array($arquivo['type'], $permitidos) && $arquivo['size'] <= $tamanho_max) {
                $destino = 'uploads/'.basename($arquivo['name']);
                if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
                    $mensagem = "Arquivo enviado com sucesso!";
                }else {
                    $mensagem = "Erro ao mover o arquivo.";
                }
            }else{
                $mensagem = "Arquivo inválido ou muito grande";
            }
        }else {
            $mensagem = "Erro no upload: ". $arquivo['error'];
        }
    }
?>