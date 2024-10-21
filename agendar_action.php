<?php
session_start();  // Inicia a sessão

include('db.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$response = [];


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $response['error'] = 'Você precisa estar logado para agendar.';
    echo json_encode($response);
    exit();
}


$emailUsuario = $_SESSION['email'] ?? null;
if (!$emailUsuario) {
    $response['error'] = 'E-mail do usuário não encontrado na sessão.';
    echo json_encode($response);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'] ?? null;
    $horario = $_POST['horario'] ?? null;

    if ($data && $horario) {
        try {
           
            $stmt = $pdo->prepare("INSERT INTO reservas (data, horario) VALUES (:data, :horario)");
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':horario', $horario);
            $stmt->execute();

            
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'equipeartsync@gmail.com';
                $mail->Password = 'rpnf fwap lvmn cgwy';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('equipeartsync@gmail.com', 'Equipe ArtSync');
                $mail->addAddress($emailUsuario);  

                $mail->isHTML(true);
                $mail->Subject = 'Agendamento - ArtSync';
                $mail->Body = "
                    <h2>Confirmação do Seu Agendamento na Galerie Belle Époque</h2>
                    <p>Olá, <strong>{$_SESSION['nome_usuario']}</strong>!</p>
                    <p>Estamos felizes em confirmar o seu agendamento. Seguem os detalhes:</p>
                    <ul>
                        <li><strong>Data:</strong> {$data}</li>
                        <li><strong>Horário:</strong> {$horario}</li>
                    </ul>
                    <p>Agradecemos por escolher nossa galeria! Estamos ansiosos para recebê-lo e proporcionar uma experiência incrível no mundo da arte.</p>
                    <p>Caso precise alterar ou cancelar seu agendamento, entre em contato conosco pelo e-mail: <a href='mailto:equipeartsync@gmail.com'>equipeartsync@gmail.com</a>.</p>
                    <p>Atenciosamente,</p>
                    <p><strong>Equipe ArtSync | Galerie Belle Époque</strong></p>
                ";
                $mail->AltBody = "Agendamento confirmado para $data às $horario.";

                $mail->send();
                $response['success'] = "Agendamento realizado e e-mail enviado com sucesso!";
            } catch (Exception $e) {
                error_log("Erro ao enviar e-mail: " . $mail->ErrorInfo);
                $response['warning'] = "Agendamento realizado, mas houve um erro ao enviar o e-mail.";
            }
        } catch (PDOException $e) {
            $response['error'] = "Erro ao agendar: " . $e->getMessage();
        }
    } else {
        $response['error'] = "Dados inválidos.";
    }
} else {
    $response['error'] = "Método de requisição inválido.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
