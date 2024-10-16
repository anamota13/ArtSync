<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Endereço de e-mail inválido.";
    } else {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'teamartsync@gmail.com'; 
            $mail->Password   = 'wrxc bezs ssyw glpo'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port       = 587; 

            
            $mail->setFrom('teamartsync@gmail.com', 'Team ArtSync');

            
            $mail->addAddress($email); 

            
            $mail->isHTML(true);
            $mail->Subject = 'Obrigado por se inscrever no nosso newsletter';
            $mail->Body    = "<h3>Obrigado por se inscrever no nosso newsletter!</h3>";
            $mail->AltBody = "Obrigado por se inscrever no nosso newsletter!";

            
            $mail->send();
            $msg = "Obrigado por se inscrever no nosso newsletter!";
        } catch (Exception $e) {
            
            $msg = "Não foi possível enviar a mensagem. Erro do Mailer: {$mail->ErrorInfo}";
        }
    }
}
?>
