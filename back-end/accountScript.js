function getCurrentUser() {
    const raw = localStorage.getItem("currentUser");
    return raw ? JSON.parse(raw) : null;
}

function getUsers() {
    const raw = localStorage.getItem("users");
    if (!raw) return [];
    try {
        const parsed = JSON.parse(raw);
        return Array.isArray(parsed) ? parsed : [];
    } catch (err) {
        return [];
    }
}

function saveUsers(arr) {
    localStorage.setItem("users", JSON.stringify(arr));
}

function logout() {
    localStorage.removeItem("currentUser");
    window.location.replace("index.html");
}

function checkLogin() {
    const user = getCurrentUser();
    if (!user) {
        alert("Você precisa estar logado.");
        window.location.replace("index.html");
    }
    return user;
}

function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleDateString('pt-BR');
}

function getRatings() {
    const raw = localStorage.getItem("ratings");
    if (!raw) return [];
    try {
        const parsed = JSON.parse(raw);
        return Array.isArray(parsed) ? parsed : [];
    } catch (err) {
        return [];
    }
}

function getProducts() {
    const raw = localStorage.getItem("products");
    if (!raw) return [];
    try {
        const parsed = JSON.parse(raw);
        return Array.isArray(parsed) ? parsed : [];
    } catch (err) {
        return [];
    }
}

function loadUserInfo() {
    const user = checkLogin();
    const users = getUsers();
    const fullUser = users.find(u => u.id === user.id);

    if (!fullUser) {
        alert("Erro ao carregar informações do usuário.");
        return;
    }

    document.getElementById("userName").textContent = fullUser.name;
    document.getElementById("userEmail").textContent = fullUser.email;
    document.getElementById("createdAt").textContent = formatDate(fullUser.createdAt);

    // Contar avaliações e produtos do usuário
    const ratings = getRatings();
    const products = getProducts();

    const userRatings = ratings.filter(r => r.userId === user.id);
    const userProducts = products.filter(p => p.userId === user.id);

    document.getElementById("userRatings").textContent = userRatings.length;
    document.getElementById("userProducts").textContent = userProducts.length;
}

function openChangePasswordModal() {
    document.getElementById("changePasswordModal").classList.add("active");
}

function closeChangePasswordModal() {
    document.getElementById("changePasswordModal").classList.remove("active");
    document.getElementById("currentPassword").value = "";
    document.getElementById("newPassword").value = "";
    document.getElementById("confirmPassword").value = "";
}

function changePassword() {
    const user = getCurrentUser();
    const users = getUsers();
    const userIndex = users.findIndex(u => u.id === user.id);

    if (userIndex === -1) {
        alert("Erro ao encontrar usuário.");
        return;
    }

    const currentPassword = document.getElementById("currentPassword").value;
    const newPassword = document.getElementById("newPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (!currentPassword || !newPassword || !confirmPassword) {
        alert("Preencha todos os campos.");
        return;
    }

    if (users[userIndex].password !== currentPassword) {
        alert("Senha atual incorreta.");
        return;
    }

    if (newPassword !== confirmPassword) {
        alert("As novas senhas não correspondem.");
        return;
    }

    if (newPassword.length < 4) {
        alert("A nova senha deve ter pelo menos 4 caracteres.");
        return;
    }

    users[userIndex].password = newPassword;
    saveUsers(users);

    alert("Senha alterada com sucesso!");
    closeChangePasswordModal();
}

function deleteAccount() {
    const confirmDelete = confirm("Tem certeza que deseja deletar sua conta? Esta ação é irreversível.");
    if (!confirmDelete) return;

    const user = getCurrentUser();
    const users = getUsers();
    const filteredUsers = users.filter(u => u.id !== user.id);

    saveUsers(filteredUsers);
    localStorage.removeItem("currentUser");

    alert("Conta deletada com sucesso.");
    window.location.replace("index.html");
}

document.addEventListener("DOMContentLoaded", loadUserInfo);
