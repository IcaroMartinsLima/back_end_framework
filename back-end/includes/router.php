<?php
/**
 * Router - Sistema de Roteamento Dinâmico
 * Controla qual página é carregada baseado no parâmetro 'page'
 */

function getPagePath($page) {
    // Mapa de páginas para caminhos de arquivos
    $pages = [
        'dashboard' => PAGES_PATH . '/dashboard/index.php',
        'login' => PAGES_PATH . '/auth/login.php',
        'register' => PAGES_PATH . '/auth/register.php',
        'products' => PAGES_PATH . '/products/products.php',
        'ratings' => PAGES_PATH . '/ratings/ratings.php',
        'indicators' => PAGES_PATH . '/indicators/indicators.php',
        'account' => PAGES_PATH . '/account/account.php',
    ];

    // Retorna a página solicitada ou dashboard como padrão
    $page = isset($_GET['page']) ? sanitizeInput($_GET['page']) : 'dashboard';
    
    return isset($pages[$page]) ? $pages[$page] : $pages['dashboard'];
}

function sanitizeInput($input) {
    return preg_replace('/[^a-zA-Z0-9_-]/', '', $input);
}

function includePageContent($pagePath) {
    if (file_exists($pagePath)) {
        include $pagePath;
    } else {
        echo '<div style="color: red; padding: 20px;">Página não encontrada: ' . htmlspecialchars($pagePath) . '</div>';
    }
}

?>
