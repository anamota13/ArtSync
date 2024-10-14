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


<script src="scripts.js"></script>



    
    <section class="corpo">
        <h1><center>GALERIE BELLE ÉPOQUE</center></h1>
        <h2><b>Nossa Galeria</b></h2>
        <p>&nbsp &nbsp &nbsp Bem-vindo à <b>Galerie Belle Époque</b>! Fundada com o objetivo de promover e celebrar a arte moderna, 
            nossa galeria é um espaço dedicado a artistas inovadores e a obras que desafiam as convenções. 
            Desde a sua inauguração, temos sido o lar de exposições marcantes e eventos culturais que inspiram 
            e conectam a comunidade local e além.</p>
        <h2>Sobre o sistema ArtSync</h2>
        <p> &nbsp &nbsp &nbsp Para garantir uma experiência excepcional tanto para nossos visitantes quanto para nossos administradores, 
            adotamos o ArtSync, uma solução inovadora de gerenciamento de galerias e museus. 
            O ArtSync permite que nossa equipe gerencie e atualize facilmente nossa coleção de obras de arte, 
            organize exposições e agende visitas com eficiência. Com funcionalidades como catálogo online, 
            agendamento de visitas e uma interface intuitiva para os administradores, o ArtSync nos ajuda 
            a manter a nossa galeria em perfeita ordem 
            e a proporcionar uma experiência fluida para todos os que nos visitam.</p>
    </section>
    
    <footer>
        <div class="container-footer">
            <div class="row-footer">
                <div class="footer-col footer-logo"> 
                    <img src="logo.png" alt="artsync">
                </div>
                
                <div class="footer-col">
                    <h4><b>INSCREVA-SE PARA RECEBER NOSSO NEWSLETTER</b></h4>
                    <div class="form-sub">
                        <form id="newsletter-form" action="newsletter_action.php" method="POST">
                            <input type="email" name="email" placeholder="Digite o seu e-mail" required>
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
