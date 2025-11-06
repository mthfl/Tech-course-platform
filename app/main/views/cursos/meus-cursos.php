<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#005A24">
    <title>Meus Cursos - <?php echo APP_NAME; ?></title>
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
            border: 2px solid #E6F4EA;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px -10px rgba(0, 90, 36, 0.15), 0 2px 10px -2px rgba(0, 0, 0, 0.05);
            border-color: #FFA500;
        }
        .course-image {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #005A24 0%, #7FB069 50%, #1A3C34 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }
        .course-card-body {
            padding: 20px;
        }
        .course-card-body h3 {
            color: #1A3C34;
            font-size: 20px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .course-card-body p {
            color: #6B7280;
            font-size: 14px;
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .course-progress {
            margin-bottom: 15px;
        }
        .progress-bar {
            width: 100%;
            height: 10px;
            background: #E6F4EA;
            border-radius: 5px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #005A24 0%, #7FB069 100%);
            transition: width 0.3s;
        }
        .progress-text {
            font-size: 12px;
            color: #6B7280;
            margin-top: 8px;
            font-weight: 500;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 90, 36, 0.3);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 90, 36, 0.4);
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
        }
        .empty-state h2 {
            color: #1A3C34;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 24px;
        }
        .empty-state p {
            color: #6B7280;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .navbar .nav-menu {
                width: 100%;
                justify-content: center;
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
                <?php echo APP_NAME; ?>
            </a>
            <ul class="nav-menu">
                <li><a href="<?php echo BASE_PATH; ?>/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/cursos"><i class="fas fa-book"></i> Cursos</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/meus-cursos"><i class="fas fa-graduation-cap"></i> Meus Cursos</a></li>
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
        <div class="page-header">
            <h1>Meus Cursos</h1>
            <p>Continue de onde parou</p>
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
                        <div class="course-image">📚</div>
                        <div class="course-card-body">
                            <h3><?php echo htmlspecialchars($curso['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($curso['descricao'], 0, 100)) . '...'; ?></p>
                            
                            <div class="course-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?php echo $progresso; ?>%"></div>
                                </div>
                                <div class="progress-text"><?php echo $progresso; ?>% concluído</div>
                            </div>
                            
                            <a href="<?php echo BASE_PATH; ?>/curso/<?php echo $curso['id']; ?>" class="btn">Continuar</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h2>Você ainda não possui cursos</h2>
                <p>Explore nossa biblioteca e comece a aprender hoje mesmo!</p>
                <a href="<?php echo BASE_PATH; ?>/cursos" class="btn">Explorar Cursos</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
