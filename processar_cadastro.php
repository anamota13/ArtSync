<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "artsync_pi"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $titulo = $_POST['titulo'];
    $artista = $_POST['artista'];
    $ano = $_POST['ano'];
    $descricao = $_POST['descricao'];

   
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $imagem_nome = $_FILES['imagem']['name'];
        $imagem_tmp = $_FILES['imagem']['tmp_name'];
        $imagem_destino = 'img_obras/' . basename($imagem_nome);

       
        if (move_uploaded_file($imagem_tmp, $imagem_destino)) {
            
            $sql = "INSERT INTO obras (titulo, artista, ano, descricao, imagem) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            
            if (!$stmt) {
                die("Erro na preparação da consulta: " . $conn->error);
            }

            $stmt->bind_param("ssiss", $titulo, $artista, $ano, $descricao, $imagem_nome); 

            if ($stmt->execute()) {
                
                echo "<script>
                        alert('Obra cadastrada com sucesso!');
                        window.location.href = 'colecao.php';
                      </script>";
                exit(); 
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


$conn->close();
?>
