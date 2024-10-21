<?php
session_start(); 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coleção</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <?php
    include('header.php'); 
    ?>


<script src="scripts.js"></script>



    
    <div class="collection-container">
        <h1>Cadastrar Nova Obra</h1>
        <form class="collection-form" action="processar_cadastro.php" method="post" enctype="multipart/form-data">
            <label for="titulo">Título da Obra</label>
            <input type="text" id="titulo" name="titulo" placeholder="Digite o título da obra" required>

            <label for="artista">Artista</label>
            <input type="text" id="artista" name="artista" placeholder="Digite o nome do artista" required>

            <label for="ano">Ano de Criação</label>
            <input type="number" id="ano" name="ano" placeholder="Digite o ano da obra" required>

            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" placeholder="Descrição da obra" required>

            <label for="imagem">Imagem da Obra</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required>

            <button type="submit">Cadastrar Obra</button>
        </form>
    </div>
</body>
</html>
