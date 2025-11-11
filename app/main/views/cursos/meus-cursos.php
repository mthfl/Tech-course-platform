<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#007A33">
    <title>Meus Cursos - <?php echo APP_NAME; ?></title>
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
            --text-secondary: #94a3b8;
            --border-color: rgba(0, 179, 72, 0.2);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.5);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.5);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.6);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            color: var(--text-color);
            position: relative;
            overflow-x: hidden;
            background-image: radial-gradient(circle at 10% 20%, rgba(0, 179, 72, 0.05) 0%, rgba(0, 179, 72, 0) 20%),
                              radial-gradient(circle at 90% 80%, rgba(255, 183, 51, 0.05) 0%, rgba(255, 183, 51, 0) 20%);
        }

        .navbar {
            background: linear-gradient(135deg, #007A33 0%, #1A3C34 100%);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 179, 72, 0.2);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 25px -5px rgba(0, 122, 51, 0.3);
        }

        .navbar .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 72px;
        }

        .navbar .logo {
            font-size: 22px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .navbar .logo::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--accent-color);
            border-radius: 50%;
            box-shadow: 0 0 20px var(--accent-color);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.2); }
        }

        .navbar .nav-menu {
            display: flex;
            list-style: none;
            gap: 8px;
            align-items: center;
        }

        .navbar .nav-menu a {
            color: var(--text-secondary);
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 10px;
            transition: var(--transition);
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar .nav-menu a:hover {
            background: rgba(255, 183, 51, 0.2);
            color: var(--accent-color);
        }

        .navbar .user-info {
            display: flex;
            gap: 16px;
            padding: 10px 20px;
            background: rgba(0, 179, 72, 0.08);
            border: 1px solid rgba(0, 179, 72, 0.2);
            border-radius: 12px;
            font-weight: 500;
            font-size: 13px;
        }

        .navbar .user-info span {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-secondary);
        }

        .navbar .user-info span i {
            color: var(--header-color);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 32px;
            position: relative;
            z-index: 1;
        }

        .page-header {
            margin-bottom: 40px;
            padding: 32px;
            background: linear-gradient(135deg, rgba(0, 179, 72, 0.1) 0%, rgba(0, 179, 72, 0.02) 100%);
            border-radius: 20px;
            border: 1px solid rgba(0, 179, 72, 0.15);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(0, 179, 72, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .page-header h1 {
            color: #ffffff;
            font-size: 36px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 16px;
            position: relative;
        }

        .course-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .course-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            position: relative;
        }

        .course-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--header-color), var(--accent-color));
            transform: scaleX(0);
            transition: var(--transition);
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(0, 179, 72, 0.4);
        }

        .course-card:hover::before {
            transform: scaleX(1);
        }

        .course-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #007A33 0%, #00b348 50%, #1A3C34 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 56px;
            position: relative;
            overflow: hidden;
        }

        .course-image::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0%, 100% { transform: translate(-50%, -50%) rotate(0deg); }
            50% { transform: translate(-30%, -30%) rotate(180deg); }
        }

        .course-card-body {
            padding: 24px;
        }

        .course-card-body h3 {
            color: #ffffff;
            font-size: 19px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .course-card-body p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.6;
            min-height: 60px;
        }

        .course-progress {
            margin-bottom: 20px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .progress-label span {
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 600;
        }

        .progress-label .progress-percentage {
            color: var(--header-color);
            font-weight: 700;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: rgba(30, 30, 30, 0.8);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, var(--header-color) 0%, #7FB069 100%);
            transition: width 0.6s ease;
            box-shadow: 0 0 10px rgba(0, 179, 72, 0.5);
            position: relative;
            overflow: hidden;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: progressShine 2s infinite;
        }

        @keyframes progressShine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--header-color) 0%, #007A33 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(0, 179, 72, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 100%);
            opacity: 0;
            transition: var(--transition);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 179, 72, 0.4);
        }

        .btn:hover::before {
            opacity: 1;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .empty-state i {
            font-size: 72px;
            margin-bottom: 24px;
            opacity: 0.3;
            background: linear-gradient(135deg, var(--header-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .empty-state h2 {
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 12px;
            font-size: 28px;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 32px;
            font-size: 16px;
            line-height: 1.6;
        }

        .empty-state .btn {
            max-width: 300px;
            margin: 0 auto;
        }

        @media (max-width: 1024px) {
            .navbar .container {
                padding: 0 24px;
            }
            
            .container {
                padding: 32px 24px;
            }
        }

        @media (max-width: 768px) {
            .navbar .container {
                height: auto;
                flex-direction: column;
                padding: 16px;
                gap: 16px;
            }

            .navbar .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
            }

            .navbar .user-info {
                order: -1;
                width: 100%;
                justify-content: center;
            }

            .page-header h1 {
                font-size: 28px;
            }

            .course-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo BASE_PATH; ?>/dashboard" class="logo">
                Área Dev
            </a>
            <ul class="nav-menu">
                <li><a href="<?php echo BASE_PATH; ?>/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/cursos"><i class="fas fa-book"></i> Cursos</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/meus-cursos"><i class="fas fa-graduation-cap"></i> Meus Cursos</a></li>
                <li class="user-info">
                    <span><i class="fas fa-user-circle"></i> <?php echo ucfirst($_SESSION['usuario_nivel']); ?></span>
                </li>
                <li><a href="<?php echo BASE_PATH; ?>/logout"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-graduation-cap"></i> Meus Cursos</h1>
            <p>Continue de onde parou e alcance seus objetivos</p>
        </div>
        
        <?php if (!empty($cursos)): ?>
            <div class="course-list">
                <?php 
                require_once __DIR__ . '/../../models/Curso.php';
                $cursoModel = new Curso();
                foreach ($cursos as $curso): 
                    $progresso = $cursoModel->calcularProgresso($_SESSION['usuario_id'], $curso['id']);
                ?>
                    <div class="course-card">
                        <div class="course-image">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="course-card-body">
                            <h3><?php echo htmlspecialchars($curso['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($curso['descricao'], 0, 100)) . '...'; ?></p>
                            
                            <div class="course-progress">
                                <div class="progress-label">
                                    <span><i class="fas fa-chart-line"></i> Progresso</span>
                                    <span class="progress-percentage"><?php echo $progresso; ?>%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?php echo $progresso; ?>%"></div>
                                </div>
                            </div>
                            
                            <a href="<?php echo BASE_PATH; ?>/curso/<?php echo $curso['id']; ?>" class="btn">
                                <i class="fas fa-play"></i> Continuar Aprendendo
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h2>Você ainda não possui cursos</h2>
                <p>Explore nossa biblioteca e comece sua jornada de aprendizado hoje mesmo!</p>
                <a href="<?php echo BASE_PATH; ?>/cursos" class="btn">
                    <i class="fas fa-search"></i> Explorar Cursos
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>