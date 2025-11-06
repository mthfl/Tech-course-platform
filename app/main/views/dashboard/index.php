<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#007A33">
    <title>Dashboard - <?php echo APP_NAME; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        :root {
            --background-color: #1a1a1a;
            --text-color: #ffffff;
            --header-color: #00b348;
            --accent-color: #ffb733;
            --card-bg: rgba(45, 45, 45, 0.9);
            --sidebar-bg: #2d2d2d;
            --sidebar-active: rgba(0, 179, 72, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background-color);
            min-height: 100vh;
            background-image: radial-gradient(circle at 10% 20%, rgba(52, 152, 219, 0.05) 0%, rgba(52, 152, 219, 0) 20%),
                              radial-gradient(circle at 90% 80%, rgba(46, 204, 113, 0.05) 0%, rgba(46, 204, 113, 0) 20%);
            color: var(--text-color);
            transition: background-color 0.3s ease;
        }

        .navbar {
            background: linear-gradient(135deg, #007A33 0%, #1A3C34 100%);
            color: white;
            padding: 15px 0;
            box-shadow: 0 4px 25px -5px rgba(0, 122, 51, 0.3);
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
            background: rgba(255, 183, 51, 0.2);
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

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            color: #ffffff;
            font-size: 32px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .dashboard-header p {
            color: #94a3b8;
            font-size: 16px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 179, 72, 0.2);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 179, 72, 0.2);
            border-color: rgba(0, 179, 72, 0.4);
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .stat-card-title {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-card-icon.primary {
            background: rgba(0, 179, 72, 0.2);
            color: #00b348;
        }

        .stat-card-icon.warning {
            background: rgba(255, 183, 51, 0.2);
            color: #ffb733;
        }

        .stat-card-icon.danger {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .stat-card-icon.info {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }

        .stat-card-value {
            font-size: 36px;
            font-weight: 700;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        .courses-section {
            background-color: var(--card-bg);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 179, 72, 0.2);
        }

        .courses-section h2 {
            color: #ffffff;
            font-size: 24px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .course-card {
            background: rgba(30, 30, 30, 0.8);
            border: 2px solid rgba(0, 179, 72, 0.2);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
        }

        .course-card:hover {
            border-color: #00b348;
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 179, 72, 0.2);
        }

        .course-card-header {
            padding: 20px;
            background: linear-gradient(135deg, rgba(0, 179, 72, 0.1) 0%, rgba(0, 179, 72, 0.05) 100%);
        }

        .course-card-title {
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .course-card-level {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(0, 179, 72, 0.2);
            color: #00b348;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .course-card-body {
            padding: 20px;
        }

        .course-card-description {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .course-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .course-card-price {
            color: #ffb733;
            font-size: 20px;
            font-weight: 700;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #00b348 0%, #007A33 100%);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 179, 72, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #ffb733 0%, #f59e0b 100%);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .navbar .container {
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .course-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
        
        
    
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo BASE_PATH; ?>/dashboard" class="logo">
                <?php echo APP_NAME; ?>
            </a>
            <ul class="nav-menu">
                <li><a href="<?php echo BASE_PATH; ?>/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/cursos"><i class="fas fa-book"></i> Cursos</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/meus-cursos"><i class="fas fa-graduation-cap"></i> Meus Cursos</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/atividades"><i class="fas fa-tasks"></i> Atividades</a></li>
                <li class="user-info">
                    <span><i class="fas fa-user-circle"></i> <?php echo ucfirst($_SESSION['usuario_nivel']); ?></span>
                    <span><i class="fas fa-coins"></i> <?php echo $_SESSION['usuario_coins']; ?></span>
                    <span><i class="fas fa-star"></i> <?php echo $_SESSION['usuario_xp']; ?> XP</span>
                </li>
                <li><a href="<?php echo BASE_PATH; ?>/logout"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($_SESSION['erro'])): ?>
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #ef4444; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></span>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['sucesso'])): ?>
            <div style="background: rgba(0, 179, 72, 0.2); border: 1px solid #00b348; color: #00b348; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <i class="fas fa-check-circle"></i>
                <span><?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?></span>
            </div>
        <?php endif; ?>

        <div class="dashboard-header">
            <h1>Olá, <?php echo $_SESSION['usuario_nome']; ?>! </h1>
            <p>Bem-vindo ao seu painel de aprendizado</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Nível Atual</div>
                        <div class="stat-card-value"><?php echo ucfirst($_SESSION['usuario_nivel']); ?></div>
                    </div>
                    <div class="stat-card-icon primary">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Coins</div>
                        <div class="stat-card-value"><?php echo $_SESSION['usuario_coins']; ?></div>
                    </div>
                    <div class="stat-card-icon warning">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Experiência</div>
                        <div class="stat-card-value"><?php echo $_SESSION['usuario_xp']; ?> XP</div>
                    </div>
                    <div class="stat-card-icon info">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Cursos Ativos</div>
                        <div class="stat-card-value"><?php echo count($cursos_comprados); ?></div>
                    </div>
                    <div class="stat-card-icon primary">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="courses-section">
            <h2><i class="fas fa-book-open"></i> Meus Cursos</h2>

            <?php if (!empty($cursos_comprados)): ?>
                <div class="course-grid">
                    <?php foreach ($cursos_comprados as $curso): ?>
                        <div class="course-card" onclick="window.location.href='<?php echo BASE_PATH; ?>/curso/<?php echo $curso['id']; ?>'">
                            <div class="course-card-header">
                                <h3 class="course-card-title"><?php echo htmlspecialchars($curso['titulo']); ?></h3>
                                <span class="course-card-level"><?php echo ucfirst($curso['nivel_requerido']); ?></span>
                            </div>
                            <div class="course-card-body">
                                <p class="course-card-description"><?php echo htmlspecialchars(substr($curso['descricao'], 0, 100)); ?>...</p>
                                <div class="course-card-footer">
                                    <span style="color: #00b348; font-weight: 600;">
                                        <i class="fas fa-check-circle"></i> Adquirido
                                    </span>
                                    <a href="<?php echo BASE_PATH; ?>/curso/<?php echo $curso['id']; ?>" class="btn" onclick="event.stopPropagation();">
                                        Continuar <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <p>Você ainda não possui cursos. Explore nossa biblioteca e comece a aprender!</p>
                    <a href="<?php echo BASE_PATH; ?>/cursos" class="btn">
                        <i class="fas fa-search"></i> Explorar Cursos
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>