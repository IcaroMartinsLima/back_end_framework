<?php
/**
 * Página de Avaliações
 * pages/ratings/ratings.php
 */
require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/styles.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/pages.css">
    <title>Avaliações - UniversalScore</title>
    <style>
        body {
            background: linear-gradient(135deg, #0A0C14 0%, #0E1726 100%);
        }

        .page-container {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            color: white;
            margin-bottom: 30px;
            text-align: center;
        }

        .page-header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #ffffff10;
            backdrop-filter: blur(10px);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 20px;
            color: white;
        }

        .product-card h3 {
            color: #1554CC;
            margin-bottom: 10px;
        }

        .rating-stats {
            font-size: 14px;
            color: #aaa;
            margin-bottom: 15px;
        }

        .rate-button {
            background: #1554CC;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .rate-button:hover {
            background: #1245a8;
        }

        .modal-box {
            background: #ffffff10;
            backdrop-filter: blur(10px);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 30px;
        }

        .star-rating {
            font-size: 32px;
            margin-bottom: 20px;
            letter-spacing: 8px;
        }

        .star-rating span {
            cursor: pointer;
            transition: 0.2s;
        }

        .star-rating span:hover {
            transform: scale(1.2);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: white;
            margin-bottom: 5px;
        }

        .form-group textarea {
            width: 100%;
            padding: 8px;
            background: #ffffff15;
            border: 1px solid #333;
            border-radius: 6px;
            color: white;
        }
    </style>
</head>
<body>
    <?php include INCLUDES_PATH . '/header.php'; ?>

    <div class="page-container">
        <div class="page-header">
            <h1>Avaliar Produtos</h1>
        </div>

        <div class="products-grid" id="productsContainer"></div>
    </div>

    <!-- Modal para avaliar -->
    <div class="overlay" id="ratingModal" style="display: none;">
        <div class="modal-box">
            <span class="close-modal" onclick="document.getElementById('ratingModal').style.display='none'">&times;</span>
            <h2 style="color: white; margin-bottom: 20px;" id="ratingModalTitle"></h2>
            <div class="star-rating" id="starRating"></div>
            <div class="form-group">
                <label>Seu Comentário</label>
                <textarea id="ratingComment" rows="4" placeholder="Descreva sua experiência com o produto..."></textarea>
            </div>
            <button type="button" class="button" onclick="submitRating()">Enviar Avaliação</button>
        </div>
    </div>

    <?php include INCLUDES_PATH . '/footer.php'; ?>

    <script src="<?php echo JS_PATH; ?>/common.js"></script>
    <script src="<?php echo JS_PATH; ?>/rating.js"></script>
    <script>
        let currentRatingProductId = null;
        let currentRating = 0;

        document.addEventListener('DOMContentLoaded', () => {
            const user = getCurrentUser();
            if (!user) {
                window.location.href = '<?php echo getBaseUrl(); ?>/index.php?page=login';
            }
            initRatingsPage();
        });

        function generateStars() {
            let html = '';
            for (let i = 1; i <= 5; i++) {
                html += `<span onclick="setRating(${i})" data-rating="${i}">⭐</span>`;
            }
            return html;
        }

        function setRating(rating) {
            currentRating = rating;
            const stars = document.querySelectorAll('#starRating span');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.style.opacity = '1';
                } else {
                    star.style.opacity = '0.3';
                }
            });
        }

        function openRatingForm(productId, productName) {
            currentRatingProductId = productId;
            currentRating = 0;
            document.getElementById('ratingModalTitle').textContent = `Avaliar: ${productName}`;
            document.getElementById('starRating').innerHTML = generateStars();
            document.getElementById('ratingComment').value = '';
            setRating(0);
            document.getElementById('ratingModal').style.display = 'flex';
        }

        function submitRating() {
            if (currentRating === 0) {
                alert('Selecione uma classificação em estrelas');
                return;
            }

            const user = getCurrentUser();
            const products = getProducts();
            const product = products.find(p => p.id === currentRatingProductId);

            if (!product) {
                alert('Produto não encontrado');
                return;
            }

            const ratings = getRatings();
            const newRating = {
                id: Date.now().toString(),
                productId: currentRatingProductId,
                userId: user.id,
                userName: user.name,
                rating: currentRating,
                comment: document.getElementById('ratingComment').value,
                createdAt: new Date().toISOString()
            };

            ratings.push(newRating);
            saveRatings(ratings);

            alert('Avaliação enviada com sucesso!');
            document.getElementById('ratingModal').style.display = 'none';
            initRatingsPage();
        }
    </script>
</body>
</html>
