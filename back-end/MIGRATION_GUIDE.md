# Guia de Migração: HTML para PHP

## ✅ O que foi feito

O projeto foi completamente refatorado para utilizar um sistema de roteamento PHP dinâmico. Todas as páginas HTML foram convertidas para PHP com componentes reutilizáveis.

## 📋 Checklist de Migração

- ✅ Criado arquivo `index.php` como entry point principal
- ✅ Criado `includes/config.php` com configurações globais
- ✅ Criado `includes/router.php` com sistema de roteamento
- ✅ Criado `includes/header.php` como componente reutilizável
- ✅ Criado `includes/footer.php` como componente reutilizável
- ✅ Convertido `pages/auth/login.html` → `pages/auth/login.php`
- ✅ Convertido `pages/auth/register.html` → `pages/auth/register.php`
- ✅ Convertido `pages/dashboard/index.html` → `pages/dashboard/index.php`
- ✅ Convertido `pages/products/products.html` → `pages/products/products.php`
- ✅ Convertido `pages/ratings/ratings.html` → `pages/ratings/ratings.php`
- ✅ Convertido `pages/indicators/indicators.html` → `pages/indicators/indicators.php`
- ✅ Convertido `pages/account/account.html` → `pages/account/account.php`

## 🔄 Como Funciona o Roteamento

### 1. Entry Point (index.php)

```php
<?php
require_once 'includes/config.php';
require_once 'includes/router.php';

$page = isset($_GET['page']) ? sanitizeInput($_GET['page']) : 'dashboard';
$pagePath = getPagePath($page);
?>
```

### 2. Mapeamento de Páginas (includes/router.php)

```php
function getPagePath($page) {
    $pages = [
        'dashboard' => PAGES_PATH . '/dashboard/index.php',
        'login' => PAGES_PATH . '/auth/login.php',
        'register' => PAGES_PATH . '/auth/register.php',
        'products' => PAGES_PATH . '/products/products.php',
        'ratings' => PAGES_PATH . '/ratings/ratings.php',
        'indicators' => PAGES_PATH . '/indicators/indicators.php',
        'account' => PAGES_PATH . '/account/account.php',
    ];
    
    $page = isset($_GET['page']) ? sanitizeInput($_GET['page']) : 'dashboard';
    return isset($pages[$page]) ? $pages[$page] : $pages['dashboard'];
}
```

### 3. Cada Página PHP

Começa com:
```php
<?php
require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
...
<?php include INCLUDES_PATH . '/header.php'; ?>
<!-- Conteúdo -->
<?php include INCLUDES_PATH . '/footer.php'; ?>
```

## 🆕 Como Adicionar uma Nova Página

### Passo 1: Criar o arquivo PHP

Crie em `pages/nova-secao/nova.php`:

```php
<?php
/**
 * Nova Página
 * pages/nova-secao/nova.php
 */
require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/styles.css">
    <title>Nova Página - UniversalScore</title>
</head>
<body>
    <?php include INCLUDES_PATH . '/header.php'; ?>
    
    <div class="page-container">
        <h1>Minha Nova Página</h1>
        <!-- Conteúdo aqui -->
    </div>
    
    <?php include INCLUDES_PATH . '/footer.php'; ?>
    
    <script src="<?php echo JS_PATH; ?>/common.js"></script>
</body>
</html>
```

### Passo 2: Atualizar o Router

Em `includes/router.php`, adicione ao mapa de páginas:

```php
$pages = [
    'dashboard' => PAGES_PATH . '/dashboard/index.php',
    'login' => PAGES_PATH . '/auth/login.php',
    'register' => PAGES_PATH . '/auth/register.php',
    'products' => PAGES_PATH . '/products/products.php',
    'ratings' => PAGES_PATH . '/ratings/ratings.php',
    'indicators' => PAGES_PATH . '/indicators/indicators.php',
    'account' => PAGES_PATH . '/account/account.php',
    'nova' => PAGES_PATH . '/nova-secao/nova.php',  // ← ADICIONE AQUI
];
```

### Passo 3: Acessar a Página

```
http://localhost/index.php?page=nova
```

## 🔧 Constantes Disponíveis

Definidas em `includes/config.php`:

```php
APP_ROOT          # Raiz da aplicação
INCLUDES_PATH     # Caminho para /includes
PAGES_PATH        # Caminho para /pages
CSS_PATH          # Caminho relativo /css
JS_PATH           # Caminho relativo /js
```

## 🎯 Vantagens do Sistema PHP

### Antes (HTML puro)
- ❌ Código duplicado em header/footer
- ❌ Difícil manutenção de URLs
- ❌ Sem verificação de autenticação no servidor

### Depois (PHP com Roteador)
- ✅ Componentes reutilizáveis
- ✅ URLs dinâmicas e limpas
- ✅ Possibilidade de validação servidor
- ✅ Cache e otimizações
- ✅ Segurança aprimorada

## 📝 Exemplo Real

### Antes:
- `login.html` duplicava header/footer
- Links diretos: `<a href="dashboard.html">`
- Sem autenticação no servidor

### Depois:
- `login.php` inclui `header.php` dinamicamente
- Links padronizados: `<a href="<?php echo getBaseUrl(); ?>/index.php?page=dashboard">`
- Possibilidade de validação: `<?php if (!isLoggedIn()) redirect('/login'); ?>`

## 🚀 Próximos Passos

1. **API Backend**: Implementar endpoints PHP para salvar dados em banco de dados
2. **Autenticação Servidor**: Mover validação de credenciais para PHP
3. **Cache**: Implementar cache de páginas
4. **Logs**: Adicionar sistema de logs de acesso
5. **Validação**: Implementar validação completa no servidor

---

**Versão:** 1.0.0
**Última atualização:** Abril 2026
