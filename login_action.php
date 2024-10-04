<?php
session_start(); // Inicia a sessão

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Verifica se o método é POST
    $email = $_POST['email']; // Corrigido para 'email'
    $senha = $_POST['password']; // Corrigido para 'password'

    // Conexão com o banco de dados
    $conn = new mysqli('localhost', 'root', '', 'artsync');

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consulta para verificar o usuário
    $sql = "SELECT * FROM usuarios WHERE email='$email'"; // Agora busca pelo 'email'
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['nome_usuario']; // Armazena o nome de usuário na sessão
            echo "Login bem-sucedido!"; // Aqui você pode redirecionar para outra página
            header('Location: index.html'); // Redirecionamento opcional
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }

    $conn->close();
} else {
    echo "Método não permitido."; // Resposta para métodos não permitidos
}
?>
