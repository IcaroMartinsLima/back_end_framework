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

function saveRatings(arr) {
    localStorage.setItem("ratings", JSON.stringify(arr));
}

function escapeHtml(str) {
    return str
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#39;");
}

function getProductRatings(productId) {
    const ratings = getRatings();
    return ratings.filter(r => r.productId === productId);
}

function calculateAverageRating(productId) {
    const ratings = getProductRatings(productId);
    if (ratings.length === 0) return 0;
    const sum = ratings.reduce((acc, r) => acc + parseInt(r.rating), 0);
    return (sum / ratings.length).toFixed(1);
}

function renderProducts() {
    const products = getProducts();
    const container = document.getElementById("ratingsContainer");

    if (products.length === 0) {
        container.innerHTML = '<div class="empty-state">Nenhum produto cadastrado ainda.</div>';
        return;
    }

    let html = "";
    for (const product of products) {
        const ratings = getProductRatings(product.id);
        const avgRating = calculateAverageRating(product.id);

        html += `
            <div class="product-rating-card">
                <h3>${escapeHtml(product.name)}</h3>
                <div class="category">${escapeHtml(product.category)}</div>
                
                <div class="rating-stats">
                    <div class="rating-stats-item">
                        <span>Avaliações:</span>
                        <span class="value">${ratings.length}</span>
                    </div>
                    <div class="rating-stats-item">
                        <span>Nota Média:</span>
                        <span class="value">${avgRating} ⭐</span>
                    </div>
                    <div class="rating-stats-item">
                        <span>Preço:</span>
                        <span class="value">R$ ${parseFloat(product.price).toFixed(2)}</span>
                    </div>
                </div>

                <button class="rate-button" onclick="openRatingForm('${product.id}', '${escapeHtml(product.name)}')">
                    Deixar Avaliação
                </button>
            </div>
        `;
    }

    container.innerHTML = html;
}

function openRatingForm(productId, productName) {
    selectedProductId = productId;
    document.getElementById("productNameDisplay").textContent = productName;
    document.getElementById("overlay").classList.add("show");
}

function addRating() {
    const rating = document.querySelector('input[name="rate"]:checked')?.value || 3;
    const comentario = document.getElementById("comentario").value.trim();

    if (!comentario) {
        alert("Escreva um comentário.");
        return;
    }

    if (!selectedProductId) {
        alert("Erro: Nenhum produto selecionado.");
        return;
    }

    const ratings = getRatings();
    const user = getCurrentUser();

    const newRating = {
        id: Date.now().toString(),
        productId: selectedProductId,
        userId: user.id,
        userName: user.name,
        rating: rating,
        comment: comentario,
        createdAt: new Date().toISOString()
    };

    ratings.push(newRating);
    saveRatings(ratings);

    document.getElementById("ratingForm").reset();
    document.getElementById("overlay").classList.remove("show");
    renderProducts();
}

let selectedProductId = null;

document.addEventListener("DOMContentLoaded", () => {
    checkLogin();
    renderProducts();

    const overlay = document.getElementById("overlay");
    const form = document.getElementById("ratingForm");
    const closeBtn = document.getElementById("closeModal");

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        addRating();
    });

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
