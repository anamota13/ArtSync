<?php
session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: index.php"); 
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'artsync_pi');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM obras WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $obra = $result->fetch_assoc();
    } else {
        echo "Obra não encontrada.";
        exit();
    }
} else {
    echo "ID não fornecido.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $artista = $_POST['artista'];
    $ano = $_POST['ano'];
    $descricao = $_POST['descricao'];
    $imagem = $_FILES['imagem']['name'];

    if ($imagem) {
        move_uploaded_file($_FILES['imagem']['tmp_name'], "img_obras/" . $imagem);
        $sql = "UPDATE obras SET titulo=?, artista=?, ano=?, descricao=?, imagem=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $titulo, $artista, $ano, $descricao, $imagem, $id);
    } else {
        $sql = "UPDATE obras SET titulo=?, artista=?, ano=?, descricao=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $titulo, $artista, $ano, $descricao, $id);
    }

    if ($stmt->execute()) {
        header("Location: colecao.php"); 
    } else {
        echo "Erro ao atualizar a obra.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Obra</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>

    <div class="collection-container"> 
        <h1>Editar Obra</h1>
        <form class="collection-form" action="" method="post" enctype="multipart/form-data">
            <label for="titulo">Título da Obra</label>
            <input type="text" id="titulo" name="titulo" placeholder="Digite o título da obra" value="<?php echo htmlspecialchars($obra['titulo']); ?>" required>

            <label for="artista">Artista</label>
            <input type="text" id="artista" name="artista" placeholder="Digite o nome do artista" value="<?php echo htmlspecialchars($obra['artista']); ?>" required>

            <label for="ano">Ano de Criação</label>
            <input type="number" id="ano" name="ano" placeholder="Digite o ano da obra" value="<?php echo htmlspecialchars($obra['ano']); ?>" required>

            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" placeholder="Descrição da obra" value="<?php echo htmlspecialchars($obra['descricao']); ?>" required>

            <label for="imagem">Imagem da Obra</label>
            <input type="file" id="imagem" name="imagem" accept="image/*">

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
