<?php
session_start(); // Inicia a sessão

// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "artsync_pi");

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome_usuario = $_POST['nome_usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmarSenha'];
    $tipo = $_POST['tipo'];

    // Verifica se a senha e a confirmação são iguais
    if ($senha !== $confirmarSenha) {
        $_SESSION['error_message'] = "As senhas não coincidem.";
        header("Location: cadastro.html"); // Redireciona de volta para o formulário de cadastro
        exit();
    }

    // Criptografa a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Prepara a consulta para inserir o novo usuário
    $sql = "INSERT INTO usuarios (nome_usuario, email, senha, tipo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome_usuario, $email, $senha_hash, $tipo);

    if ($stmt->execute()) {
        // Cadastro bem-sucedido
        $_SESSION['success_message'] = "Usuário cadastrado com sucesso!";
        header("Location: login.html"); // Redireciona para a tela de login
    } else {
        // Mensagem de erro ao cadastrar
        $_SESSION['error_message'] = "Erro ao cadastrar usuário: " . $stmt->error;
        header("Location: cadastro.html"); // Redireciona de volta para o formulário de cadastro
    }

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão
$conn->close();
?>
