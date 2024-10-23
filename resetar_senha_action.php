<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$conn = new mysqli("localhost", "root", "", "artsync_pi");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Endereço de e-mail inválido.";
    } else {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $token = bin2hex(random_bytes(32));
            $expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));


            $stmt = $conn->prepare("INSERT INTO reset_senha (email, token, expiracao) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $token, $expiracao);
            $stmt->execute();

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

                $resetLink = "http://localhost/ArtSync/ArtSync/resetar_senha_form.html";


                $mail->isHTML(true);
                $mail->Subject = 'Alterar Senha - ArtSync';
                $mail->Body    = "
                    <h3 style='color: #333;'>🔑 Redefinição de Senha 🔑</h3>
                    <p style='color: #666;'>Olá,</p>
                    <p style='color: #666;'>Recebemos uma solicitação para redefinir sua senha. Para continuar, clique no link abaixo:</p>
                    <p><a href='$resetLink' style='color: #4CAF50;'>Redefinir minha senha</a></p>
                    <p style='color: #666;'>Se você não solicitou esta alteração, ignore este e-mail.</p>
                    <p style='color: #666;'>Abraços,<br>Equipe ArtSync</p>
                ";
                $mail->AltBody = "Clique no link para redefinir sua senha: $resetLink";

                $mail->send();
                $msg = "Um link de redefinição foi enviado para o seu e-mail.";

                echo "<script>
                        alert('$msg');
                        window.location.href = 'login.html';
                    </script>";
            } catch (Exception $e) {
                $msg = "Não foi possível enviar o e-mail. Erro: {$mail->ErrorInfo}";
                echo "<script>
                        alert('$msg');
                        window.location.href = 'login.html';
                    </script>";
            }
        } else {
            $msg = "E-mail não encontrado.";
            echo "<script>
                    alert('$msg');
                    window.location.href = 'resetar_senha.html';
                </script>";
        }
    }
}

$conn->close();
?>
