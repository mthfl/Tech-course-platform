<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Cursos - <?php echo APP_NAME; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; }
        .navbar .logo { font-size: 24px; font-weight: bold; color: white; text-decoration: none; }
        .navbar .nav-menu { display: flex; list-style: none; gap: 20px; align-items: center; }
        .navbar .nav-menu a { color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; transition: background 0.3s; }
        .navbar .nav-menu a:hover { background: rgba(255,255,255,0.2); }
        .navbar .user-info { display: flex; gap: 15px; padding: 8px 15px; background: rgba(255,255,255,0.1); border-radius: 5px; }
        .container { max-width: 1200px; margin: 0 auto; padding: 30px 20px; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { color: #333; font-size: 32px; margin-bottom: 10px; }
        .page-header p { color: #666; font-size: 16px; }
        .course-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .course-card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; }
        .course-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.15); }
        .course-image { width: 100%; height: 180px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; }
        .course-card-body { padding: 20px; }
        .course-card-body h3 { color: #333; font-size: 18px; margin-bottom: 10px; }
        .course-card-body p { color: #666; font-size: 14px; margin-bottom: 15px; line-height: 1.5; }
        .course-progress { margin-bottom: 15px; }
        .progress-bar { width: 100%; height: 8px; background: #e0e0e0; border-radius: 4px; overflow: hidden; }
        .progress-fill { height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: width 0.3s; }
        .progress-text { font-size: 12px; color: #666; margin-top: 5px; }
        .btn { display: inline-block; padding: 10px 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 5px; font-size: 14px; font-weight: 600; transition: transform 0.2s; }
        .btn:hover { transform: translateY(-2px); }
        .empty-state { text-align: center; padding: 60px 20px; background: white; border-radius: 10px; }
        .empty-state h2 { color: #333; margin-bottom: 10px; }
        .empty-state p { color: #666; margin-bottom: 20px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo BASE_PATH; ?>/dashboard" class="logo">
                <?php echo APP_NAME; ?>
            </a>
            <ul class="nav-menu">
                <li><a href="<?php echo BASE_PATH; ?>/dashboard">Dashboard</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/cursos">Cursos</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/meus-cursos">Meus Cursos</a></li>
                <li class="user-info">
                    <span><?php echo ucfirst($_SESSION['usuario_nivel']); ?></span>
                    <span>💰 <?php echo $_SESSION['usuario_coins']; ?></span>
                    <span>⭐ <?php echo $_SESSION['usuario_xp']; ?> XP</span>
                </li>
                <li><a href="<?php echo BASE_PATH; ?>/logout">Sair</a></li>
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
