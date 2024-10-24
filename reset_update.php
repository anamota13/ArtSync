<?php
date_default_timezone_set('America/Sao_Paulo');
$conn = new mysqli("localhost", "root", "", "artsync_pi");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['token'])) {
        die("Erro: Token não foi enviado.");
    }

    $token = trim($_POST['token']);
    $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "SELECT email FROM reset_senha WHERE token = ? AND expiracao > NOW()";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->connect_error);
    }

    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        $update_sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);

        if (!$update_stmt) {
            die("Erro ao preparar a atualização da senha: " . $conn->connect_error);
        }

        $update_stmt->bind_param("ss", $novaSenha, $email);

        if ($update_stmt->execute()) {
            $delete_sql = "DELETE FROM reset_senha WHERE email = ?";
            $delete_stmt = $conn->prepare($delete_sql);

            if (!$delete_stmt) {
                die("Erro ao preparar a remoção do token: " . $conn->connect_error);
            }

            $delete_stmt->bind_param("s", $email);
            $delete_stmt->execute();

           
            echo "<script>
                    alert('Senha redefinida com sucesso!');
                    window.location.href = 'login.html';
                  </script>";
            exit(); 
        } else {
            echo "Erro ao atualizar a senha.";
        }
    } else {
        echo "Token inválido ou expirado.";
    }
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
?>
