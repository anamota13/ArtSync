<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$msg = ""; 

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
            $mail->Username   = 'equipeartsync@gmail.com'; 
            $mail->Password   = 'rpnf fwap lvmn cgwy'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port       = 587; 

            $mail->setFrom('equipeartsync@gmail.com', 'Equipe ArtSync');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Obrigado por se inscrever no nosso newsletter';
            $mail->Body    = '
                <h3 style="color: #333;">🎉 Bem-vindo(a) ao ArtSync! 🎨</h3>
                <p style="color: #666;">Estamos super felizes por ter você com a gente! Sua inscrição em nossa newsletter foi confirmada 
                e você agora faz parte de uma comunidade apaixonada por arte e criatividade. 💫</p>

                <p style="color: #666;">Fique ligado(a) para receber as últimas novidades diretamente em sua caixa de entrada. 🎁</p>

                <p style="color: #666;">Ainda não tem uma conta? <strong>Faça login/cadastro</strong> e explore todas as vantagens! ✨</p>

                <p style="color: #666;">Com uma conta, você pode agendar visitas a museus e galerias e ter acesso a conteúdos exclusivos. 🎟️</p>

                <p style="color: #666;">Se precisar de qualquer coisa, é só nos chamar! 😊</p>

                <p style="color: #666;">Abraços,<br>Equipe ArtSync</p>
            ';
            $mail->AltBody = "Obrigado por se inscrever no nosso newsletter!";

            
            $mail->send();
            $msg = "Equipe ArtSync te enviou as boas-vindas, olhe seu e-mail!"; 
            
            
            $redirectPage = 'index.php'; 

            
            if (isset($_POST['redirect_page'])) {
                $redirectPage = $_POST['redirect_page']; 
            }

            echo "<script>
                    alert('$msg');
                    window.location.href = '$redirectPage'; 
                </script>";
        } catch (Exception $e) {
            $msg = "Não foi possível enviar a mensagem. Erro do Mailer: {$mail->ErrorInfo}";
            echo "<script>
                    alert('$msg');
                    window.location.href = 'index.php'; 
                </script>";
        }
    }
}
?>

<?php if (!empty($msg)) : ?>
<?php endif; ?>
