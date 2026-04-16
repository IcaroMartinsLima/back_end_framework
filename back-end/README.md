# UniversalScore - Sistema de Avaliações

Plataforma web para gerenciar e avaliar produtos. Desenvolvida com HTML5, CSS3 e JavaScript vanilla, utilizando localStorage para persistência de dados.

## 📁 Estrutura de Arquivos

```
back-end/
├── index.html                # Página inicial / Dashboard
├── login.html                # Página de login
├── register.html             # Página de registro
├── products.html             # Gerenciar produtos
├── ratings.html              # Avaliar produtos
├── indicators.html           # Indicadores e estatísticas
├── account.html              # Gerenciar conta
│
├── styles.css                # Estilos globais (consolidado)
│
├── commonScript.js           # Funções compartilhadas
├── loginScript.js            # Lógica de autenticação
├── homeScript.js             # Lógica do dashboard
├── productScript.js          # Lógica de gerenciamento de produtos
├── ratingScript.js           # Lógica de avaliações
├── indicatorsScript.js       # Lógica de indicadores
├── accountScript.js          # Lógica de gerenciamento de conta
│
├── images/
│   └── UniversalScore.png    # Logo da aplicação
│
└── README.md                 # Este arquivo
```

## 🎯 Arquivos

### HTML Pages
- **index.html** - Dashboard principal com navegação
- **login.html** - Autenticação de usuários
- **register.html** - Criação de nova conta
- **products.html** - CRUD de produtos
- **ratings.html** - Avaliação de produtos
- **indicators.html** - Dashboard com estatísticas
- **account.html** - Gerenciamento de perfil e conta

### CSS
- **styles.css** - Consolidado com todos os estilos (global, auth, e páginas)

### JavaScript
- **commonScript.js** - Funções reutilizáveis (localStorage, validações)
- **loginScript.js** - Autenticação (login e registro)
- **homeScript.js** - Lógica do dashboard
- **productScript.js** - Gerenciamento de produtos
- **ratingScript.js** - Sistema de avaliações
- **indicatorsScript.js** - Cálculo e exibição de indicadores
- **accountScript.js** - Gerenciamento de conta do usuário

## 🔧 Funcionalidades

### Autenticação
- ✅ Login com email e senha
- ✅ Registro de novos usuários
- ✅ Logout
- ✅ Sessão persistente com localStorage

### Produtos
- ✅ Cadastrar novo produto (nome, categoria, preço, descrição)
- ✅ Listar produtos em grid
- ✅ Deletar produtos
- ✅ Categorias: Celular, PC, Impressora

### Avaliações
- ✅ Avaliar produtos (1-5 estrelas)
- ✅ Adicionar comentário
- ✅ Visualizar estatísticas por produto
- ✅ Histórico de avaliações

### Indicadores
- ✅ Total de produtos
- ✅ Total de avaliações
- ✅ Nota média geral
- ✅ Preço máximo e mínimo
- ✅ Produto mais avaliado
- ✅ Tabela de avaliações recentes

### Conta
- ✅ Visualizar informações pessoais
- ✅ Ver estatísticas (produtos e avaliações)
- ✅ Alterar senha
- ✅ Deletar conta

## 💾 LocalStorage

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

## 🚀 Como Usar

1. **Abra index.html** no navegador
2. **Faça login** ou **crie uma conta**
   - Email de teste: `meuemail@gmail.com`
   - Senha: `1234`
3. **Navegue pelas seções** usando os cartões do dashboard
4. **Todos os dados são salvos localmente** no seu navegador

## 🔐 Autenticação

- Primeira execução cria usuário de teste automaticamente
- Senha armazenada em localStorage (apenas para demo)
- Em produção, usar autenticação de servidor com token JWT

## 🎨 Design

- **Tema**: Dark mode com cores azuis e cinza
- **Componentes**: Modais, cards, grids responsivos
- **Animações**: Transições suaves
- **Logo**: UniversalScore.png

## 🔗 Navegação

| Página | Arquivo | Função |
|--------|---------|--------|
| Dashboard | index.html | Menu principal |
| Login | login.html | Autenticação |
| Cadastro | register.html | Novo usuário |
| Produtos | products.html | CRUD produtos |
| Avaliações | ratings.html | Sistema de ratings |
| Indicadores | indicators.html | Estatísticas |
| Conta | account.html | Perfil do usuário |

## 📱 Responsividade

Aplicação otimizada para:
- ✅ Desktop
- ✅ Tablets
- ✅ Mobile

## 🛠️ Tecnologias

- HTML5
- CSS3 (Flexbox, Grid)
- JavaScript vanilla (ES6+)
- localStorage (persistência)

## 📝 Notas

- Validação de entrada em cliente
- Proteção contra XSS com `escapeHtml()`
- Formatação de datas em português
- Todos os dados no localStorage (sem servidor necessário)

## 🔄 Fluxo de Autenticação

1. Usuário acessa index.html
2. JavaScript verifica localStorage.currentUser
3. Se não logado, mostra botões de login/registro
4. Se logado, mostra dashboard com navegação
5. Ao fazer logout, limpa currentUser e recarrega página

## 📊 Próximos Passos

- [ ] Integração com backend (Node.js/Express)
- [ ] Banco de dados (MongoDB/PostgreSQL)
- [ ] Autenticação JWT
- [ ] Upload de imagens para produtos
- [ ] Sistema de reviews com imagens
- [ ] Notificações em tempo real
- [ ] Dark/Light mode toggle

---

**Versão:** 1.0.0  
**Última atualização:** Abril 2026  
**Desenvolvido por:** UniversalScore Team
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
