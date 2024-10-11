<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'artsync_pi');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o ID da obra foi passado na URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM obras WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: colecao.php");
        exit();
    } else {
        echo "Erro ao excluir a obra: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID da obra não especificado.";
}

$conn->close();
?>
