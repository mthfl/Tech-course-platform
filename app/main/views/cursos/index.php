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
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a1a1a;
            background-image: radial-gradient(circle at 10% 20%, rgba(52, 152, 219, 0.05) 0%, rgba(52, 152, 219, 0) 20%),
                              radial-gradient(circle at 90% 80%, rgba(46, 204, 113, 0.05) 0%, rgba(46, 204, 113, 0) 20%);
            min-height: 100vh;
            color: #ffffff;
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

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            color: #ffffff;
            font-size: 36px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #94a3b8;
            font-size: 18px;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .course-card {
            background: rgba(45, 45, 45, 0.9);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
            border: 2px solid rgba(0, 179, 72, 0.2);
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 179, 72, 0.2);
            border-color: #00b348;
        }

        .course-card.bloqueado {
            opacity: 0.6;
            position: relative;
        }

        .course-card.bloqueado::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 16px;
            z-index: 1;
            pointer-events: none;
        }

        .course-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #007A33 0%, #00b348 50%, #1A3C34 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .course-body {
            padding: 20px;
        }

        .course-header {
            margin-bottom: 15px;
        }

        .course-title {
            color: #ffffff;
            font-size: 22px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .course-level {
            display: inline-block;
            padding: 6px 14px;
            background: rgba(0, 179, 72, 0.2);
            color: #00b348;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .course-description {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .course-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .course-price {
            color: #ffb733;
            font-size: 24px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
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

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .lock-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 64px;
            color: rgba(255, 255, 255, 0.8);
            z-index: 2;
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

        @media (max-width: 768px) {
            .navbar .container {
                flex-direction: column;
            }

            .page-header h1 {
                font-size: 28px;
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
                        <i class="fas fa-graduation-cap"></i>
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
                            <span class="course-price"><?php echo $curso['preco_coins']; ?> <i class="fas fa-coins"></i></span>

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
</html>
