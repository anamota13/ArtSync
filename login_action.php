<?php
session_start(); 

$conn = new mysqli("localhost", "root", "", "artsync_pi");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($senha, $row['senha'])) {
            $_SESSION['nome_usuario'] = $row['nome_usuario']; 
            $_SESSION['tipo'] = $row['tipo']; 
            $_SESSION['logged_in'] = true; 
            header("Location: index.php"); 
            exit(); 
        } else {
            header("Location: login.html?error=senha_incorreta"); 
            exit(); 
        }
    } else {
        header("Location: login.html?error=usuario_nao_encontrado"); 
        exit(); 
    }

    $stmt->close();
}

$conn->close();
?>
