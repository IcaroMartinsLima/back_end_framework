<?php
/**
 * Página de Conta
 * pages/account/account.php
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
    <title>Minha Conta - UniversalScore</title>
    <style>
        body {
            background: linear-gradient(135deg, #0A0C14 0%, #0E1726 100%);
        }

        .page-container {
            padding: 40px 20px;
            max-width: 800px;
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

        .account-section {
            background: #ffffff10;
            backdrop-filter: blur(10px);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            color: white;
        }

        .account-section h2 {
            color: #1554CC;
            margin-bottom: 15px;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }

        .account-info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #333;
        }

        .account-info-row label {
            color: #aaa;
        }

        .account-info-row span {
            color: white;
            font-weight: bold;
        }

        .button {
            background: #1554CC;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }

        .button:hover {
            background: #1245a8;
        }

        .button.danger {
            background: #cc1515;
        }

        .button.danger:hover {
            background: #a80f0f;
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

        .form-group input {
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
            <h1>Minha Conta</h1>
        </div>

        <!-- Informações Pessoais -->
        <div class="account-section">
            <h2>Informações Pessoais</h2>
            <div class="account-info-row">
                <label>Nome:</label>
                <span id="accountName"></span>
            </div>
            <div class="account-info-row">
                <label>Email:</label>
                <span id="accountEmail"></span>
            </div>
            <div class="account-info-row">
                <label>Data de Cadastro:</label>
                <span id="accountCreatedAt"></span>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="account-section">
            <h2>Minhas Estatísticas</h2>
            <div class="account-info-row">
                <label>Total de Produtos:</label>
                <span id="totalProducts">0</span>
            </div>
            <div class="account-info-row">
                <label>Total de Avaliações:</label>
                <span id="totalRatings">0</span>
            </div>
            <div class="account-info-row">
                <label>Avaliação Média Dada:</label>
                <span id="averageRating">0</span>
            </div>
        </div>

        <!-- Segurança -->
        <div class="account-section">
            <h2>Segurança</h2>
            <button class="button" onclick="document.getElementById('changePasswordModal').style.display='flex'">
                Alterar Senha
            </button>
        </div>

        <!-- Zona de Perigo -->
        <div class="account-section" style="border-color: #cc1515;">
            <h2 style="color: #cc1515;">Zona de Perigo</h2>
            <p style="color: #aaa; margin-bottom: 15px;">Esta ação não pode ser desfeita.</p>
            <button class="button danger" onclick="if(confirm('Tem certeza que deseja deletar sua conta? Esta ação não pode ser desfeita.')) deleteAccount()">
                Deletar Minha Conta
            </button>
        </div>
    </div>

    <!-- Modal de Alteração de Senha -->
    <div class="overlay" id="changePasswordModal" style="display: none;">
        <div class="modal-box">
            <span class="close-modal" onclick="document.getElementById('changePasswordModal').style.display='none'">&times;</span>
            <h2 style="color: white; margin-bottom: 20px;">Alterar Senha</h2>
            <form id="changePasswordForm">
                <div class="form-group">
                    <label>Senha Atual</label>
                    <input type="password" id="currentPassword" required placeholder="Digite sua senha atual">
                </div>
                <div class="form-group">
                    <label>Nova Senha</label>
                    <input type="password" id="newPassword" required placeholder="Digite a nova senha">
                </div>
                <div class="form-group">
                    <label>Confirmar Nova Senha</label>
                    <input type="password" id="confirmNewPassword" required placeholder="Confirme a nova senha">
                </div>
                <button type="submit" class="button">Alterar Senha</button>
            </form>
        </div>
    </div>

    <?php include INCLUDES_PATH . '/footer.php'; ?>

    <script src="<?php echo JS_PATH; ?>/common.js"></script>
    <script src="<?php echo JS_PATH; ?>/account.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const user = getCurrentUser();
            if (!user) {
                window.location.href = '<?php echo getBaseUrl(); ?>/index.php?page=login';
            }
            initAccountPage();
        });

        document.getElementById('changePasswordForm').addEventListener('submit', (e) => {
            e.preventDefault();
            changePassword();
        });

        function changePassword() {
            const user = getCurrentUser();
            const users = getUsers();
            const currentUser = users.find(u => u.id === user.id);

            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmNewPassword = document.getElementById('confirmNewPassword').value;

            if (!currentUser) {
                alert('Usuário não encontrado');
                return;
            }

            if (currentUser.password !== currentPassword) {
                alert('Senha atual incorreta');
                return;
            }

            if (newPassword !== confirmNewPassword) {
                alert('As novas senhas não coincidem');
                return;
            }

            if (newPassword.length < 4) {
                alert('A nova senha deve ter pelo menos 4 caracteres');
                return;
            }

            currentUser.password = newPassword;
            saveUsers(users);

            alert('Senha alterada com sucesso!');
            document.getElementById('changePasswordForm').reset();
            document.getElementById('changePasswordModal').style.display = 'none';
        }

        function deleteAccount() {
            const user = getCurrentUser();
            const users = getUsers();
            
            // Remove o usuário
            const updatedUsers = users.filter(u => u.id !== user.id);
            saveUsers(updatedUsers);

            // Remove todos os produtos do usuário
            const products = getProducts();
            const updatedProducts = products.filter(p => p.userId !== user.id);
            saveProducts(updatedProducts);

            // Remove todas as avaliações do usuário
            const ratings = getRatings();
            const updatedRatings = ratings.filter(r => r.userId !== user.id);
            saveRatings(updatedRatings);

            // Remove a sessão
            localStorage.removeItem('currentUser');

            alert('Sua conta foi deletada com sucesso');
            window.location.href = '<?php echo getBaseUrl(); ?>/index.php?page=login';
        }
    </script>
</body>
</html>
