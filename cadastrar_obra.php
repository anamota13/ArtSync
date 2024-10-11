<?php
session_start(); // Inicia a sessão

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
    include('header.php'); // Inclui o cabeçalho
    ?>

<!-- Carregando o arquivo JavaScript -->
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
                    <div class="maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.788034016978!2d-47.403269224983326!3d-20.514913781008914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94b0a650b93c4b5f%3A0xbe0e42f3aa42525c!2sFatec%20Franca%20-%20Faculdade%20de%20Tecnologia%20de%20Franca%20Dr%20Thomaz%20Novelino!5e0!3m2!1spt-BR!2sbr!4v1727284305686!5m2!1spt-BR!2sbr" 
                                width="500vh" height="250vh" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
