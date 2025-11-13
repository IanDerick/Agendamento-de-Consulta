<?php
session_start();
require "../config/conexaodb.php";
require '../actions/listar_doutor.php';
require '../actions/listar_agendamento.php';

require_once('../src/PHPMailer.php');    
require_once('../src/SMTP.php');    
require_once('../src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Dados enviados pelo formulário
        $codpaciente  = $_POST["codpaciente"] ?? null;
        $emailPaciente = $_POST["email"] ?? null;
        $dtconsulta   = $_POST["dtconsulta"] ?? null;
        $horainicio   = $_POST["horainicio"] ?? null;
        $horafim      = $_POST["horafim"] ?? null;
        $coddoutor    = $_POST["SelectDoutor"] ?? null;

        // Verifica se faltou algum campo obrigatório
        if (!$codpaciente || !$dtconsulta || !$horainicio || !$horafim || !$coddoutor) {
            $_SESSION['error'] = "Preencha todos os campos obrigatórios.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // Timezone correto
        date_default_timezone_set('America/Sao_Paulo');

        // Validação da data
        $hoje = new DateTime('today');
        $dataConsulta = new DateTime($dtconsulta);

        if ($dataConsulta < $hoje) {
            $_SESSION['error'] = "A data da consulta deve ser a partir de hoje.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // Obtém dados do doutor
        $doutor = listarDoutorEmail($coddoutor);

        // Verifica se já existe consulta para o médico nesta data e horário
        $temConsulta = listarAgendamentoDoutorConflitante($dtconsulta, 
                                                         $horainicio, 
                                                         $horafim, 
                                                         $coddoutor);

        if ($temConsulta) {
            $_SESSION['error'] = "Já existe um agendamento para este médico nesta data.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // Inserir no banco
        try {
            $stmt = $pdo->prepare("
                INSERT INTO agendamento (codpaciente, dtconsulta, horainicio, horafim, coddoutor)
                VALUES (:codpaciente, :dtconsulta, :horainicio, :horafim, :coddoutor)
            ");

            $stmt->execute([
                ":codpaciente" => $codpaciente,
                ":dtconsulta"  => $dtconsulta,
                ":horainicio"  => $horainicio,
                ":horafim"     => $horafim,
                ":coddoutor"   => $coddoutor
            ]);

            // E-mail de confirmação
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'iandericksilvamota@gmail.com';
                $mail->Password   = 'bqboyycenzokwzcq';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('iandericksilvamota@gmail.com', 'Agendamento de Consulta');
                $mail->addAddress($emailPaciente);

                $mail->isHTML(true);
                $mail->Subject = 'Consulta agendada!';

                $dataFormatada = (new DateTime($dtconsulta))->format('d/m/Y');

                $mail->Body = "
                    Sua consulta está agendada para <strong>$dataFormatada</strong><br>
                    Horário: <strong>$horainicio</strong><br>
                    Doutor(a): <strong>{$doutor['NOME']}</strong><br>
                    Endereço: <a href='https://maps.app.goo.gl/6TamZSCXSt5H8mmA8'>
                        R. Arno Waldemar Döhler, 957
                    </a>
                ";

                $mail->send();

            } catch (Exception $e) {
                $_SESSION['error'] = "Consulta agendada, mas houve erro ao enviar o e-mail.";
                header("Location: ../pages/agenda.php");
                exit;
            }

            $_SESSION['success'] = "Agendamento criado com sucesso!";
            header("Location: ../pages/agenda.php");
            exit;

        } catch (PDOException $e) {
            $_SESSION['error'] = "Erro ao salvar no banco: " . $e->getMessage();
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
?>
