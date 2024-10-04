<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome_usuario = $_POST['nome_usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmarSenha'];

    // Verifica se as senhas correspondem
    if ($senha !== $confirmar_senha) {
        die("As senhas não correspondem.");
    }

    // Conexão com o banco de dados
    $conn = new mysqli('localhost', 'root', '', 'artsync');

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome_usuario, email, senha) VALUES ('$nome_usuario', '$email', '$senha_hash')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso!";
        header('Location: login.html'); // Redireciona após o cadastro
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conn->error; // Mostra o erro se houver
    }

    $conn->close();
} else {
    echo "Método não permitido.";
}
?>
