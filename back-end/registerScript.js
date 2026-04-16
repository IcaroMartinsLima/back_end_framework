function getUsers() {
    const raw = localStorage.getItem("users");
    if (!raw) return [];

    try {
        const parsed = JSON.parse(raw);
        return Array.isArray(parsed) ? parsed : [];
    } catch (err) {
        console.warn("JSON inválido no localStorage, resetando.", err);
        return [];
    }
}

function saveUsers(arr) {
    localStorage.setItem("users", JSON.stringify(arr));
}

function getCurrentUser() {
    const raw = localStorage.getItem("currentUser");
    return raw ? JSON.parse(raw) : null;
}

function setCurrentUser(user) {
    localStorage.setItem("currentUser", JSON.stringify(user));
}

const form = document.getElementById('registerForm');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Validações
    if (password !== confirmPassword) {
        alert("As senhas não correspondem.");
        return;
    }

    if (password.length < 4) {
        alert("A senha deve ter pelo menos 4 caracteres.");
        return;
    }

    const users = getUsers();

    // Verifica se email já existe
    if (users.some(user => user.email.toLowerCase() === email.toLowerCase())) {
        alert("Este email já está cadastrado.");
        return;
    }

    // Cria novo usuário
    const newUser = {
        id: Date.now(),
        name: name,
        email: email,
        password: password,
        createdAt: new Date().toISOString()
    };

    users.push(newUser);
    saveUsers(users);

    // Faz login automático
    setCurrentUser({
        id: newUser.id,
        name: newUser.name,
        email: newUser.email
    });

    alert("Cadastro realizado com sucesso! Bem-vindo " + name);
    window.location.replace("index.html");
});
