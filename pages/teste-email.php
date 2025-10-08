<?php
    require_once('src/PHPMailer.php');    
    require_once('src/SMTP.php');    
    require_once('src/Exception.php');
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);
    
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'iandericksilvamota@gmail.com';
        $mail->Password = 'bqboyycenzokwzcq';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('iandericksilvamota@gmail.com', 'Agendamento de Consulta');
        $mail->addAddress('ian_mota@estudante.sesisenai.org.br');

        $mail->isHTML(true);
        $mail->Subject = 'Teste de email via gmail';
        $mail->Body = 'E-mail enviado com sucesso.';

        $mail->send();
        echo 'Email enviado com sucesso';
    } catch (Exception $e) {
        echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
?>
