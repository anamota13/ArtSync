<nav>
    <ul>
        <li><a href="index.php" class="link">Sobre nós</a></li>
        <li><a href="artistas.php" class="link">Artistas</a></li>
        <li><a href="colecao.php" class="link">Coleção</a></li>
        <li><a href="visitas.php" class="link">Visitas</a></li>
        <li><a href="artemoderna.php" class="link">Arte Moderna</a></li>
        <?php if (isset($_SESSION['nome_usuario'])): ?>
            <li class="user-menu">
                <span class="user-name" onclick="toggleMenu()">Olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?> <i class="arrow-down"></i></span>
                <div id="dropdown" class="dropdown-content">
                    <a href="logout.php">Sair</a>
                </div>
            </li>
        <?php else: ?>
            <li><a href="login.html" class="login-button">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
