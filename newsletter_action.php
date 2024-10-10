<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o e-mail do formulário
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Verifica se o e-mail é válido
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Configurações do e-mail
        $to = $email;
        $subject = "Confirmação de Inscrição na Newsletter";
        $message = "Obrigado por se inscrever na nossa newsletter! Você receberá atualizações sobre as nossas obras de arte.";
        $headers = "From: contato@seusite.com"; // Substitua pelo seu e-mail

        // Envia o e-mail
        if (mail($to, $subject, $message, $headers)) {
            // Redireciona para a página anterior com uma mensagem de sucesso
            header("Location: index.html?success=inscricao_realizada");
            exit();
        } else {
            // Redireciona para a página anterior com uma mensagem de erro
            header("Location: index.html?error=erro_enviar_email");
            exit();
        }
    } else {
        // E-mail inválido
        header("Location: index.html?error=email_invalido");
        exit();
    }
} else {
    // Redireciona se a requisição não for POST
    header("Location: index.html");
    exit();
}
?>
