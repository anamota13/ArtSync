<?php
session_start();

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    // Redireciona para a página de login ou exibe uma mensagem de erro
    header("Location: login.php");
    exit();
}

// Verifica se o parâmetro 'id' foi passado via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['mensagem'] = "ID da obra inválido.";
    $_SESSION['tipo_mensagem'] = "erro";
    header("Location: colecao.php");
    exit();
}

// Obtém o ID da obra e sanitiza
$obra_id = intval($_GET['id']);

// Configurações do banco de dados
$servername = "localhost";
$username_db = "root"; // Substitua pelo seu usuário do DB
$password_db = ""; // Substitua pela sua senha do DB
$dbname = "artsync_pi";

// Cria a conexão
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    $_SESSION['mensagem'] = "Falha na conexão com o banco de dados: " . $conn->connect_error;
    $_SESSION['tipo_mensagem'] = "erro";
    header("Location: colecao.php");
    exit();
}

// Primeiro, obtém o caminho da imagem para poder deletá-la do servidor
$sql_select = "SELECT imagem FROM obras WHERE id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $obra_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

if ($result_select->num_rows === 0) {
    $_SESSION['mensagem'] = "Obra não encontrada.";
    $_SESSION['tipo_mensagem'] = "erro";
    header("Location: colecao.php");
    exit();
}

$row = $result_select->fetch_assoc();
$caminho_imagem = $row['imagem'];

// Prepara a declaração para deletar a obra
$sql_delete = "DELETE FROM obras WHERE id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $obra_id);

if ($stmt_delete->execute()) {
    // Deleta a imagem do servidor, se existir
    if (file_exists($caminho_imagem)) {
        unlink($caminho_imagem);
    }
    $_SESSION['mensagem'] = "Obra excluída com sucesso!";
    $_SESSION['tipo_mensagem'] = "sucesso";
} else {
    $_SESSION['mensagem'] = "Erro ao excluir a obra: " . $stmt_delete->error;
    $_SESSION['tipo_mensagem'] = "erro";
}

// Fecha as declarações e a conexão
$stmt_select->close();
$stmt_delete->close();
$conn->close();

// Redireciona de volta para a página da coleção
header("Location: colecao.php");
exit();
?>
