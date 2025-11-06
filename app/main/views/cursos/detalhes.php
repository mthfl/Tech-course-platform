<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#005A24">
    <title><?php echo htmlspecialchars($curso['titulo']); ?> - <?php echo APP_NAME; ?></title>
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
        .course-header {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
            margin-bottom: 30px;
            border: 2px solid #E6F4EA;
        }
        .course-header h1 {
            color: #1A3C34;
            font-size: 36px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .course-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .course-level {
            display: inline-block;
            padding: 8px 16px;
            background: #E6F4EA;
            color: #005A24;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .course-price {
            color: #FFA500;
            font-size: 28px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
        }
        .course-description {
            color: #6B7280;
            line-height: 1.8;
            margin-bottom: 25px;
            font-size: 16px;
        }
        .course-actions {
            display: flex;
            gap: 15px;
        }
        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 90, 36, 0.3);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 90, 36, 0.4);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #7FB069 0%, #005A24 100%);
        }
        .progress-section {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
            margin-bottom: 30px;
            border: 2px solid #E6F4EA;
        }
        .progress-section h3 {
            color: #1A3C34;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .progress-bar {
            width: 100%;
            height: 12px;
            background: #E6F4EA;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 10px;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #005A24 0%, #7FB069 100%);
            transition: width 0.3s;
        }
        .progress-section p {
            color: #6B7280;
            font-weight: 500;
        }
        .modules-section {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
            border: 2px solid #E6F4EA;
        }
        .modules-section h2 {
            color: #1A3C34;
            font-size: 28px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 25px;
        }
        .module {
            border: 2px solid #E6F4EA;
            border-radius: 12px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: all 0.3s;
        }
        .module:hover {
            border-color: #FFA500;
        }
        .module-header {
            background: linear-gradient(135deg, #E6F4EA 0%, #F8FAF9 100%);
            padding: 18px 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }
        .module-header:hover {
            background: linear-gradient(135deg, #FFA500 0%, #F4A261 100%);
            color: white;
        }
        .module-header:hover h3 {
            color: white;
        }
        .module-header h3 {
            color: #1A3C34;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
        .module-header span {
            color: #005A24;
            font-size: 18px;
            transition: transform 0.3s;
        }
        .module-header:hover span {
            color: white;
        }
        .module-content {
            padding: 20px;
            display: none;
            background: white;
        }
        .module-content.active {
            display: block;
        }
        .content-item {
            padding: 14px 18px;
            border-left: 4px solid #005A24;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #F8FAF9 0%, #E6F4EA 100%);
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }
        .content-item:hover {
            transform: translateX(5px);
            border-left-color: #FFA500;
            box-shadow: 0 4px 12px rgba(0, 90, 36, 0.1);
        }
        .content-item span {
            color: #1A3C34;
            font-weight: 500;
        }
        .content-item a {
            color: #005A24;
            text-decoration: none;
            font-weight: 600;
            padding: 6px 14px;
            background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%);
            color: white;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .content-item a:hover {
            background: linear-gradient(135deg, #FFA500 0%, #F4A261 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 165, 0, 0.3);
        }
        .content-item span[style*="color: #999"] {
            color: #9CA3AF !important;
        }
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .alert-error {
            background: linear-gradient(135deg, #E76F51 0%, #F4A261 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 111, 81, 0.3);
        }
        .alert-success {
            background: linear-gradient(135deg, #7FB069 0%, #005A24 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 90, 36, 0.3);
        }
        @media (max-width: 768px) {
            .navbar .nav-menu {
                width: 100%;
                justify-content: center;
            }
            .course-meta {
                flex-direction: column;
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
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></span>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?></span>
            </div>
        <?php endif; ?>
        
        <div class="course-header">
            <h1><?php echo htmlspecialchars($curso['titulo']); ?></h1>
            <div class="course-meta">
                <span class="course-level"><?php echo ucfirst($curso['nivel_requerido']); ?></span>
                <span class="course-price"><i class="fas fa-coins"></i> <?php echo $curso['preco_coins']; ?> coins</span>
            </div>
            <p class="course-description"><?php echo nl2br(htmlspecialchars($curso['descricao'])); ?></p>
            
            <div class="course-actions">
                <?php if ($tem_acesso): ?>
                    <span class="btn btn-secondary"><i class="fas fa-check-circle"></i> Curso Adquirido</span>
                <?php else: ?>
                    <form method="POST" action="<?php echo BASE_PATH; ?>/comprar-curso/<?php echo $curso['id']; ?>" style="display: inline;">
                        <button type="submit" class="btn"><i class="fas fa-shopping-cart"></i> Comprar Curso</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if ($tem_acesso && $progresso > 0): ?>
            <div class="progress-section">
                <h3><i class="fas fa-chart-line"></i> Seu Progresso</h3>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $progresso; ?>%"></div>
                </div>
                <p><?php echo $progresso; ?>% concluído</p>
            </div>
        <?php endif; ?>
        
        <div class="modules-section">
            <h2><i class="fas fa-list"></i> Conteúdo do Curso</h2>
            
            <?php if (!empty($modulos)): ?>
                <?php 
                require_once __DIR__ . '/../../models/Video.php';
                require_once __DIR__ . '/../../models/Atividade.php';
                $videoModel = new Video();
                $atividadeModel = new Atividade();
                ?>
                <?php foreach ($modulos as $modulo): ?>
                    <div class="module">
                        <div class="module-header" onclick="toggleModule(this)">
                            <h3><?php echo htmlspecialchars($modulo['titulo']); ?></h3>
                            <span>▼</span>
                        </div>
                        <div class="module-content">
                            <?php 
                            $videos = $videoModel->buscarPorModulo($modulo['id']);
                            $atividades = $atividadeModel->buscarPorModulo($modulo['id']);
                            ?>
                            
                            <?php if (!empty($videos)): ?>
                                <?php foreach ($videos as $video): ?>
                                    <div class="content-item">
                                        <span><i class="fas fa-video"></i> <?php echo htmlspecialchars($video['titulo']); ?></span>
                                        <?php if ($tem_acesso): ?>
                                            <a href="<?php echo BASE_PATH; ?>/video/<?php echo $video['id']; ?>">Assistir</a>
                                        <?php else: ?>
                                            <span style="color: #9CA3AF;"><i class="fas fa-lock"></i> Bloqueado</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <?php if (!empty($atividades)): ?>
                                <?php foreach ($atividades as $atividade): ?>
                                    <div class="content-item">
                                        <span><i class="fas fa-tasks"></i> <?php echo htmlspecialchars($atividade['titulo']); ?></span>
                                        <?php if ($tem_acesso): ?>
                                            <a href="<?php echo BASE_PATH; ?>/atividade/<?php echo $atividade['id']; ?>">Fazer</a>
                                        <?php else: ?>
                                            <span style="color: #9CA3AF;"><i class="fas fa-lock"></i> Bloqueado</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: #6B7280;">Este curso ainda não possui módulos cadastrados.</p>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        function toggleModule(header) {
            const content = header.nextElementSibling;
            const arrow = header.querySelector('span');
            content.classList.toggle('active');
            arrow.textContent = content.classList.contains('active') ? '▲' : '▼';
            arrow.style.transform = content.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    </script>
</body>
</html>
