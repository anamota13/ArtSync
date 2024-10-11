<?php
session_start(); // Inicia a sessão
?>

<!DOCTYPE html>
<html lang="pt-BR">
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
    <nav>
        <ul>
            <li><a href="index.html" class="link">Sobre nós</a></li>
            <li><a href="artistas.html" class="link">Artistas</a></li>
            <li><a href="colecao.php" class="link">Coleção</a></li>
            <li><a href="visitas.html" class="link">Visitas</a></li>
            <li><a href="artemoderna.html" class="link">Arte Moderna</a></li>
            <?php if (isset($_SESSION['nome_usuario'])): ?>
                <li class="user-greeting">Olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</li>
                <li><a href="logout.php" class="logout-button">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" class="login-button">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <!-- Exibir mensagens de sucesso ou erro -->
    <?php
    if (isset($_SESSION['mensagem'])) {
        $classe = isset($_SESSION['tipo_mensagem']) && $_SESSION['tipo_mensagem'] === 'erro' ? 'mensagem-erro' : 'mensagem-sucesso';
        echo "<div class='{$classe}'>" . $_SESSION['mensagem'] . "</div>";
        unset($_SESSION['mensagem']);
        unset($_SESSION['tipo_mensagem']);
    }
    ?>

    <div class="colecao-wrapper">
        <section class="colecao-section">
            <div class="colecao">
                <img src="img/folder_colecao.png" alt="Obras de arte">
            </div>
            <div class="linha-vertical2"></div>
            <div class="texto-banner2">
                NOSSA<br>COLEÇÃO<br>
                <p>EXPLORANDO A ARTE EM TODAS <br>AS SUAS FORMAS<br></p>
            </div>
        </section>
    </div>
    
    <section class="corpo">
        <p>A coleção da Galerie Belle Époque reúne obras de arte que vão desde o abstrato ao expressionismo. Com uma curadoria cuidadosa, apresentamos peças que desafiam as normas e convidam à reflexão. Descubra nossa vasta coleção de arte moderna, onde cada peça desafia as convenções e abre novas possibilidades de expressão.</p>
        
        <!-- Botão de Cadastrar Nova Obra para Admin -->
        <div class="novo-obra-btn">
            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
                <a href="cadastrar_obra.php" class="button">✚ Cadastrar Nova Obra</a>
            <?php endif; ?>
        </div>
    </section>
    
    <div class="collection-container"> 
        <div class="obras-list">
            <?php
            // Conectar ao banco de dados
            $conn = new mysqli('localhost', 'root', '', 'artsync_pi');

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Consultar as obras cadastradas
            $sql = "SELECT * FROM obras"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Exibir as obras
                while($row = $result->fetch_assoc()) {
                    echo "<div class='obra-item'>";
                    echo "<img src='img_obras/" . htmlspecialchars($row['imagem']) . "' alt='" . htmlspecialchars($row['titulo']) . "' class='obra-imagem'>";
                    echo "<div class='obra-info'>";
                    echo "<h3 class='obra-titulo'>" . htmlspecialchars($row['titulo']) . "</h3>";
                    echo "<p class='obra-artista'><strong>Artista:</strong> " . htmlspecialchars($row['artista']) . "</p>";
                    echo "<p class='obra-ano'><strong>Ano:</strong> " . htmlspecialchars($row['ano']) . "</p>";
                    echo "<p class='obra-descricao'>" . htmlspecialchars($row['descricao']) . "</p>";
                    echo "</div>";

                    // Adicionar botão de excluir para administradores
                    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
                        echo "<a href='excluir_obra.php?id=" . $row['id'] . "' class='btn-excluir' onclick=\"return confirm('Tem certeza que deseja excluir esta obra?');\">Excluir</a>";
                    }

                    echo "</div>"; // Fim da obra-item
                }
            } else {
                echo "<p>Nenhuma obra cadastrada.</p>";
            }

            // Fechar a conexão
            $conn->close();
            ?>
        </div>
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
                        <form id="newsletter-form" action="processar_newsletter.php" method="post">
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
                            width="500" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
