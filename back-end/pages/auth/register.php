<?php
/**
 * Página de Cadastro
 * pages/auth/register.php
 */
require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/styles.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/auth.css">
    <title>Cadastro - UniversalScore</title>
    <style>
        .auth-body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0A0C14 0%, #0E1726 100%);
            display: flex;
            flex-direction: column;
        }

        .auth-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-box {
            background: #ffffff10;
            backdrop-filter: blur(10px);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            color: white;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #aaa;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            background: #ffffff15;
            border: 1px solid #333;
            border-radius: 6px;
            color: white;
            font-size: 14px;
        }

        .form-group input::placeholder {
            color: #666;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background: #1554CC;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-button:hover {
            background: #1245a8;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #aaa;
        }

        .register-link a {
            color: #1554CC;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logged-header">
            <div style="display: flex; align-items: center; gap: 15px;">
                <a href="<?php echo getBaseUrl(); ?>/index.php" style="text-decoration: none;">
                    <img src="<?php echo getBaseUrl(); ?>/images/UniversalScore.png" alt="UniversalScore Logo" class="logo" style="height: 40px;">
                </a>
            </div>
        </div>
    </header>

    <div class="auth-content">
        <div class="login-box">
            <h2>Cadastro</h2>
            <form id="registerForm">
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" id="name" name="name" placeholder="Seu nome completo" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Digite uma senha" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirmar Senha</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirme a senha" required>
                </div>
                <button type="submit" class="login-button">Cadastrar</button>
            </form>
            <div class="register-link">
                Já tem conta? <a href="<?php echo getBaseUrl(); ?>/index.php?page=login">Faça login aqui</a>
            </div>
        </div>
    </div>

    <script src="<?php echo JS_PATH; ?>/common.js"></script>
    <script src="<?php echo JS_PATH; ?>/auth.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initRegisterForm();
        });
    </script>
</body>
</html>
