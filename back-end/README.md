"# UniversalScore - Estrutura do Projeto

## 📁 Organização de Pastas

```
back-end/
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
├── pages/                        # Páginas HTML organizadas por módulo
│   ├── auth/
│   │   ├── login.html
│   │   └── register.html
│   ├── dashboard/
│   │   └── index.html            # Página inicial
│   ├── products/
│   │   └── products.html
│   ├── ratings/
│   │   └── ratings.html
│   ├── indicators/
│   │   └── indicators.html
│   └── account/
│       └── account.html
│
├── images/                       # Imagens do projeto
│   └── UniversalScore.png
│
└── README.md
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

## 🔗 Navegação

- **Login/Register**: `/pages/auth/login.html` e `/pages/auth/register.html`
- **Dashboard**: `/pages/dashboard/index.html`
- **Produtos**: `/pages/products/products.html`
- **Avaliações**: `/pages/ratings/ratings.html`
- **Indicadores**: `/pages/indicators/indicators.html`
- **Conta**: `/pages/account/account.html`

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
