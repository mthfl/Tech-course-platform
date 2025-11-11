<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#007A33">
    <title>Cursos - <?php echo APP_NAME; ?></title>
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
            position: relative;
        }

        .navbar .nav-menu a:hover {
            background: rgba(255, 183, 51, 0.2);
            color: var(--accent-color);
        }

        .navbar .nav-menu a i {
            font-size: 16px;
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
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-header h1 i {
            color: var(--header-color);
            font-size: 32px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 16px;
            position: relative;
        }

        .course-grid {
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
            display: flex;
            flex-direction: column;
            /* altura consistente dos cards */
            min-height: 420px;
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

        .course-card.bloqueado {
            opacity: 0.6;
        }

        .course-card.bloqueado::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 16px;
            z-index: 1;
            pointer-events: none;
            backdrop-filter: blur(2px);
        }

        .course-card.bloqueado:hover {
            transform: translateY(0);
            box-shadow: var(--shadow-sm);
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

        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .course-image img {
                object-position: center 70%;
            }
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

        .course-image i {
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
        }

        .lock-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 72px;
            color: rgba(255, 255, 255, 0.9);
            z-index: 2;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.5));
            animation: lockPulse 2s infinite;
        }

        @keyframes lockPulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.1); }
        }

        .course-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .course-header {
            margin-bottom: 15px;
        }

        .course-title {
            color: #ffffff;
            font-size: 19px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .course-level {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(0, 179, 72, 0.15);
            color: var(--header-color);
            border: 1px solid rgba(0, 179, 72, 0.3);
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .course-description {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
            /* Limita número de linhas para manter altura uniforme */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .course-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .course-price {
            color: var(--accent-color);
            font-size: 24px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .course-price i {
            font-size: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--header-color) 0%, #007A33 100%);
            color: white;
            text-decoration: none;
            border: none;
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

        .btn-secondary {
            background: linear-gradient(135deg, var(--accent-color) 0%, #f59e0b 100%);
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
        }

        .btn-secondary:hover {
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.4);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: rgba(100, 100, 100, 0.5);
            box-shadow: none;
        }

        .btn:disabled:hover {
            transform: none;
            box-shadow: none;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        .alert i {
            font-size: 18px;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(0, 179, 72, 0.15);
            border: 1px solid rgba(0, 179, 72, 0.3);
            color: #86efac;
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

            .course-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <style>
        /* Responsividade aprimorada */
        .navbar .container {
            padding: 0 clamp(16px, 3vw, 32px);
            height: clamp(56px, 8vw, 72px);
        }

        .navbar .logo {
            font-size: clamp(18px, 2.4vw, 22px);
        }

        .container {
            padding: clamp(24px, 4vw, 40px) clamp(16px, 3vw, 32px);
        }

        .page-header h1 {
            font-size: clamp(24px, 3.2vw, 36px);
        }

        .course-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: clamp(16px, 2.4vw, 24px);
        }

        .course-image {
            height: auto !important;
            aspect-ratio: 16/9;
        }

        .course-title {
            font-size: clamp(17px, 2vw, 19px);
        }

        .course-description {
            font-size: clamp(13px, 1.8vw, 14px);
        }

        .btn {
            min-height: 44px;
            touch-action: manipulation;
        }

        .alert {
            font-size: clamp(13px, 1.8vw, 14px);
        }

        .navbar .nav-menu a {
            padding: clamp(8px, 1.8vw, 10px) clamp(12px, 2.2vw, 18px);
            font-size: clamp(13px, 1.9vw, 14px);
        }

        @media (max-width: 1280px) {
            .container { padding: clamp(20px, 3.2vw, 32px) clamp(14px, 2.6vw, 28px); }
            .course-grid { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); }
        }

        @media (max-width: 992px) {
            .navbar .container {
                height: auto;
                padding: 12px 24px;
                gap: 12px;
                flex-direction: column;
            }
            .navbar .nav-menu { flex-wrap: wrap; justify-content: center; }
            .course-grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); }
        }

        @media (max-width: 768px) {
            .page-header h1 { font-size: clamp(22px, 6vw, 28px); }
            .course-grid { grid-template-columns: 1fr; }
            .btn { width: 100%; }
            .course-card { min-height: 380px; }
            .course-footer { flex-direction: column; align-items: stretch; gap: 12px; }
        }

        @media (max-width: 576px) {
            .navbar .nav-menu {
                gap: 6px;
                overflow-x: auto;
                padding-bottom: 6px;
            }
            .course-body { padding: 16px; }
            .course-title { font-size: clamp(16px, 5.2vw, 19px); }
            .course-description { font-size: clamp(13px, 4.2vw, 14px); }
        }

        .btn:focus-visible,
        .navbar .nav-menu a:focus-visible {
            outline: 2px solid var(--accent-color);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <style>
        /* Botão de menu (hambúrguer) ao lado do "Área Dev" */
        .menu-toggle {
            display: none;
            background: rgba(0, 179, 72, 0.12);
            border: 1px solid rgba(0, 179, 72, 0.3);
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            gap: 8px;
        }
        .menu-toggle i { color: var(--header-color); }

        /* Agrupa logo + botão para ficarem lado a lado */
        .navbar .brand-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Overlay para fundo quando o menu lateral estiver aberto */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 999;
        }
        .sidebar-overlay.active { opacity: 1; visibility: visible; }

        @media (max-width: 992px) {
            .menu-toggle { display: inline-flex; align-items: center; }
            .navbar { position: sticky; }
            .navbar .container { position: relative; gap: 12px; }

            /* Menu vira uma lateral fixa (off-canvas) */
            .navbar .nav-menu {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: min(85vw, 320px);
                background: var(--sidebar-bg);
                border-right: 1px solid var(--border-color);
                padding: 80px 12px 16px; /* espaço para header */
                display: flex;
                flex-direction: column;
                gap: 8px;
                z-index: 1000;
                box-shadow: var(--shadow-lg);
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }
            body.menu-open .navbar .nav-menu { transform: translateX(0); }

            .navbar .nav-menu a {
                width: 100%;
                padding: 12px 14px;
                border-radius: 8px;
            }
            .navbar .user-info { width: 100%; justify-content: flex-start; margin: 8px 0; }
        }
    </style>
    <nav class="navbar">
        <div class="container">
            <div class="brand-group">
                <a href="<?php echo BASE_PATH; ?>/dashboard" class="logo">
                     Área Dev
                </a>
                <button class="menu-toggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="primary-menu">
                    <i class="fas fa-bars"></i>
                    Menu
                </button>
            </div>
            <ul class="nav-menu" id="primary-menu">
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
    <div class="sidebar-overlay" aria-hidden="true"></div>

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

        <div class="page-header">
            <h1><i class="fas fa-book-open"></i> Catálogo de Cursos</h1>
            <p>Explore nossos cursos e comece sua jornada de aprendizado</p>
        </div>

        <div class="course-grid">
            <?php foreach ($cursos as $curso): ?>
                <?php
                    $bloqueado = false;
                    $nivel_usuario = $_SESSION['usuario_nivel'];
                    $nivel_requerido = $curso['nivel_requerido'];

                    $niveis = ['iniciante' => 1, 'intermediario' => 2, 'avancado' => 3];
                    if ($niveis[$nivel_usuario] < $niveis[$nivel_requerido]) {
                        $bloqueado = true;
                    }
                ?>
                <div class="course-card <?php echo $bloqueado ? 'bloqueado' : ''; ?>">
                    <?php if ($bloqueado): ?>
                        <i class="fas fa-lock lock-icon"></i>
                    <?php endif; ?>

                    <div class="course-image">
                        <?php if (!empty($curso['imagem_capa'])): ?>
                            <img src="<?php echo BASE_PATH; ?>/uploads/cursos/<?php echo htmlspecialchars($curso['imagem_capa']); ?>" alt="<?php echo htmlspecialchars($curso['titulo']); ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                        <?php else: ?>
                            <i class="fas fa-graduation-cap"></i>
                        <?php endif; ?>
                    </div>

                    <div class="course-body">
                        <div class="course-header">
                            <h3 class="course-title"><?php echo htmlspecialchars($curso['titulo']); ?></h3>
                            <span class="course-level"><?php echo ucfirst($curso['nivel_requerido']); ?></span>
                        </div>

                        <p class="course-description">
                            <?php echo htmlspecialchars(substr($curso['descricao'], 0, 100)); ?>...
                        </p>

                        <div class="course-footer">
                            <?php if ($bloqueado): ?>
                                <button class="btn" disabled>
                                    <i class="fas fa-lock"></i> Bloqueado
                                </button>
                            <?php elseif ($curso['comprado']): ?>
                                <a href="<?php echo BASE_PATH; ?>/curso/<?php echo $curso['id']; ?>" class="btn btn-secondary">
                                    <i class="fas fa-play"></i> Acessar
                                </a>
                            <?php else: ?>
                                <a href="<?php echo BASE_PATH; ?>/curso/<?php echo $curso['id']; ?>" class="btn">
                                    <i class="fas fa-shopping-cart"></i> Comprar
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
<script>
  (function(){
    const toggle = document.querySelector('.menu-toggle');
    const menu = document.getElementById('primary-menu');
    const overlay = document.querySelector('.sidebar-overlay');
    if (!toggle || !menu || !overlay) return;

    const closeMenu = () => {
      document.body.classList.remove('menu-open');
      overlay.classList.remove('active');
      document.body.style.overflow = '';
      toggle.setAttribute('aria-expanded','false');
    };

    toggle.addEventListener('click', () => {
      const willOpen = !document.body.classList.contains('menu-open');
      document.body.classList.toggle('menu-open');
      overlay.classList.toggle('active');
      document.body.style.overflow = willOpen ? 'hidden' : '';
      toggle.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
    });

    overlay.addEventListener('click', closeMenu);
    menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
      if (window.innerWidth <= 992) closeMenu();
    }));
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeMenu(); });
  })();
</script>
</html>