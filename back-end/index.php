<?php
/**
 * UniversalScore - Sistema de Avaliações
 * Entry Point Principal (index.php)
 */

require_once 'includes/config.php';
require_once 'includes/router.php';

// Obter página atual
$page = isset($_GET['page']) ? sanitizeInput($_GET['page']) : 'dashboard';
$pagePath = getPagePath($page);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/styles.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/auth.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/pages.css">
    <title>UniversalScore</title>
    <style>
        body {
            background: linear-gradient(135deg, #0A0C14 0%, #0E1726 100%);
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(90deg, #0c0c0c, #1a1a1a);
        }

        .index-content {
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 40px;
            min-height: calc(100vh - 100px);
        }

        .welcome-section {
            text-align: center;
            color: white;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-section h1 {
            font-size: 42px;
            margin-bottom: 10px;
            text-shadow: 0px 0px 15px rgba(21, 84, 204, 0.8);
        }

        .welcome-section p {
            font-size: 18px;
            color: #aaa;
            margin-bottom: 10px;
        }

        .welcome-section .subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .navigation-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 900px;
        }

        .nav-card {
            background: #ffffff10;
            backdrop-filter: blur(10px);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            color: white;
        }

        .nav-card:hover {
            border-color: #1554CC;
            background: #ffffff15;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(21, 84, 204, 0.2);
        }

        .nav-card .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .nav-card h3 {
            margin: 0 0 10px;
            color: #1554CC;
            font-size: 18px;
        }

        .nav-card p {
            color: #aaa;
            font-size: 14px;
            margin: 0;
        }

        .logged-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 0 20px;
        }

        .logged-user-info {
            color: white;
            font-size: 16px;
        }

        .logged-user-name {
            color: #1554CC;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include INCLUDES_PATH . '/header.php'; ?>

    <div class="index-content" id="indexContent">
        <div class="welcome-section" id="welcomeSection">
            <h1>UniversalScore</h1>
            <p>A plataforma de avaliações mais confiável</p>
            <p class="subtitle">Faça login para começar</p>
        </div>

        <div class="welcome-section" id="loggedWelcome" style="display: none;">
            <h1>Bem-vindo, <span id="welcomeName" class="logged-user-name"></span>!</h1>
            <p>Escolha uma opção abaixo para continuar</p>
        </div>

        <div class="navigation-section" id="navSection" style="display: none;">
            <a href="<?php echo getBaseUrl(); ?>/index.php?page=products" class="nav-card">
                <div class="icon">📦</div>
                <h3>Produtos</h3>
                <p>Gerenciar produtos e suas informações</p>
            </a>

            <a href="<?php echo getBaseUrl(); ?>/index.php?page=ratings" class="nav-card">
                <div class="icon">⭐</div>
                <h3>Avaliações</h3>
                <p>Avaliar produtos e ver avaliações</p>
            </a>

            <a href="<?php echo getBaseUrl(); ?>/index.php?page=indicators" class="nav-card">
                <div class="icon">📊</div>
                <h3>Indicadores</h3>
                <p>Ver estatísticas e indicadores</p>
            </a>

            <a href="<?php echo getBaseUrl(); ?>/index.php?page=account" class="nav-card">
                <div class="icon">👤</div>
                <h3>Conta</h3>
                <p>Gerenciar informações da sua conta</p>
            </a>
        </div>
    </div>

    <?php 
    // Se a página é a dashboard, carrega o conteúdo da página específica
    if ($page !== 'dashboard' && $page !== 'login' && $page !== 'register') {
        echo '<div style="display: none;" id="pageContent">';
        includePageContent($pagePath);
        echo '</div>';
    }
    ?>

    <?php include INCLUDES_PATH . '/footer.php'; ?>

    <script src="<?php echo JS_PATH; ?>/common.js"></script>
    <script src="<?php echo JS_PATH; ?>/auth.js"></script>
    <script src="<?php echo JS_PATH; ?>/dashboard.js"></script>

    <script>
        // Obter página via URL
        const urlParams = new URLSearchParams(window.location.search);
        const page = urlParams.get('page');

        // Se houver uma página específica (não dashboard), redireciona dinamicamente
        if (page && page !== 'dashboard') {
            navigateToPage(page);
        }

        function navigateToPage(pageName) {
            const baseUrl = '<?php echo getBaseUrl(); ?>';
            window.location.href = baseUrl + '/index.php?page=' + pageName;
        }

        // Função para logout via PHP
        function logout() {
            localStorage.removeItem("currentUser");
            window.location.href = '<?php echo getBaseUrl(); ?>/index.php?page=dashboard';
        }

        function checkLogin() {
            const user = getCurrentUser();
            const authButtons = document.getElementById("authButtons");
            const userSection = document.getElementById("userSection");
            const navSection = document.getElementById("navSection");
            const welcomeSection = document.getElementById("welcomeSection");
            const loggedWelcome = document.getElementById("loggedWelcome");

            if (user) {
                authButtons.style.display = "none";
                userSection.style.display = "flex";
                navSection.style.display = "grid";
                welcomeSection.style.display = "none";
                loggedWelcome.style.display = "block";

                document.getElementById("userName").textContent = user.name;
                document.getElementById("welcomeName").textContent = user.name;
            } else {
                authButtons.style.display = "flex";
                userSection.style.display = "none";
                navSection.style.display = "none";
                welcomeSection.style.display = "block";
                loggedWelcome.style.display = "none";
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            checkLogin();
        });
    </script>
</body>
</html>
