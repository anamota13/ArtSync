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
    
    <?php include('header.php'); ?>

    <div class="collection-container"> <!-- Classe de contêiner -->
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

    <footer>
        <div class="container-footer">
            <div class="row-footer">
                <div class="footer-col footer-logo"> 
                    <img src="logo.png" alt="artsync">
                </div>
                <div class="footer-col">
                    <h4><b>INSCREVA-SE PARA RECEBER NOSSO NEWSLETTER</b></h4>
                    <div class="form-sub">
                        <form id="newsletter-form">
                            <input type="email" placeholder="Digite o seu e-mail" required>
                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                    <div class="contact-section">
                        <p><i class="fa fa-clock"></i> Das 08:00 às 21:00</p>
                        <p><i class="fa fa-phone"></i> +55 16 99344-2527</p>
                    </div>
                    <div class="social-icons">
                        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="mailto:contato@na.na"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
