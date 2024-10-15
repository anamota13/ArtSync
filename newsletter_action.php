<?php
// Inclua os arquivos do PHPMailer
require 'PHPMailer/PHPMailer-PHPMailer-cd72ef3/src/Exception.php';
require 'PHPMailer/PHPMailer-PHPMailer-cd72ef3/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-PHPMailer-cd72ef3/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura o e-mail do formulário
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    // Verifica se o e-mail é válido
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Cria uma nova instância do PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'teamartasync@gmail.com'; // Seu e-mail que envia
            $mail->Password = 'krpmvksglisbrcim'; // Sua senha ou senha de app
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinatários
            $mail->setFrom('teamartasync@gmail.com', 'ArtSync'); // E-mail que envia
            $mail->addAddress($email); // E-mail do usuário que se inscreveu

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Bem-vindo à nossa Newsletter!';
            $mail->Body = "<p>Obrigado por se inscrever em nossa newsletter, $email!</p><p>Você receberá nossas atualizações em breve.</p>";

            // Envia o e-mail
            $mail->send();
            echo "Obrigado por se inscrever! Você receberá nossas atualizações.";
        } catch (Exception $e) {
            echo "Ocorreu um erro ao enviar seu e-mail. Tente novamente mais tarde.";
            echo "Mailer Error: {$mail->ErrorInfo}"; // Exibe o erro do PHPMailer
        }
    } else {
        echo "Por favor, insira um e-mail válido.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
