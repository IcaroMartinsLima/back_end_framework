<?php
/**
 * Página de Produtos
 * pages/products/products.php
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
    <title>Produtos - UniversalScore</title>
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

        .add-product-btn {
            background: #1554CC;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .add-product-btn:hover {
            background: #1245a8;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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

        .product-info {
            font-size: 14px;
            color: #aaa;
            margin-bottom: 10px;
        }

        .modal-box {
            background: #ffffff10;
            backdrop-filter: blur(10px);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: white;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
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
            <h1>Gerenciar Produtos</h1>
            <button class="add-product-btn" onclick="document.getElementById('addProductModal').style.display='flex'">
                + Adicionar Produto
            </button>
        </div>

        <div class="products-grid" id="productsContainer"></div>
    </div>

    <!-- Modal para adicionar produto -->
    <div class="overlay" id="addProductModal" style="display: none;">
        <div class="modal-box">
            <span class="close-modal" onclick="document.getElementById('addProductModal').style.display='none'">&times;</span>
            <h2 style="color: white; margin-bottom: 20px;">Adicionar Novo Produto</h2>
            <form id="addProductForm">
                <div class="form-group">
                    <label>Nome do Produto</label>
                    <input type="text" id="productName" required placeholder="Digite o nome do produto">
                </div>
                <div class="form-group">
                    <label>Categoria</label>
                    <select id="productCategory" required>
                        <option>Selecionar</option>
                        <option>Celular</option>
                        <option>PC</option>
                        <option>Impressora</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Preço</label>
                    <input type="number" id="productPrice" step="0.01" required placeholder="0.00">
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <textarea id="productDescription" rows="4" placeholder="Descrição do produto"></textarea>
                </div>
                <button type="submit" class="button">Adicionar Produto</button>
            </form>
        </div>
    </div>

    <?php include INCLUDES_PATH . '/footer.php'; ?>

    <script src="<?php echo JS_PATH; ?>/common.js"></script>
    <script src="<?php echo JS_PATH; ?>/product.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const user = getCurrentUser();
            if (!user) {
                window.location.href = '<?php echo getBaseUrl(); ?>/index.php?page=login';
            }
            initProductsPage();
        });

        document.getElementById('addProductForm').addEventListener('submit', (e) => {
            e.preventDefault();
            addProduct();
        });

        function addProduct() {
            const name = document.getElementById('productName').value;
            const category = document.getElementById('productCategory').value;
            const price = document.getElementById('productPrice').value;
            const description = document.getElementById('productDescription').value;

            if (!name || category === 'Selecionar' || !price) {
                alert('Preencha todos os campos obrigatórios');
                return;
            }

            const user = getCurrentUser();
            const products = getProducts();
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

            document.getElementById('addProductForm').reset();
            document.getElementById('addProductModal').style.display = 'none';
            renderProducts();
        }
    </script>
</body>
</html>
