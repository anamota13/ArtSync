<?php
$conn = new mysqli("localhost", "root", "", "artsync_pi");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "SELECT email FROM reset_senha WHERE token = ? AND expiracao > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 
        $email = $row['email'];

        $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
        $stmt->execute([$novaSenha, $email]);

        $stmt = $conn->prepare("DELETE FROM reset_senha WHERE email = ?");
        $stmt->execute([$email]);

        echo "Senha redefinida com sucesso!";
    } else {
        echo "Token inválido ou expirado.";
    }
}

$conn->close();
?>
