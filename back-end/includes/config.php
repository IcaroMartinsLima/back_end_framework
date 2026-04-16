<?php
/**
 * Configurações Globais
 */

// Define a raiz do projeto
define('APP_ROOT', dirname(dirname(__FILE__)));
define('INCLUDES_PATH', APP_ROOT . '/includes');
define('PAGES_PATH', APP_ROOT . '/pages');
define('CSS_PATH', '/css');
define('JS_PATH', '/js');

// Configurações de sessão
session_start();

// Função para obter a URL base
function getBaseUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['SCRIPT_NAME']);
    return $protocol . '://' . $host . $path;
}

// Função para redirecionar
function redirect($path) {
    header('Location: ' . getBaseUrl() . '/' . ltrim($path, '/'));
    exit;
}

// Função para verificar login
function isLoggedIn() {
    // Nota: Lógica de autenticação será feita com JS/localStorage no cliente
    return true;
}

?>
