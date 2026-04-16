<?php
/**
 * Componente Header
 * Reutilizável em todas as páginas
 */
?>
<header class="header">
    <div class="logged-header" id="authHeader">
        <div style="display: flex; align-items: center; gap: 15px;">
            <img src="<?php echo getBaseUrl(); ?>/images/UniversalScore.png" alt="UniversalScore Logo" class="logo" style="height: 40px;">
        </div>
        <div class="buttons" id="authButtons">
            <a href="<?php echo getBaseUrl(); ?>/index.php?page=login" class="button">Login</a>
            <a href="<?php echo getBaseUrl(); ?>/index.php?page=register" class="button">Cadastro</a>
        </div>
        <div id="userSection" style="display: none; align-items: center; gap: 15px; color: white;">
            <span class="logged-user-info">Bem-vindo, <span class="logged-user-name" id="userName"></span>!</span>
            <button class="button" style="background-color: rgb(172, 14, 14);" onclick="logout()">Sair</button>
        </div>
    </div>
</header>
