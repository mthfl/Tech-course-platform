<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#005A24">
    <title>Atividades - <?php echo APP_NAME; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%);
            color: white;
            padding: 15px 0;
            box-shadow: 0 4px 25px -5px rgba(0, 90, 36, 0.3);
        }
        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .navbar .logo {
            font-size: 24px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            color: white;
            text-decoration: none;
        }
        .navbar .nav-menu {
            display: flex;
            list-style: none;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        .navbar .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }
        .navbar .nav-menu a:hover {
            background: rgba(255, 165, 0, 0.2);
            transform: translateY(-2px);
        }
        .navbar .user-info {
            display: flex;
            gap: 15px;
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            font-weight: 500;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        .page-header {
            margin-bottom: 30px;
        }
        .page-header h1 {
            color: #1A3C34;
            font-size: 36px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .page-header p {
            color: #6B7280;
            font-size: 18px;
        }
        .course-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        .course-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .course-card-body {
            padding: 20px;
        }
        .course-card-body h3 {
            color: #1A3C34;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .course-card-body p {
            color: #6B7280;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 90, 36, 0.3);
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07);
        }
        .empty-state i {
            font-size: 64px;
            color: #D1D5DB;
            margin-bottom: 20px;
        }
        .empty-state h2 {
            color: #1A3C34;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .empty-state p {
            color: #6B7280;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: #E6F4EA;
            color: #005A24;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo BASE_PATH; ?>/dashboard" class="logo">
                <i class="fas fa-graduation-cap"></i> <?php echo APP_NAME; ?>
            </a>
            <ul class="nav-menu">
                <li><a href="<?php echo BASE_PATH; ?>/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/cursos"><i class="fas fa-book"></i> Cursos</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/meus-cursos"><i class="fas fa-graduation-cap"></i> Meus Cursos</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/atividades"><i class="fas fa-tasks"></i> Atividades</a></li>
                <li class="user-info">
                    <span><i class="fas fa-user-circle"></i> <?php echo ucfirst($_SESSION['usuario_nivel']); ?></span>
                    <span><i class="fas fa-coins"></i> <?php echo $_SESSION['usuario_coins']; ?></span>
                </li>
                <li><a href="<?php echo BASE_PATH; ?>/logout"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-tasks"></i> Minhas Atividades</h1>
            <p>Complete as atividades e ganhe recompensas!</p>
        </div>

        <?php if (!empty($atividades)): ?>
            <div class="course-list">
                <?php foreach ($atividades as $atividade): ?>
                    <div class="course-card">
                        <div style="width: 100%; height: 180px; background: linear-gradient(135deg, #005A24 0%, #7FB069 50%, #1A3C34 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px;">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="course-card-body">
                            <h3><?php echo htmlspecialchars($atividade['titulo']); ?></h3>
                            <p style="color: #6B7280; font-size: 12px; margin-bottom: 10px;">
                                <i class="fas fa-book"></i> <?php echo htmlspecialchars($atividade['curso_titulo']); ?>
                            </p>
                            <?php if (!empty($atividade['descricao'])): ?>
                                <p><?php echo htmlspecialchars(substr($atividade['descricao'], 0, 100)) . (strlen($atividade['descricao']) > 100 ? '...' : ''); ?></p>
                            <?php endif; ?>
                            <p style="margin-bottom: 15px;">
                                <span class="badge">
                                    <?php echo ucfirst($atividade['tipo']); ?>
                                </span>
                            </p>
                            <a href="<?php echo BASE_PATH; ?>/atividade/<?php echo $atividade['id']; ?>" class="btn">Fazer Atividade</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-tasks"></i>
                <h2>Nenhuma atividade disponível</h2>
                <p>Você ainda não tem acesso a nenhuma atividade. Adquira cursos para desbloquear atividades!</p>
                <a href="<?php echo BASE_PATH; ?>/cursos" class="btn">Explorar Cursos</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
