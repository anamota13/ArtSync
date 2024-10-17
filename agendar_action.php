<?php
session_start();
include('db.php');

$response = [];

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $response['error'] = 'Você precisa estar logado para agendar.';
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'] ?? null;
    $horario = $_POST['horario'] ?? null;
    $response = [];

    if ($data && $horario) {
        try {
            $stmt = $pdo->prepare("INSERT INTO reservas (data, horario) VALUES (:data, :horario)");
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':horario', $horario);
            $stmt->execute();
            $response['success'] = "Agendamento realizado com sucesso!";
        } catch (PDOException $e) {
            $response['error'] = "Erro ao agendar: " . $e->getMessage();
        }
    } else {
        $response['error'] = "Dados inválidos.";
    }
} else {
    $response['error'] = "Método de requisição inválido.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
