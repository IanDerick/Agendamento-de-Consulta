<?php
    session_start();
    require "../config/conexaodb.php";
    require '../actions/listar_doutor.php';
    require_once('../src/PHPMailer.php');    
    require_once('../src/SMTP.php');    
    require_once('../src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $codpaciente = $_POST["codpaciente"] ?? null;
        $emailPaciente = $_POST["email"] ?? null;
        $dtconsulta = $_POST["dtconsulta"] ?? null;
        $dateObj = new DateTime($dtconsulta);
        $horainicio = $_POST["horainicio"] ?? null;
        $horafim = $_POST["horafim"] ?? null;
        $coddoutor = $_POST["SelectDoutor"] ?? null;
        $doutor = listarDoutorEmail($coddoutor);
        date_default_timezone_set('America/Sao_Paulo'); // garante fuso horário certo
        $hoje = new DateTime('today');
        $dataConsulta = new DateTime($dtconsulta);

        if ($dataConsulta < $hoje) {
            $_SESSION['error'] = 'Data menor que o permitido';
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        if ($codpaciente && $dtconsulta && $horainicio && $horafim && $coddoutor) {
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO agendamento (codpaciente, dtconsulta, horainicio, horafim, coddoutor)
                    VALUES (:codpaciente, :dtconsulta, :horainicio, :horafim, :coddoutor)
                ");
                $stmt->execute([
                    ":codpaciente" => $codpaciente,
                    ":dtconsulta" => $dtconsulta,
                    ":horainicio" => $horainicio,
                    ":horafim" => $horafim,
                    ":coddoutor" => $coddoutor
                ]);
                $_SESSION['success'] = "Agendamento criado com sucesso!";

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
                    $mail->addAddress($emailPaciente);
            
                    $mail->isHTML(true);
                    $mail->Subject = 'Consulta agendada!';
                    $dateObj = new DateTime($dtconsulta);
                    $mail->Body = 'Sua consulta está agendada para dia ' . $dateObj->format('d/m/Y') . 
                                ' às ' . $horainicio . ' horas, com '.  $doutor['NOME'] . 
                                '. <br> Endereço: <a href="https://maps.app.goo.gl/6TamZSCXSt5H8mmA8">R. Arno Waldemar Döhler, 957</a>';
            
                    $mail->send();
                    echo 'Email enviado com sucesso';
                } catch (Exception $e) {
                    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
                }
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            } catch (PDOException $e) {
                $_SESSION['error'] = "Erro ao salvar no banco: " . $e->getMessage();
            }
        } else {
            $_SESSION['error'] = "Preencha todos os campos obrigatórios antes de salvar.";
        }
    } else {
        header("Location: ../pages/agenda.php");
        exit;
    }
?>