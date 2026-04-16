"# UniversalScore - Estrutura do Projeto

## 📁 Organização de Pastas

```
back-end/
├── index.php                     # Entry point principal com roteador
│
├── includes/                     # Componentes e configurações PHP reutilizáveis
│   ├── config.php                # Configurações globais e funções
│   ├── router.php                # Sistema de roteamento dinâmico
│   ├── header.php                # Componente header reutilizável
│   └── footer.php                # Componente footer reutilizável
│
├── css/                          # Estilos consolidados
│   ├── styles.css                # Estilos globais
│   ├── auth.css                  # Estilos para login e registro
│   └── pages.css                 # Estilos para páginas de conteúdo
│
├── js/                           # Scripts consolidados
│   ├── common.js                 # Funções compartilhadas (localStorage, validação)
│   ├── auth.js                   # Funções de autenticação (login, registro)
│   ├── product.js                # Lógica de produtos
│   ├── rating.js                 # Lógica de avaliações
│   ├── indicators.js             # Lógica de indicadores
│   ├── account.js                # Lógica de conta do usuário
│   └── dashboard.js              # Lógica do dashboard
│
├── pages/                        # Páginas PHP organizadas por módulo
│   ├── auth/
│   │   ├── login.php             # Página de login
│   │   └── register.php          # Página de cadastro
│   ├── dashboard/
│   │   └── index.php             # Página inicial
│   ├── products/
│   │   └── products.php          # Gerenciar produtos
│   ├── ratings/
│   │   └── ratings.php           # Avaliar produtos
│   ├── indicators/
│   │   └── indicators.php        # Ver indicadores
│   └── account/
│       └── account.php           # Gerenciar conta
│
├── images/                       # Imagens do projeto
│   └── UniversalScore.png
│
├── README.md                     # Este arquivo
└── PHP_ROUTING.md                # Documentação do sistema de roteamento
```

## 🎯 Arquivos CSS

### `styles.css` - Base Global
- Header e logo
- Buttons e estados
- Tables
- Modal boxes
- Form inputs
- Star rating
- Cards
- Empty states

### `auth.css` - Autenticação
- Layout de login/registro
- Formulários de autenticação
- Estilos específicos de páginas auth

### `pages.css` - Páginas de Conteúdo
- Grid layouts
- Indicadores
- Tabelas
- Cards de produtos/avaliações
- Modais especializados
- Dashboard

## 🔧 Arquivos JavaScript

### `common.js` - Funções Compartilhadas
- `getCurrentUser()` - Recupera usuário da sessão
- `getUsers/Products/Ratings()` - Recupera dados do localStorage
- `saveUsers/Products/Ratings()` - Salva dados no localStorage
- `escapeHtml()` - Proteção contra XSS
- `formatDate/DateTime()` - Formatação de datas
- `checkLogin()` - Verifica se está logado
- `logout()` - Faz logout
- `showUserGreeting()` - Mostra saudação
- `setupOverlayClickHandler()` - Handler para overlay

### `auth.js` - Autenticação
- `handleLogin()` - Processa login
- `handleRegister()` - Processa registro
- `setCurrentUser()` - Define usuário logado
- `initLoginForm()` - Inicializa form de login
- `initRegisterForm()` - Inicializa form de registro

### `product.js` - Produtos
- `renderProducts()` - Renderiza grid de produtos
- `deleteProduct()` - Deleta produto
- `goToRate()` - Vai para avaliar
- `addProduct()` - Adiciona novo produto
- `initProductsPage()` - Inicializa página

### `rating.js` - Avaliações
- `renderProducts()` - Renderiza produtos com estatísticas
- `calculateAverageRating()` - Calcula média de avaliações
- `getProductRatings()` - Recupera avaliações de um produto
- `openRatingForm()` - Abre modal de avaliação
- `addRating()` - Adiciona nova avaliação
- `initRatingsPage()` - Inicializa página

### `indicators.js` - Indicadores
- `renderIndicators()` - Renderiza dashboard de KPIs
- `initIndicatorsPage()` - Inicializa página

### `account.js` - Conta
- `loadUserInfo()` - Carrega informações do usuário
- `openChangePasswordModal()` - Abre modal de senha
- `changePassword()` - Altera senha
- `deleteAccount()` - Deleta conta
- `initAccountPage()` - Inicializa página

### `dashboard.js` - Dashboard
- `initDashboardPage()` - Inicializa página inicial

## 📦 LocalStorage

### users
```javascript
[
  {
    id: number,
    name: string,
    email: string,
    password: string,
    createdAt: string (ISO)
  }
]
```

### products
```javascript
[
  {
    id: string,
    userId: number,
    name: string,
    category: string,
    price: number,
    description: string,
    createdAt: string (ISO)
  }
]
```

### ratings
```javascript
[
  {
    id: string,
    productId: string,
    userId: number,
    userName: string,
    rating: number (1-5),
    comment: string,
    createdAt: string (ISO)
  }
]
```

### currentUser
```javascript
{
  id: number,
  name: string,
  email: string
}
```

## 🔗 Roteamento PHP

O projeto implementa um sistema de roteamento dinâmico em PHP:

### URLs de Acesso

```
http://localhost/index.php                      # Redireciona para dashboard
http://localhost/index.php?page=dashboard       # Dashboard
http://localhost/index.php?page=login           # Login
http://localhost/index.php?page=register        # Cadastro
http://localhost/index.php?page=products        # Produtos
http://localhost/index.php?page=ratings         # Avaliações
http://localhost/index.php?page=indicators      # Indicadores
http://localhost/index.php?page=account         # Conta
```

### Componentes PHP Reutilizáveis

- **includes/config.php** - Configurações globais e funções
- **includes/router.php** - Sistema de roteamento dinâmico
- **includes/header.php** - Componente de header reutilizável
- **includes/footer.php** - Componente de footer reutilizável

Para documentação completa, veja `PHP_ROUTING.md`.

## 🔗 Navegação Antiga (HTML Direto)

- **Login/Register**: `/pages/auth/login.html` e `/pages/auth/register.html`
- **Dashboard**: `/pages/dashboard/index.html`
- **Produtos**: `/pages/products/products.html`
- **Avaliações**: `/pages/ratings/ratings.html`
- **Indicadores**: `/pages/indicators/indicators.html`
- **Conta**: `/pages/account/account.html`

**Nota**: Usar as URLs PHP acima é recomendado para aproveitar o sistema de roteamento.

## ⚙️ Importações

Cada página HTML importa:
1. `../../css/styles.css` - Base global
2. `../../css/[tipo].css` - CSS específico (auth.css ou pages.css)
3. `../../js/common.js` - Funções compartilhadas
4. `../../js/[funcao].js` - JS específico da página

## 🚀 Como Usar

1. Abra `/pages/dashboard/index.html` para a página inicial
2. Faça login com: `meuemail@gmail.com` / `1234`
3. Navegue pelas opções disponíveis
4. Todos os dados são salvos localmente no navegador

## 🔐 Autenticação

- Usuário de teste criado automaticamente na primeira execução
- Email: `meuemail@gmail.com`
- Senha: `1234`
- Senha persistida no localStorage (apenas para demo)

---

**Desenvolvido com ❤️ para UniversalScore**" 
