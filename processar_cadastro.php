<?php
// Configurações de conexão
$servername = "localhost"; // Ou o nome do servidor que você está usando
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados (deixe vazio se for padrão)
$dbname = "artsync_pi"; // Nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $titulo = $_POST['titulo'];
    $artista = $_POST['artista'];
    $ano = $_POST['ano'];
    $descricao = $_POST['descricao'];

    // Processando a imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $imagem_nome = $_FILES['imagem']['name'];
        $imagem_tmp = $_FILES['imagem']['tmp_name'];
        $imagem_destino = 'img_obras/' . basename($imagem_nome);

        // Move o arquivo para a pasta img_obras
        if (move_uploaded_file($imagem_tmp, $imagem_destino)) {
            // Inserir no banco de dados
            $sql = "INSERT INTO obras (titulo, artista, ano, descricao, imagem) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Verifique se a preparação foi bem-sucedida
            if (!$stmt) {
                die("Erro na preparação da consulta: " . $conn->error);
            }

            $stmt->bind_param("ssiss", $titulo, $artista, $ano, $descricao, $imagem_nome); // S - string, I - int

            if ($stmt->execute()) {
                // Cadastro realizado com sucesso, redireciona para a tela Coleção com um alerta
                echo "<script>
                        alert('Obra cadastrada com sucesso!');
                        window.location.href = 'colecao.php';
                      </script>";
                exit(); // Termina a execução do script
            } else {
                echo "Erro ao cadastrar a obra: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro ao mover a imagem.";
        }
    } else {
        echo "Erro no upload da imagem.";
    }
}

// Fechar a conexão
$conn->close();
?>
