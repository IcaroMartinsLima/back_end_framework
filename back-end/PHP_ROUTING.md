# Sistema de Roteamento PHP - UniversalScore

## 📋 Visão Geral

O projeto agora utiliza um sistema de roteamento dinâmico em PHP que gerencia todas as páginas e componentes reutilizáveis.

## 🗂️ Estrutura de Arquivos

```
back-end/
├── index.php                 # Entry point principal
├── includes/
│   ├── config.php           # Configurações globais
│   ├── router.php           # Sistema de roteamento
│   ├── header.php           # Componente header
│   └── footer.php           # Componente footer
├── pages/
│   ├── auth/
│   │   ├── login.php        # Página de login
│   │   └── register.php     # Página de cadastro
│   ├── dashboard/
│   │   └── index.php        # Dashboard principal
│   ├── products/
│   │   └── products.php     # Gerenciar produtos
│   ├── ratings/
│   │   └── ratings.php      # Avaliar produtos
│   ├── indicators/
│   │   └── indicators.php   # Ver indicadores
│   └── account/
│       └── account.php      # Gerenciar conta
├── css/
│   ├── styles.css
│   ├── auth.css
│   └── pages.css
├── js/
│   ├── common.js
│   ├── auth.js
│   ├── dashboard.js
│   ├── product.js
│   ├── rating.js
│   ├── indicators.js
│   └── account.js
└── images/
    └── UniversalScore.png
```

## 🚀 Como Usar

### URLs de Navegação

O sistema usa parâmetro GET `page` para roteamento:

```
http://localhost/index.php?page=dashboard      # Dashboard
http://localhost/index.php?page=login           # Login
http://localhost/index.php?page=register        # Cadastro
http://localhost/index.php?page=products        # Produtos
http://localhost/index.php?page=ratings         # Avaliações
http://localhost/index.php?page=indicators      # Indicadores
http://localhost/index.php?page=account         # Conta
```

### Funções Globais (includes/config.php)

```php
getBaseUrl()                    # Retorna a URL base da aplicação
redirect($path)                 # Redireciona para um caminho específico
isLoggedIn()                    # Verifica se usuário está logado
```

### Roteador (includes/router.php)

```php
getPagePath($page)              # Retorna o caminho do arquivo PHP
sanitizeInput($input)           # Sanitiza entrada do usuário
includePageContent($pagePath)   # Inclui o conteúdo da página
```

### Componentes Reutilizáveis

#### Header (includes/header.php)
- Inclui em todas as páginas
- Exibe logo e botões de autenticação
- Mostra nome do usuário quando logado

#### Footer (includes/footer.php)
- Inclui em todas as páginas
- Informações de copyright

## 📝 Exemplo de Nova Página

Para criar uma nova página:

1. Crie o arquivo em `pages/nova-secao/nova.php`
2. Adicione o mapa na função `getPagePath()` em `includes/router.php`
3. Implemente o conteúdo PHP

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
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/styles.css">
    <title>Nova Página - UniversalScore</title>
</head>
<body>
    <?php include INCLUDES_PATH . '/header.php'; ?>
    
    <div class="page-container">
        <!-- Conteúdo aqui -->
    </div>
    
    <?php include INCLUDES_PATH . '/footer.php'; ?>
    
    <script src="<?php echo JS_PATH; ?>/common.js"></script>
</body>
</html>
```

## 🔒 Segurança

- Todas as entradas são sanitizadas via `sanitizeInput()`
- Proteção contra path traversal
- Validação de acesso às páginas

## 💾 Storage

- **localStorage**: Cliente (usuários, produtos, avaliações)
- **Sessões PHP**: Servidor (quando necessário)

## 🔄 Fluxo de Navegação

1. Usuário acessa `index.php`
2. Router verifica o parâmetro `page`
3. Sistema carrega a página correspondente
4. Componentes (header/footer) são incluídos
5. JavaScript (common.js) é carregado para funcionalidade

## ✅ Checklist de Páginas

- ✅ Login (`?page=login`)
- ✅ Cadastro (`?page=register`)
- ✅ Dashboard (`?page=dashboard`)
- ✅ Produtos (`?page=products`)
- ✅ Avaliações (`?page=ratings`)
- ✅ Indicadores (`?page=indicators`)
- ✅ Conta (`?page=account`)

---

**Versão:** 1.0.0
**Última atualização:** Abril 2026
