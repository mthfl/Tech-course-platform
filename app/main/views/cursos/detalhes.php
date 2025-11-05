<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($curso['titulo']); ?> - <?php echo APP_NAME; ?></title>
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
        .course-header { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .course-header h1 { color: #333; font-size: 32px; margin-bottom: 15px; }
        .course-meta { display: flex; gap: 20px; margin-bottom: 20px; }
        .course-level { display: inline-block; padding: 6px 15px; background: #e3f2fd; color: #1976d2; border-radius: 15px; font-size: 14px; font-weight: 500; }
        .course-price { color: #667eea; font-size: 24px; font-weight: bold; }
        .course-description { color: #666; line-height: 1.8; margin-bottom: 20px; }
        .course-actions { display: flex; gap: 15px; }
        .btn { display: inline-block; padding: 12px 25px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border: none; border-radius: 5px; font-size: 16px; font-weight: 600; cursor: pointer; transition: transform 0.2s; }
        .btn:hover { transform: translateY(-2px); }
        .btn-secondary { background: #6c757d; }
        .progress-section { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .progress-bar { width: 100%; height: 10px; background: #e0e0e0; border-radius: 5px; overflow: hidden; margin-bottom: 10px; }
        .progress-fill { height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: width 0.3s; }
        .modules-section { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .modules-section h2 { color: #333; font-size: 24px; margin-bottom: 20px; }
        .module { border: 1px solid #e0e0e0; border-radius: 8px; margin-bottom: 15px; overflow: hidden; }
        .module-header { background: #f8f9fa; padding: 15px 20px; cursor: pointer; display: flex; justify-content: space-between; align-items: center; }
        .module-header h3 { color: #333; font-size: 18px; }
        .module-content { padding: 15px 20px; display: none; }
        .module-content.active { display: block; }
        .content-item { padding: 12px 15px; border-left: 3px solid #667eea; margin-bottom: 10px; background: #f8f9fa; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; }
        .content-item a { color: #667eea; text-decoration: none; font-weight: 500; }
        .content-item a:hover { text-decoration: underline; }
        .alert { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert-error { background: #fee; color: #c33; border: 1px solid #fcc; }
        .alert-success { background: #efe; color: #3c3; border: 1px solid #cfc; }
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
        
        <div class="course-header">
            <h1><?php echo htmlspecialchars($curso['titulo']); ?></h1>
            <div class="course-meta">
                <span class="course-level"><?php echo ucfirst($curso['nivel_requerido']); ?></span>
                <span class="course-price">💰 <?php echo $curso['preco_coins']; ?> coins</span>
            </div>
            <p class="course-description"><?php echo nl2br(htmlspecialchars($curso['descricao'])); ?></p>
            
            <div class="course-actions">
                <?php if ($tem_acesso): ?>
                    <span class="btn btn-secondary">✓ Curso Adquirido</span>
                <?php else: ?>
                    <form method="POST" action="<?php echo BASE_PATH; ?>/comprar-curso/<?php echo $curso['id']; ?>">
                        <button type="submit" class="btn">Comprar Curso</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if ($tem_acesso && $progresso > 0): ?>
            <div class="progress-section">
                <h3>Seu Progresso</h3>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $progresso; ?>%"></div>
                </div>
                <p><?php echo $progresso; ?>% concluído</p>
            </div>
        <?php endif; ?>
        
        <div class="modules-section">
            <h2>Conteúdo do Curso</h2>
            
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
                                        <span>🎥 <?php echo htmlspecialchars($video['titulo']); ?></span>
                                        <?php if ($tem_acesso): ?>
                                            <a href="<?php echo BASE_PATH; ?>/video/<?php echo $video['id']; ?>">Assistir</a>
                                        <?php else: ?>
                                            <span style="color: #999;">🔒 Bloqueado</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <?php if (!empty($atividades)): ?>
                                <?php foreach ($atividades as $atividade): ?>
                                    <div class="content-item">
                                        <span>📝 <?php echo htmlspecialchars($atividade['titulo']); ?></span>
                                        <?php if ($tem_acesso): ?>
                                            <a href="<?php echo BASE_PATH; ?>/atividade/<?php echo $atividade['id']; ?>">Fazer</a>
                                        <?php else: ?>
                                            <span style="color: #999;">🔒 Bloqueado</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: #666;">Este curso ainda não possui módulos cadastrados.</p>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        function toggleModule(header) {
            const content = header.nextElementSibling;
            const arrow = header.querySelector('span');
            content.classList.toggle('active');
            arrow.textContent = content.classList.contains('active') ? '▲' : '▼';
        }
    </script>
</body>
</html>
