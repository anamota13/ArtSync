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
    $email = $_POST['email'];
    $senha = $_POST['password'];

    // Prepara a consulta para buscar o usuário pelo e-mail
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows > 0) {
        // Recupera os dados do usuário
        $row = $result->fetch_assoc();
        
        // Verifica a senha
        if (password_verify($senha, $row['senha'])) {
            // Login bem-sucedido, armazena o nome de usuário e o tipo de usuário na sessão
            $_SESSION['nome_usuario'] = $row['nome_usuario']; // Armazenando o nome do usuário
            $_SESSION['tipo'] = $row['tipo']; // Armazenando o tipo de usuário
            header("Location: colecao.php"); // Redireciona para colecao.php
            exit(); // Termina a execução do script
        } else {
            // Adiciona mensagem de erro como parâmetro de URL
            header("Location: login.html?error=senha_incorreta"); // Redireciona para login.html
            exit(); // Termina a execução do script
        }
    } else {
        // Adiciona mensagem de erro como parâmetro de URL
        header("Location: login.html?error=usuario_nao_encontrado"); // Redireciona para login.html
        exit(); // Termina a execução do script
    }

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão
$conn->close();
?>
