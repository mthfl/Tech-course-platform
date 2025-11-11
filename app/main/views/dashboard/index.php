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

        .dashboard-header {
            margin-bottom: 40px;
            padding: 32px;
            background: linear-gradient(135deg, rgba(0, 179, 72, 0.1) 0%, rgba(0, 179, 72, 0.02) 100%);
            border-radius: 20px;
            border: 1px solid rgba(0, 179, 72, 0.15);
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(0, 179, 72, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .dashboard-header h1 {
            color: #ffffff;
            font-size: 36px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
        }

        .dashboard-header p {
            color: var(--text-secondary);
            font-size: 16px;
            position: relative;
        }

        .courses-section {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .courses-section h2 {
            color: #ffffff;
            font-size: 28px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .courses-section h2 i {
            color: var(--header-color);
            font-size: 24px;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .course-card {
            background: rgba(30, 30, 30, 0.8);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            transition: var(--transition);
            cursor: pointer;
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
            border-color: rgba(0, 179, 72, 0.4);
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .course-card:hover::before {
            transform: scaleX(1);
        }

        .course-card-header {
            padding: 24px;
            background: linear-gradient(135deg, rgba(0, 179, 72, 0.08) 0%, rgba(0, 179, 72, 0.02) 100%);
            position: relative;
        }

        .course-card-title {
            color: #ffffff;
            font-size: 19px;
            font-weight: 600;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .course-card-level {
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

        .course-card-body {
            padding: 24px;
        }

        .course-card-description {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .course-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .course-card-price {
            color: var(--accent-color);
            font-size: 22px;
            font-weight: 700;
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

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: var(--text-secondary);
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

        .empty-state p {
            font-size: 16px;
            margin-bottom: 32px;
            line-height: 1.6;
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

            .dashboard-header h1 {
                font-size: 28px;
            }

            .course-grid {
                grid-template-columns: 1fr;
            }

            .courses-section {
                padding: 24px;
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

        .dashboard-header h1 {
            font-size: clamp(24px, 3.5vw, 36px);
        }

        .courses-section {
            padding: clamp(24px, 3.8vw, 40px);
        }

        .course-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: clamp(16px, 2.4vw, 24px);
        }

        .course-card-title {
            font-size: clamp(17px, 2vw, 19px);
        }

        .course-card-description {
            font-size: clamp(13px, 1.8vw, 14px);
        }

        .btn {
            min-height: 44px;
            touch-action: manipulation;
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
            .dashboard-header h1 { font-size: clamp(22px, 6vw, 28px); }
            .course-grid { grid-template-columns: 1fr; }
            .btn { width: 100%; }
            .courses-section { padding: clamp(20px, 3.2vw, 24px); }
        }

        @media (max-width: 576px) {
            .navbar .nav-menu {
                gap: 6px;
                overflow-x: auto;
                padding-bottom: 6px;
            }
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

            .navbar .nav-menu a { width: 100%; padding: 12px 14px; border-radius: 8px; }
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

        <div class="dashboard-header">
            <h1>Olá, <?php echo $_SESSION['usuario_nome']; ?>! 👋</h1>
            <p>Bem-vindo ao seu painel de aprendizado</p>
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
                                    <span style="color: var(--header-color); font-weight: 600; display: flex; align-items: center; gap: 6px;">
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
                    <p>Você ainda não possui cursos.<br>Explore nossa biblioteca e comece a aprender!</p>
                    <a href="<?php echo BASE_PATH; ?>/cursos" class="btn">
                        <i class="fas fa-search"></i> Explorar Cursos
                    </a>
                </div>
            <?php endif; ?>
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