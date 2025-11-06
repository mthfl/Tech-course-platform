<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#005A24">
    <title>Login - <?php echo APP_NAME; ?></title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 2px 10px -2px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 450px;
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h1 {
            color: #1A3C34;
            font-size: 32px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #6B7280;
            font-size: 16px;
        }
        .input-group {
            position: relative;
            margin-bottom: 24px;
        }
        .input-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid rgba(0, 90, 36, 0.3);
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, rgba(248, 250, 249, 0.8) 0%, rgba(255, 255, 255, 0.9) 100%);
            font-family: 'Inter', sans-serif;
        }
        .input-group input:focus {
            transform: translateY(-2px);
            outline: none;
            border-color: #FFA500;
            box-shadow: 0 8px 25px rgba(255, 165, 0, 0.3);
            background: rgba(255, 255, 255, 0.95);
        }
        .input-group label {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(26, 60, 52, 0.6);
            font-size: 16px;
            transition: all 0.3s ease;
            pointer-events: none;
            padding: 0 5px;
            background-color: transparent;
            z-index: 1;
            font-family: 'Inter', sans-serif;
        }
        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: -12px;
            left: 12px;
            font-size: 13px;
            color: #FFA500;
            transform: translateY(0);
            background: linear-gradient(135deg, #F8FAF9 0%, #E8F4F8 100%);
            padding: 0 8px;
            font-weight: 600;
            border-radius: 4px;
        }
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #005A24;
            font-size: 18px;
        }
        .input-group input {
            padding-left: 48px;
        }
        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 8px 20px rgba(0, 90, 36, 0.3);
            position: relative;
            overflow: hidden;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        .btn:hover::before {
            left: 100%;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(0, 90, 36, 0.4);
        }
        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            gap: 10px;
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
        .register-link {
            text-align: center;
            margin-top: 24px;
            color: #6B7280;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
        }
        .register-link a {
            color: #FFA500;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        .register-link a:hover {
            color: #005A24;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Bem-vindo!</h1>
            <p>Faça login para continuar</p>
        </div>
        
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
        
        <form method="POST" action="<?php echo BASE_PATH; ?>/login">
            <div class="input-group">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" id="email" name="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" id="senha" name="senha" placeholder=" " required>
                <label for="senha">Senha</label>
            </div>
            
            <button type="submit" class="btn">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </button>
        </form>
        
        <div class="register-link">
            Não tem uma conta? <a href="<?php echo BASE_PATH; ?>/registro">Cadastre-se</a>
        </div>
    </div>
</body>
</html>
