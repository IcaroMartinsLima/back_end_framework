function getCurrentUser() {
    const raw = localStorage.getItem("currentUser");
    return raw ? JSON.parse(raw) : null;
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
    } else {
        document.getElementById("userGreeting").textContent = "Olá, " + user.name + "!";
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

function saveProducts(arr) {
    localStorage.setItem("products", JSON.stringify(arr));
}

function escapeHtml(str) {
    return str
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#39;");
}

function renderProducts() {
    const products = getProducts();
    const container = document.getElementById("productsContainer");

    if (products.length === 0) {
        container.innerHTML = '<div class="empty-state" style="grid-column: 1/-1;">Nenhum produto cadastrado ainda. <br> Crie um novo produto para começar!</div>';
        return;
    }

    let html = "";
    for (const product of products) {
        html += `
            <div class="product-card">
                <h3>${escapeHtml(product.name)}</h3>
                <div class="category">${escapeHtml(product.category)}</div>
                <div class="description">${escapeHtml(product.description)}</div>
                <div class="price">R$ ${parseFloat(product.price).toFixed(2)}</div>
                <div class="actions">
                    <button class="btn-rate" onclick="goToRate('${product.id}')">Avaliar</button>
                    <button class="btn-delete" onclick="deleteProduct('${product.id}')">Deletar</button>
                </div>
            </div>
        `;
    }

    container.innerHTML = html;
}

function deleteProduct(id) {
    if (confirm("Tem certeza que deseja deletar este produto?")) {
        const products = getProducts();
        const filtered = products.filter(p => p.id !== id);
        saveProducts(filtered);
        renderProducts();
    }
}

function goToRate(productId) {
    localStorage.setItem("selectedProductId", productId);
    window.location.href = "ratings.html";
}

function addProduct() {
    const name = document.getElementById("productName").value.trim();
    const category = document.getElementById("productCategory").value;
    const price = document.getElementById("productPrice").value;
    const description = document.getElementById("productDescription").value.trim();

    if (!name || !category || !price || !description) {
        alert("Preencha todos os campos.");
        return;
    }

    const products = getProducts();
    const user = getCurrentUser();

    const newProduct = {
        id: Date.now().toString(),
        userId: user.id,
        name: name,
        category: category,
        price: parseFloat(price),
        description: description,
        createdAt: new Date().toISOString()
    };

    products.push(newProduct);
    saveProducts(products);

    document.getElementById("productForm").reset();
    document.getElementById("overlay").classList.remove("show");
    renderProducts();
}

document.addEventListener("DOMContentLoaded", () => {
    checkLogin();
    renderProducts();

    const overlay = document.getElementById("overlay");
    const form = document.getElementById("productForm");
    const openBtn = document.getElementById("addProductBtn");
    const closeBtn = document.getElementById("closeModal");

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        addProduct();
    });

    openBtn.addEventListener("click", () => overlay.classList.add("show"));
    closeBtn.addEventListener("click", () => {
        form.reset();
        overlay.classList.remove("show");
    });

    overlay.addEventListener("click", (e) => {
        if (e.target === overlay) {
            overlay.classList.remove("show");
        }
    });
});
