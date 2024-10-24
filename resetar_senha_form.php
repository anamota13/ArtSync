<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        window.onload = function() {
            const params = new URLSearchParams(window.location.search);
            const token = params.get('token');

            
            if (!token) {
                alert("Token ausente ou inválido!");
                window.location.href = "login.html";
                return;
            }

            
            document.getElementById('tokenInput').value = token;
        };
    </script>
</head>
<body>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <div class="login-container">
        <h1>Redefinir Senha</h1>
        <form class="login-form" action="reset_update.php" method="post">
            <input type="hidden" id="tokenInput" name="token">

            <label for="senha">Nova Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua nova senha" required>
            <button type="submit">Redefinir</button>
        </form>
        <div class="back-to-login">
            <p><br> Lembrou sua senha? <a href="login.html">Faça login</a></p>
        </div>
    </div>
</body>
</html>
