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

function setCurrentUser(user) {
    localStorage.setItem("currentUser", JSON.stringify(user));
}

const form = document.getElementById('loginForm');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    const users = getUsers();
    
    // Adiciona usuário de teste se não existir
    if (users.length === 0) {
        users.push({
            id: 1,
            name: "Usuário Teste",
            email: "meuemail@gmail.com",
            password: "1234",
            createdAt: new Date().toISOString()
        });
        localStorage.setItem("users", JSON.stringify(users));
    }

    const user = users.find(u => u.email.toLowerCase() === email.toLowerCase() && u.password === password);

    if (user) {
        setCurrentUser({
            id: user.id,
            name: user.name,
            email: user.email
        });
        window.location.replace("index.html");
    } else {
        alert("Credenciais inválidas.");
    }
});


