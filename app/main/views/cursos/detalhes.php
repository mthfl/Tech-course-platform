<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#007A33">
    <title><?php echo htmlspecialchars($curso['titulo']); ?> - <?php echo APP_NAME; ?></title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background-color: var(--background-color);
            min-height: 100vh;
            background-image: radial-gradient(circle at 10% 20%, rgba(52, 152, 219, 0.05) 0%, rgba(52, 152, 219, 0) 20%),
                              radial-gradient(circle at 90% 80%, rgba(46, 204, 113, 0.05) 0%, rgba(46, 204, 113, 0) 20%);
            color: var(--text-color);
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

        .course-header {
            background-color: var(--card-bg);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
            border: 1px solid rgba(0, 179, 72, 0.2);
        }

        .course-header h1 {
            color: #ffffff;
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
            background: rgba(0, 179, 72, 0.2);
            color: #00b348;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .course-price {
            color: #ffb733;
            font-size: 28px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
        }

        .course-description {
            color: #94a3b8;
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
            background: linear-gradient(135deg, #00b348 0%, #007A33 100%);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 179, 72, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 179, 72, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #ffb733 0%, #f59e0b 100%);
        }

        .progress-section {
            background-color: var(--card-bg);
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
            border: 1px solid rgba(0, 179, 72, 0.2);
        }
        }
        .progress-section h3 {
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: rgba(30, 30, 30, 0.8);
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #00b348 0%, #7FB069 100%);
            transition: width 0.3s;
        }

        .progress-section p {
            color: #94a3b8;
            font-weight: 500;
        }

        .modules-section {
            background-color: var(--card-bg);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 179, 72, 0.2);
        }

        .modules-section h2 {
            color: #ffffff;
            font-size: 28px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .module {
            border: 2px solid rgba(0, 179, 72, 0.2);
            border-radius: 12px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: all 0.3s;
            background: rgba(30, 30, 30, 0.6);
        }

        .module:hover {
            border-color: #00b348;
            box-shadow: 0 4px 15px rgba(0, 179, 72, 0.2);
        }

        .module-header {
            background: linear-gradient(135deg, rgba(0, 179, 72, 0.1) 0%, rgba(0, 179, 72, 0.05) 100%);
            padding: 18px 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }

        .module-header:hover {
            background: linear-gradient(135deg, rgba(255, 183, 51, 0.2) 0%, rgba(255, 183, 51, 0.1) 100%);
        }

        .module-header h3 {
            color: #ffffff;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .module-header span {
            color: #00b348;
            font-size: 18px;
            transition: transform 0.3s;
        }

        .module-header:hover span {
            color: #ffb733;
        }

        .module-content {
            padding: 0;
            display: none;
            background: rgba(20, 20, 20, 0.8);
        }

        .module-content.active {
            display: block;
        }

        .tabs {
            display: flex;
            border-bottom: 2px solid rgba(0, 179, 72, 0.2);
            background: rgba(30, 30, 30, 0.8);
        }

        .tab {
            flex: 1;
            padding: 15px 20px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            color: #94a3b8;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
        }

        .tab:hover {
            background: rgba(0, 179, 72, 0.1);
            color: #00b348;
        }

        .tab.active {
            color: #00b348;
            border-bottom-color: #00b348;
            background: rgba(0, 179, 72, 0.1);
        }

        .tab-content {
            display: none;
            padding: 20px;
        }

        .tab-content.active {
            display: block;
        }

        .content-item {
            padding: 14px 18px;
            border-left: 4px solid #00b348;
            margin-bottom: 12px;
            background: rgba(30, 30, 30, 0.6);
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }

        .content-item:hover {
            transform: translateX(5px);
            border-left-color: #ffb733;
            box-shadow: 0 4px 12px rgba(0, 179, 72, 0.2);
            background: rgba(0, 179, 72, 0.1);
        }

        .content-item span {
            color: #ffffff;
            font-weight: 500;
        }

        .content-item small {
            color: #94a3b8 !important;
        }

        .content-item a {
            color: #00b348;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            background: rgba(0, 179, 72, 0.2);
            border-radius: 8px;
            transition: all 0.3s;
            border: 2px solid #00b348;
        }

        .content-item a:hover {
            background: #00b348;
            color: white;
            transform: scale(1.05);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.85);
            animation: fadeIn 0.3s;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--card-bg);
            margin: 20px;
            padding: 0;
            border-radius: 16px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.5);
            animation: slideIn 0.3s;
            border: 1px solid rgba(0, 179, 72, 0.3);
        }

        .modal-header {
            background: linear-gradient(135deg, #007A33 0%, #1A3C34 100%);
            color: white;
            padding: 25px 30px;
            border-radius: 16px 16px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
        }

        .close-modal {
            color: white;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            line-height: 1;
        }

        .close-modal:hover {
            color: #ffb733;
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 30px;
            background: rgba(30, 30, 30, 0.8);
        }

        .question-card {
            background: rgba(45, 45, 45, 0.8);
            border: 2px solid rgba(0, 179, 72, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .question-card h3 {
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .option {
            background: rgba(30, 30, 30, 0.8);
            border: 2px solid rgba(0, 179, 72, 0.2);
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
        }

        .option:hover {
            border-color: #00b348;
            background: rgba(0, 179, 72, 0.1);
        }

        .option.selected {
            border-color: #00b348;
            background: rgba(0, 179, 72, 0.2);
        }

        .option.correct {
            border-color: #7FB069;
            background: rgba(127, 176, 105, 0.2);
        }

        .option.incorrect {
            border-color: #ef4444;
            background: rgba(239, 68, 68, 0.2);
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #00b348 0%, #007A33 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 179, 72, 0.4);
        }

        .result-badge {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .result-badge.success {
            background: rgba(0, 179, 72, 0.2);
            color: #00b348;
        }

        .result-badge.warning {
            background: rgba(255, 183, 51, 0.2);
            color: #ffb733;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid #ef4444;
            color: #ef4444;
        }

        .alert-success {
            background: rgba(0, 179, 72, 0.2);
            border: 1px solid #00b348;
            color: #00b348;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @media (max-width: 768px) {
            .navbar .container {
                flex-direction: column;
            }

            .course-header h1 {
                font-size: 28px;
            }

            .course-actions {
                flex-direction: column;
            }

            .modal-content {
                width: 95%;
                margin: 10px;
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

                            <div class="tabs">
                                <div class="tab active" onclick="switchTab(event, 'videos-<?php echo $modulo['id']; ?>')">
                                    <i class="fas fa-video"></i> Vídeos
                                </div>
                                <div class="tab" onclick="switchTab(event, 'atividades-<?php echo $modulo['id']; ?>')">
                                    <i class="fas fa-tasks"></i> Atividades
                                </div>
                            </div>

                            <div id="videos-<?php echo $modulo['id']; ?>" class="tab-content active">
                                <?php if (!empty($videos)): ?>
                                    <?php foreach ($videos as $video): ?>
                                        <div class="content-item">
                                            <span><i class="fas fa-play-circle"></i> <?php echo htmlspecialchars($video['titulo']); ?></span>
                                            <?php if ($tem_acesso): ?>
                                                <a href="<?php echo BASE_PATH; ?>/video/<?php echo $video['id']; ?>">Assistir</a>
                                            <?php else: ?>
                                                <span style="color: #9CA3AF;"><i class="fas fa-lock"></i> Bloqueado</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p style="color: #6B7280; padding: 20px; text-align: center;">
                                        <i class="fas fa-info-circle"></i> Nenhum vídeo disponível neste módulo.
                                    </p>
                                <?php endif; ?>
                            </div>

                            <div id="atividades-<?php echo $modulo['id']; ?>" class="tab-content">
                                <?php if (!empty($atividades)): ?>
                                    <?php foreach ($atividades as $atividade): ?>
                                        <div class="content-item">
                                            <span>
                                                <i class="fas fa-tasks"></i> <?php echo htmlspecialchars($atividade['titulo']); ?>
                                                <small style="display: block; color: #6B7280; font-size: 12px; margin-top: 4px;">
                                                    <?php echo ucfirst($atividade['tipo']); ?>
                                                </small>
                                            </span>
                                            <?php if ($tem_acesso): ?>
                                                <a href="#" onclick="openAtividadeModal(<?php echo $atividade['id']; ?>); return false;">Fazer Atividade</a>
                                            <?php else: ?>
                                                <span style="color: #9CA3AF;"><i class="fas fa-lock"></i> Bloqueado</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p style="color: #6B7280; padding: 20px; text-align: center;">
                                        <i class="fas fa-info-circle"></i> Nenhuma atividade disponível neste módulo.
                                    </p>
                                 <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: #6B7280;">Este curso ainda não possui módulos cadastrados.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal de Atividade -->
    <div id="atividadeModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Carregando...</h2>
                <span class="close-modal" onclick="closeAtividadeModal()">&times;</span>
            </div>
            <div class="modal-body" id="modalBody">
                <p style="text-align: center; color: #6B7280;">Carregando atividade...</p>
            </div>
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

        function switchTab(event, tabId) {
            const moduleContent = event.target.closest('.module-content');

            const tabs = moduleContent.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');

            const tabContents = moduleContent.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.remove('active'));

            document.getElementById(tabId).classList.add('active');
        }

        function openAtividadeModal(atividadeId) {
            const modal = document.getElementById('atividadeModal');
            modal.classList.add('active');

            fetch('<?php echo BASE_PATH; ?>/atividade/' + atividadeId)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderAtividade(data);
                    } else {
                        document.getElementById('modalBody').innerHTML =
                            '<p style="color: #DC2626; text-align: center;"><i class="fas fa-exclamation-circle"></i> ' + data.message + '</p>';
                    }
                })
                .catch(error => {
                    document.getElementById('modalBody').innerHTML =
                        '<p style="color: #DC2626; text-align: center;"><i class="fas fa-exclamation-circle"></i> Erro ao carregar atividade.</p>';
                });
        }

        function closeAtividadeModal() {
            const modal = document.getElementById('atividadeModal');
            modal.classList.remove('active');
        }

        function renderAtividade(data) {
            document.getElementById('modalTitle').innerHTML =
                '<i class="fas fa-tasks"></i> ' + data.atividade.titulo;

            let html = '';

            if (data.atividade.descricao) {
                html += '<p style="color: #6B7280; margin-bottom: 20px;">' + data.atividade.descricao + '</p>';
            }

            if (data.nota > 0) {
                html += '<div class="result-badge success"><i class="fas fa-check-circle"></i> Nota: ' + data.nota + '%</div>';
            }

            if (data.perguntas && data.perguntas.length > 0) {
                data.perguntas.forEach((pergunta, index) => {
                    html += '<div class="question-card">';
                    html += '<h3>' + (index + 1) + '. ' + pergunta.pergunta + '</h3>';

                    if (pergunta.opcoes && pergunta.opcoes.length > 0) {
                        pergunta.opcoes.forEach(opcao => {
                            const isSelected = data.respostas_usuario.some(r => r.opcao_escolhida_id == opcao.id);
                            const selectedClass = isSelected ? 'selected' : '';

                            html += '<div class="option ' + selectedClass + '" onclick="selectOption(this, ' + pergunta.id + ', ' + opcao.id + ')">';
                            html += '<input type="radio" name="pergunta_' + pergunta.id + '" value="' + opcao.id + '" ' + (isSelected ? 'checked' : '') + '>';
                            html += '<span>' + opcao.texto_opcao + '</span>';
                            html += '</div>';
                        });
                    }

                    html += '</div>';
                });

                html += '<button class="submit-btn" onclick="submitAtividade(' + data.atividade.id + ')"><i class="fas fa-paper-plane"></i> Enviar Respostas</button>';
            } else {
                html += '<p style="color: #6B7280; text-align: center;"><i class="fas fa-info-circle"></i> Esta atividade ainda não possui perguntas cadastradas.</p>';
            }

            document.getElementById('modalBody').innerHTML = html;
        }

        function selectOption(element, perguntaId, opcaoId) {
            const questionCard = element.closest('.question-card');
            questionCard.querySelectorAll('.option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');
            element.querySelector('input[type="radio"]').checked = true;
        }

        function submitAtividade(atividadeId) {
            // Coletar respostas
            const radios = document.querySelectorAll('#modalBody input[type="radio"]:checked');

            if (radios.length === 0) {
                alert('Por favor, responda pelo menos uma pergunta!');
                return;
            }

            // Construir payload de respostas
            const respostas = [];
            radios.forEach(radio => {
                const perguntaId = radio.name.replace('pergunta_', '');
                respostas.push({
                    pergunta_id: perguntaId,
                    opcao_id: radio.value
                });
            });

            // Enviar todas as respostas em uma única requisição
            fetch('<?php echo BASE_PATH; ?>/responder-atividade', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    atividade_id: atividadeId,
                    respostas: respostas
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Recarregar atividade para mostrar resultado atualizado
                    openAtividadeModal(atividadeId);
                    alert('Respostas enviadas com sucesso!');
                } else {
                    alert(data.message || 'Erro ao enviar respostas.');
                }
            })
            .catch(() => {
                alert('Erro na requisição. Tente novamente mais tarde.');
            });
        }

        // Fechar modal ao clicar fora (adiciona listener apenas uma vez para evitar duplicação)
        if (!window._atividadeModalClickHandlerAttached) {
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('atividadeModal');
                if (modal && event.target === modal) {
                    closeAtividadeModal();
                }
            });
            window._atividadeModalClickHandlerAttached = true;
        }
    </script>

    <script>
        function toggleModule(header) {
            const content = header.nextElementSibling;
            const arrow = header.querySelector('span');
            content.classList.toggle('active');
            arrow.textContent = content.classList.contains('active') ? '▲' : '▼';
            arrow.style.transform = content.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
        }

        function switchTab(event, tabId) {
            const moduleContent = event.target.closest('.module-content');

            const tabs = moduleContent.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');

            const tabContents = moduleContent.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.remove('active'));

            document.getElementById(tabId).classList.add('active');
        }
    </script>
</body>
</html>
