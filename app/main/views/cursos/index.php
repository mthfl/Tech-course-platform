<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos - <?php echo APP_NAME; ?></title>
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
        .course-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px; }
        .course-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; }
        .course-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.15); }
        .course-image { width: 100%; height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; }
        .course-body { padding: 20px; }
        .course-header { margin-bottom: 15px; }
        .course-title { color: #333; font-size: 20px; font-weight: 600; margin-bottom: 8px; }
        .course-level { display: inline-block; padding: 4px 12px; background: #f0f0f0; color: #666; border-radius: 15px; font-size: 12px; font-weight: 500; }
        .course-level.iniciante { background: #e3f2fd; color: #1976d2; }
        .course-level.intermediario { background: #fff3e0; color: #f57c00; }
        .course-level.avancado { background: #fce4ec; color: #c2185b; }
        .course-description { color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 15px; }
        .course-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #e0e0e0; }
        .course-price { color: #667eea; font-size: 20px; font-weight: bold; }
        .btn { display: inline-block; padding: 10px 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 5px; font-size: 14px; font-weight: 600; transition: transform 0.2s; }
        .btn:hover { transform: translateY(-2px); }
        .alert { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert-error { background: #fee; color: #c33; border: 1px solid #fcc; }
        .alert-success { background: #efe; color: #3c3; border: 1px solid #cfc; }
        .empty-state { text-align: center; padding: 60px 20px; background: white; border-radius: 10px; }
        .empty-state h2 { color: #333; margin-bottom: 10px; }
        .empty-state p { color: #666; }
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
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-error">
                <?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
            </div>
        <?php endif; ?>
        
        <div class="page-header">
            <h1>Cursos Disponíveis</h1>
            <p>Explore nossos cursos e comece a aprender hoje mesmo</p>
        </div>
        
        <?php if (!empty($cursos)): ?>
            <div class="course-grid">
                <?php foreach ($cursos as $curso): ?>
                    <div class="course-card">
                        <div class="course-image">📚</div>
                        <div class="course-body">
                            <div class="course-header">
                                <h3 class="course-title"><?php echo htmlspecialchars($curso['titulo']); ?></h3>
                                <span class="course-level <?php echo $curso['nivel_requerido']; ?>">
                                    <?php echo ucfirst($curso['nivel_requerido']); ?>
                                </span>
                            </div>
                            
                            <p class="course-description">
                                <?php echo htmlspecialchars(substr($curso['descricao'], 0, 120)) . '...'; ?>
                            </p>
                            
                            <div class="course-footer">
                                <div class="course-price">💰 <?php echo $curso['preco_coins']; ?> coins</div>
                                <a href="<?php echo BASE_PATH; ?>/curso/<?php echo $curso['id']; ?>" class="btn">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h2>Nenhum curso disponível</h2>
                <p>Não há cursos disponíveis para o seu nível no momento.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
