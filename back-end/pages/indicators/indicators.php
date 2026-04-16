<?php
/**
 * Página de Indicadores
 * pages/indicators/indicators.php
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
    <title>Indicadores - UniversalScore</title>
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

        .indicators-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .indicator-card {
            background: linear-gradient(135deg, #1554CC 0%, #0f3aa3 100%);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            color: white;
        }

        .indicator-card .value {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .indicator-card .label {
            font-size: 14px;
            color: #ccc;
        }

        .recent-ratings {
            background: #ffffff10;
            backdrop-filter: blur(10px);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 20px;
            overflow-x: auto;
        }

        .recent-ratings h3 {
            color: white;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            color: #aaa;
            border-collapse: collapse;
        }

        table thead th {
            color: #1554CC;
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #333;
        }

        table tbody td {
            padding: 12px 10px;
            border-bottom: 1px solid #333;
        }

        table tbody tr:hover {
            background: #ffffff05;
        }
    </style>
</head>
<body>
    <?php include INCLUDES_PATH . '/header.php'; ?>

    <div class="page-container">
        <div class="page-header">
            <h1>Indicadores & Estatísticas</h1>
        </div>

        <div class="indicators-grid" id="indicatorsContainer"></div>

        <div class="recent-ratings">
            <h3>Avaliações Recentes</h3>
            <div id="recentRatingsTable"></div>
        </div>
    </div>

    <?php include INCLUDES_PATH . '/footer.php'; ?>

    <script src="<?php echo JS_PATH; ?>/common.js"></script>
    <script src="<?php echo JS_PATH; ?>/indicators.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const user = getCurrentUser();
            if (!user) {
                window.location.href = '<?php echo getBaseUrl(); ?>/index.php?page=login';
            }
            initIndicatorsPage();
        });
    </script>
</body>
</html>
