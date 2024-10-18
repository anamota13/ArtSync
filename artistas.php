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



        
    <div class="artistas-wrapper">
        <section class="artistas-section">
            <div class="art-dest">
                <img src="img/ARTISTA DESTAQUE (1).png" alt="Tarsila do Amaral">
            </div>
            <div class="linha-vertical3"></div>
            <div class="texto-banner3">
                TARSILA DO AMARAL<br>(1886 - 1973)<br>
                <p>Foi uma pioneira do modernismo brasileiro e uma das mais influentes pintoras do país.
                    Com obras icônicas como "Abaporu" (ilustração ao lado) e "A Negra" (ilustração ao lado), 
                    ela combinou elementos da cultura brasileira com influências europeias, criando uma estética 
                    única que redefiniu a arte nacional.
                </p>
                <div class="button-saiba-mais-tarsila">
                    <a href="https://www.tarsiladoamaral.com.br/">Saiba mais</a>
                </div>
            </div>
        </section>
    </div>    

    
    <section class="principais-artistas">
        <div class="divs">
        <h1>PRINCIPAIS ARTISTAS </h1>
        <div class="grid-container">
    <div class="container">
    <img src="img/romero.png" alt="Descrição da Imagem">
    <div class="text">
        <h2>Romero Britto <br>(1963)</h2>
        <p></p>
        <p> Artista brasileiro contemporâneo famoso por suas obras coloridas que combinam elementos do pop art e cubismo. Suas criações, marcadas por formas geométricas, 
            traços grossos e vibrantes, conquistaram o mundo da arte moderna e do design.</p>
        
    </div>
    </div>

    <div class="container">
        <img src="img/anita.png" alt="Descrição da Imagem">
        <div class="text">
            <h2>Anita Malfatti <br> (1889 - 1964)</h2>
            <p> </p>
            <p>Foi uma artista brasileira pioneira do modernismo, conhecida por sua abordagem expressionista e suas contribuições significativas para a arte moderna no Brasil.
                Anita Malfatti expôs seus trabalhos, totalizando 20 telas
            </p>
            
            </div>
        </div>

        <div class="container">
            <img src="img/candido.png" alt="Descrição da Imagem">
            <div class="text">
                <h2>Cândido Portinari <br> (1903-1962)</h2>
                <p> Renomado pintor brasileiro, famoso por retratar a vida e a cultura do Brasil com um estilo único. Suas obras destacam-se pelo uso de cores vibrantes e pela abordagem de temas sociais, políticos e cotidianos, refletindo a realidade brasileira.
                </p>
                
                </div>
            </div>

            <div class="container">
                <img src="img/calvacanti.png" alt="Descrição da Imagem">
                <div class="text">
                    <h2>Di Cavalcanti <br> (1897-1976) </h2>
                    
                    <p> Conhecido por suas pinturas que exploram a vida urbana e o cotidiano do Brasil. Seu estilo expressionista e o uso de cores vivas capturam a essência da sociedade carioca, retratando cenas de samba, festas e figuras populares.
                    </p>
                    
                    </div>
                </div>

                <div class="container">
                    <img src="img/vicente.png" alt="Descrição da Imagem">
                    <div class="text">
                        <h2>Vicente do Rego Monteiro <br>(1899–1970)</h2>
                        <p></p>
                        <p> Artista brasileiro multifacetado, Monteiro atuou como pintor, escultor e ilustrador. Sua obra reflete influências do cubismo e da arte indígena brasileira, criando uma síntese única entre modernismo europeu e cultura nativa.
                        </p>
                        
                    </div>
                </div>
        
                <div class="container">
                    <img src="img/zina.png" alt="Descrição da Imagem">
                    <div class="text">
                        <h2>Zina Aita<br> (1900–1967)</h2>
                        <p> </p>
                        <p>Pintora modernista brasileira, Aita foi uma das pioneiras do modernismo no Brasil. Seu trabalho é caracterizado por um estilo colorido e vibrante, muitas vezes 
                            influenciado por temáticas religiosas e folclóricas.</p>
                        
                        </div>
                    </div>
    
                    <div class="container">
                        <img src="img/pablo.png" alt="Descrição da Imagem">
                        <div class="text">
                            <h2>Pablo Picasso<br> (1881–1973)</h2>
                            <p> Um dos mais influentes artistas do século 20, Picasso foi cofundador do cubismo, revolucionando a pintura e a escultura. Suas obras abordaram diversos estilos ao longo de sua carreira, incluindo o período azul, 
                                o período rosa e o surrealismo. </p>
                        
                            </div>
                        </div>
    
                        <div class="container">
                            <img src="img/lasar.png" alt="Descrição da Imagem">
                            <div class="text">
                                <h2>Lasar Segall<br>  (1891–1957)</h2>
                                
                                <p> Artista lituano-brasileiro, Segall foi uma figura importante no modernismo brasileiro. Ele trouxe para o Brasil influências do expressionismo europeu, que se refletem em suas obras marcadas por tons melancólicos. </p>
                                
                                </div>
                            </div>

                            <div class="container">
                                <img src="img/oswaldogoeldi.jpg" alt="Descrição da Imagem">
                                <div class="text">
                                    <h2>Oswaldo Goeldi<br> (1895 – 1961)</h2>
                                    
                                    <p> Foi um gravurista brasileiro conhecido por suas xilogravuras de estilo sombrio. Suas obras retratam paisagens urbanas melancólicas e cenas de solidão. Influenciado pelo expressionismo, ele se destacou pela atmosfera dramática em suas criações. </p>
                                    
                                    </div>
                                </div>
                
            </div>

            
        </div> 
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
                            <input type="hidden" name="redirect_page" value="<?php echo basename($_SERVER['PHP_SELF']); ?>"> 
                            <button type="submit">Enviar</button>
                        </form>
                    </div>                    
                    <div class="contact-section">
                        <p><i class="fa fa-clock"></i>Das 08:00 às 18:00</p>
                        <p><i class="fa fa-phone"></i> +55 16 99297-1607</p>
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
