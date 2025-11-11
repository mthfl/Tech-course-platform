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
        }

        .navbar .nav-menu a:hover {
            background: rgba(255, 183, 51, 0.2);
            color: var(--accent-color);
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

        .course-header {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .course-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(0, 179, 72, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .course-header h1 {
            color: #ffffff;
            font-size: 40px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            line-height: 1.2;
        }

        .course-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            position: relative;
        }

        .course-level {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            background: rgba(0, 179, 72, 0.15);
            color: var(--header-color);
            border: 1px solid rgba(0, 179, 72, 0.3);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .course-price {
            color: var(--accent-color);
            font-size: 28px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .course-description {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 25px;
            font-size: 16px;
            position: relative;
        }

        .course-actions {
            display: flex;
            gap: 15px;
            position: relative;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--header-color) 0%, #007A33 100%);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
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

        .progress-section {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            padding: 30px;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
        }

        .progress-section h3 {
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-section h3 i {
            color: var(--header-color);
        }

        .progress-bar {
            width: 100%;
            height: 14px;
            background: rgba(30, 30, 30, 0.8);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 12px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, var(--header-color) 0%, #7FB069 100%);
            transition: width 0.6s ease;
            box-shadow: 0 0 10px rgba(0, 179, 72, 0.5);
        }

        .progress-section p {
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 15px;
        }

        .modules-section {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .modules-section h2 {
            color: #ffffff;
            font-size: 28px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modules-section h2 i {
            color: var(--header-color);
        }

        .module {
            border: 1px solid var(--border-color);
            border-radius: 16px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: var(--transition);
            background: rgba(30, 30, 30, 0.6);
        }

        .module:hover {
            border-color: rgba(0, 179, 72, 0.4);
            box-shadow: 0 4px 15px rgba(0, 179, 72, 0.2);
        }

        .module-header {
            background: linear-gradient(135deg, rgba(0, 179, 72, 0.1) 0%, rgba(0, 179, 72, 0.05) 100%);
            padding: 20px 24px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }

        .module-header:hover {
            background: linear-gradient(135deg, rgba(255, 183, 51, 0.15) 0%, rgba(255, 183, 51, 0.05) 100%);
        }

        .module-header h3 {
            color: #ffffff;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .module-header span {
            color: var(--header-color);
            font-size: 20px;
            transition: var(--transition);
        }

        .module-header:hover span {
            color: var(--accent-color);
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
            border-bottom: 2px solid var(--border-color);
            background: rgba(30, 30, 30, 0.8);
        }

        .tab {
            flex: 1;
            padding: 16px 24px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            color: var(--text-secondary);
            transition: var(--transition);
            border-bottom: 3px solid transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .tab:hover {
            background: rgba(0, 179, 72, 0.1);
            color: var(--header-color);
        }

        .tab.active {
            color: var(--header-color);
            border-bottom-color: var(--header-color);
            background: rgba(0, 179, 72, 0.1);
        }

        .tab-content {
            display: none;
            padding: 24px;
        }

        .tab-content.active {
            display: block;
        }

        .content-item {
            padding: 16px 20px;
            border-left: 4px solid var(--header-color);
            margin-bottom: 14px;
            background: rgba(30, 30, 30, 0.6);
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }

        .content-item:hover {
            transform: translateX(8px);
            border-left-color: var(--accent-color);
            box-shadow: 0 4px 12px rgba(0, 179, 72, 0.2);
            background: rgba(0, 179, 72, 0.08);
        }

        .content-item span {
            color: #ffffff;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .content-item span i {
            color: var(--header-color);
            margin-right: 8px;
        }

        .content-item small {
            color: var(--text-secondary) !important;
            font-size: 12px;
        }

        .content-item a {
            color: var(--header-color);
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            background: rgba(0, 179, 72, 0.15);
            border-radius: 10px;
            transition: var(--transition);
            border: 2px solid var(--header-color);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .content-item a:hover {
            background: var(--header-color);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 179, 72, 0.4);
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
            background-color: rgba(0, 0, 0, 0.9);
            animation: fadeIn 0.3s;
            backdrop-filter: blur(8px);
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
            border-radius: 20px;
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.7);
            animation: slideIn 0.3s;
            border: 1px solid rgba(0, 179, 72, 0.3);
        }

        .modal-header {
            background: linear-gradient(135deg, #007A33 0%, #1A3C34 100%);
            color: white;
            padding: 28px 35px;
            border-radius: 20px 20px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .close-modal {
            color: white;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
            line-height: 1;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .close-modal:hover {
            background: rgba(255, 183, 51, 0.2);
            color: var(--accent-color);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 35px;
            background: rgba(30, 30, 30, 0.8);
        }

        .question-card {
            background: rgba(45, 45, 45, 0.8);
            border: 2px solid var(--border-color);
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 24px;
            transition: var(--transition);
        }

        .question-card:hover {
            border-color: rgba(0, 179, 72, 0.4);
        }

        .question-card h3 {
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 18px;
            font-size: 18px;
            line-height: 1.5;
        }

        .option {
            background: rgba(30, 30, 30, 0.8);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ffffff;
        }

        .option:hover {
            border-color: var(--header-color);
            background: rgba(0, 179, 72, 0.08);
        }

        .option.selected {
            border-color: var(--header-color);
            background: rgba(0, 179, 72, 0.15);
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
            padding: 16px;
            background: linear-gradient(135deg, var(--header-color) 0%, #007A33 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(0, 179, 72, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 179, 72, 0.4);
        }

        .result-badge {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 20px;
            font-weight: 600;
            margin-bottom: 24px;
            font-size: 16px;
        }

        .result-badge.success {
            background: rgba(0, 179, 72, 0.2);
            color: var(--header-color);
            border: 2px solid var(--header-color);
        }

        .result-badge.warning {
            background: rgba(255, 183, 51, 0.2);
            color: var(--accent-color);
            border: 2px solid var(--accent-color);
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

        /* Video Player Styles - Inline no módulo */
        .video-item {
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(30, 30, 30, 0.6);
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .video-item-header {
            margin-bottom: 16px;
        }

        .video-item-header h4 {
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .video-item-header h4 i {
            color: var(--header-color);
        }

        .video-item-header p {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
        }

        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            background: #000;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .video-progress-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: rgba(0, 179, 72, 0.15);
            border: 2px solid var(--header-color);
            border-radius: 20px;
            color: var(--header-color);
            font-weight: 600;
            font-size: 14px;
        }

        .video-progress-badge.watched {
            background: rgba(127, 176, 105, 0.2);
            border-color: #7FB069;
            color: #7FB069;
        }

        .btn-mark-watched {
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--header-color) 0%, #007A33 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0, 179, 72, 0.3);
        }

        .btn-mark-watched:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 179, 72, 0.4);
        }

        .btn-mark-watched:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: rgba(0, 179, 72, 0.3);
        }

        .btn-mark-watched.watched {
            background: linear-gradient(135deg, #7FB069 0%, #5a8f4a 100%);
            box-shadow: 0 4px 15px rgba(127, 176, 105, 0.3);
        }

        .recompensa-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: rgba(255, 183, 51, 0.15);
            border: 2px solid var(--accent-color);
            border-radius: 20px;
            color: var(--accent-color);
            font-weight: 600;
            font-size: 14px;
        }

        .video-reward-notification {
            margin-top: 12px;
            padding: 12px 16px;
            background: rgba(255, 183, 51, 0.1);
            border: 1px solid var(--accent-color);
            border-radius: 8px;
            color: var(--accent-color);
            font-size: 14px;
            display: none;
        }

        .video-reward-notification.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Modal de Confirmação Personalizado */
        .custom-confirm-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            animation: fadeIn 0.3s ease;
        }

        .custom-confirm-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .confirm-modal-content {
            background: linear-gradient(135deg, var(--card-bg) 0%, rgba(30, 30, 30, 0.95) 100%);
            border: 2px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            box-shadow: var(--shadow-lg);
            animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .confirm-modal-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--header-color) 0%, var(--accent-color) 100%);
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px) scale(0.95);
                opacity: 0;
            }
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .confirm-modal-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .confirm-modal-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(0, 179, 72, 0.2) 0%, rgba(255, 183, 51, 0.2) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: var(--header-color);
            animation: pulse 2s infinite;
        }

        .confirm-modal-title {
            font-size: 24px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .confirm-modal-subtitle {
            color: var(--text-secondary);
            font-size: 16px;
            line-height: 1.5;
        }

        .confirm-modal-body {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .confirm-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            font-size: 15px;
            color: var(--text-secondary);
        }

        .confirm-info-item:last-child {
            margin-bottom: 0;
        }

        .confirm-info-item i {
            color: var(--header-color);
            width: 20px;
            text-align: center;
        }

        .confirm-info-item strong {
            color: #ffffff;
            font-weight: 600;
        }

        .confirm-modal-footer {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .confirm-btn {
            padding: 14px 28px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 120px;
            justify-content: center;
        }

        .confirm-btn-primary {
            background: linear-gradient(135deg, var(--header-color) 0%, #007A33 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 179, 72, 0.3);
        }

        .confirm-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 179, 72, 0.4);
        }

        .confirm-btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-secondary);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .confirm-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .confirm-warning {
            background: rgba(255, 183, 51, 0.1);
            border: 1px solid var(--accent-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .confirm-warning i {
            color: var(--accent-color);
            font-size: 18px;
            margin-top: 2px;
        }

        .confirm-warning-text {
            color: var(--accent-color);
            font-size: 14px;
            line-height: 1.4;
            font-weight: 500;
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

            .modules-section, .course-header, .progress-section {
                padding: 24px;
            }

            .video-item {
                padding: 16px;
            }

            .video-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-mark-watched {
                width: 100%;
                justify-content: center;
            }

            .video-container {
                margin-bottom: 16px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo BASE_PATH; ?>/dashboard" class="logo">
                  Área Dev
            </a>
            <ul class="nav-menu">
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
    
    <!-- Modal de Confirmação Personalizado -->
    <div id="customConfirmModal" class="custom-confirm-modal">
        <div class="confirm-modal-content">
            <div class="confirm-modal-header">
                <div class="confirm-modal-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="confirm-modal-title">Confirmar Envio</div>
                <div class="confirm-modal-subtitle">Revise suas respostas antes de enviar</div>
            </div>
            
            <div class="confirm-modal-body" id="confirmModalBody">
                <!-- Conteúdo dinâmico será inserido aqui -->
            </div>
            
            <div class="confirm-modal-footer">
                <button class="confirm-btn confirm-btn-secondary" onclick="fecharConfirmModal()">
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button class="confirm-btn confirm-btn-primary" onclick="confirmarEnvioFinal()">
                    <i class="fas fa-paper-plane"></i>
                    Confirmar Envio
                </button>
            </div>
        </div>
    </div>
    
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
            <?php if (!empty($curso['imagem_capa'])): ?>
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="<?php echo BASE_PATH; ?>/uploads/cursos/<?php echo htmlspecialchars($curso['imagem_capa']); ?>" alt="<?php echo htmlspecialchars($curso['titulo']); ?>" style="max-width: 300px; max-height: 200px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                </div>
            <?php endif; ?>
            <h1><?php echo htmlspecialchars($curso['titulo']); ?></h1>
            <div class="course-meta">
                <span class="course-level"><?php echo ucfirst($curso['nivel_requerido']); ?></span>
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
                $videoModelGlobal = new Video();
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
                            $videos = $videoModelGlobal->buscarPorModulo($modulo['id']);
                            $atividades = $atividadeModel->buscarPorModulo($modulo['id']);
                            
                            // Debug temporário para verificar carregamento de atividades
                            error_log("Módulo ID: " . $modulo['id'] . " - Atividades encontradas: " . count($atividades));
                            
                            // Debug visível na página
                            echo "<!-- DEBUG: Módulo ID: " . $modulo['id'] . " - Atividades encontradas: " . count($atividades) . " -->";
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
                                        <?php
                                        // Verifica se o vídeo já foi assistido
                                        $progresso_video = 0;
                                        
                                        if ($tem_acesso) {
                                            $progresso_video = $videoModelGlobal->verificarSeAssistido($_SESSION['usuario_id'], $video['id']);
                                        }
                                        ?>
                                        <div class="video-item" data-video-id="<?php echo $video['id']; ?>">
                                            <div class="video-item-header">
                                                <h4><i class="fas fa-video"></i><?php echo htmlspecialchars($video['titulo']); ?></h4>
                                                <?php if ($video['descricao']): ?>
                                                    <p><?php echo htmlspecialchars($video['descricao']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <?php if ($tem_acesso): ?>
                                                <div class="video-container">
                                                    <iframe 
                                                        src="<?php echo htmlspecialchars($video['drive_embed_link']); ?>" 
                                                        allow="autoplay; fullscreen" 
                                                        allowfullscreen
                                                        loading="lazy">
                                                    </iframe>
                                                </div>
                                                
                                                <div class="video-actions">
                                                    <div>
                                                        <?php if ($progresso_video >= 90): ?>
                                                            <span class="video-progress-badge watched">
                                                                <i class="fas fa-check-circle"></i> Vídeo Assistido
                                                            </span>
                                                        <?php elseif ($progresso_video > 0): ?>
                                                            <span class="video-progress-badge">
                                                                <i class="fas fa-clock"></i> Em Progresso (<?php echo round($progresso_video); ?>%)
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="video-progress-badge">
                                                                <i class="fas fa-play-circle"></i> Não Assistido
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    
                                                    <button 
                                                        class="btn-mark-watched <?php echo $progresso_video >= 90 ? 'watched' : ''; ?>" 
                                                        onclick="marcarVideoComoAssistido(<?php echo $video['id']; ?>)" 
                                                        data-video-id="<?php echo $video['id']; ?>"
                                                        <?php echo $progresso_video >= 90 ? 'disabled' : ''; ?>>
                                                        <?php if ($progresso_video >= 90): ?>
                                                            <i class="fas fa-check-circle"></i> Já Visualizado
                                                        <?php else: ?>
                                                            <i class="fas fa-check"></i> Marcar como Visualizado
                                                        <?php endif; ?>
                                                    </button>
                                                </div>
                                            <?php else: ?>
                                                <div style="padding: 40px; text-align: center; background: rgba(30, 30, 30, 0.8); border-radius: 12px;">
                                                    <i class="fas fa-lock" style="font-size: 48px; color: #94a3b8; margin-bottom: 16px;"></i>
                                                    <p style="color: #94a3b8; font-size: 16px;">Este vídeo está bloqueado. Compre o curso para ter acesso.</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p style="color: var(--text-secondary); padding: 20px; text-align: center;">
                                        <i class="fas fa-info-circle"></i> Nenhum vídeo disponível neste módulo.
                                    </p>
                                <?php endif; ?>
                            </div>

                            <div id="atividades-<?php echo $modulo['id']; ?>" class="tab-content">
                                <?php if (!empty($atividades)): ?>
                                    <?php foreach ($atividades as $atividade): ?>
                                        <div class="content-item">
                                            <span>
                                                <div><i class="fas fa-tasks"></i><?php echo htmlspecialchars($atividade['titulo']); ?></div>
                                                <small><?php echo ucfirst($atividade['tipo']); ?></small>
                                            </span>
                                            <?php if ($tem_acesso): ?>
                                                <?php
                                                // Verifica se já fez a atividade
                                                $progresso_atividade = 0;
                                                $ja_fez_atividade = false;
                                                if (isset($atividadeModel)) {
                                                    $respostas_atividade = $atividadeModel->verificarRespostasUsuario($_SESSION['usuario_id'], $atividade['id']);
                                                    $ja_fez_atividade = !empty($respostas_atividade);
                                                    if ($ja_fez_atividade) {
                                                        $nota_atividade = $atividadeModel->calcularNota($_SESSION['usuario_id'], $atividade['id']);
                                                        $progresso_atividade = $nota_atividade;
                                                    }
                                                }
                                                ?>
                                                <a href="#" onclick="openAtividadeModal(<?php echo $atividade['id']; ?>); return false;">
                                                    <?php if ($ja_fez_atividade): ?>
                                                        <i class="fas fa-redo"></i> Refazer Atividade
                                                    <?php else: ?>
                                                        <i class="fas fa-tasks"></i> Fazer Atividade
                                                    <?php endif; ?>
                                                </a>
                                            <?php else: ?>
                                                <span style="color: #94a3b8;"><i class="fas fa-lock"></i> Bloqueado</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p style="color: var(--text-secondary); padding: 20px; text-align: center;">
                                        <i class="fas fa-info-circle"></i> Nenhuma atividade disponível neste módulo.
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: var(--text-secondary);">Este curso ainda não possui módulos cadastrados.</p>
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
                <p style="text-align: center; color: var(--text-secondary);">Carregando atividade...</p>
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
        .then(response => response.text())
        .then(text => {
            console.log('Resposta da atividade:', text);
            const data = JSON.parse(text);
            if (data.success) {
                renderAtividade(data);
            } else {
                document.getElementById('modalBody').innerHTML =
                    '<p style="color: #fca5a5; text-align: center;"><i class="fas fa-exclamation-circle"></i> ' + data.message + '</p>';
            }
        })
        .catch(error => {
            console.error('Erro ao carregar atividade:', error);
            document.getElementById('modalBody').innerHTML =
                '<p style="color: #fca5a5; text-align: center;"><i class="fas fa-exclamation-circle"></i> Erro ao carregar atividade.</p>';
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
                html += '<p style="color: var(--text-secondary); margin-bottom: 20px;">' + data.atividade.descricao + '</p>';
            }

            // Informações de tentativas e status
            if (data.tentativas) {
                const tentativas = data.tentativas;
                if (!tentativas.pode_tentar) {
                    if (tentativas.horas_restantes) {
                        html += '<div class="result-badge error" style="background: rgba(239, 68, 68, 0.15); border-color: rgba(239, 68, 68, 0.3); color: #fca5a5;">';
                        html += '<i class="fas fa-clock"></i> Você já utilizou todas as 3 tentativas. Tente novamente em ' + tentativas.horas_restantes + ' hora(s).';
                        html += '</div>';
                    } else if (data.nota >= 100) {
                        html += '<div class="result-badge success" style="background: rgba(34, 197, 94, 0.15); border-color: rgba(34, 197, 94, 0.3); color: #86efac; margin-bottom: 15px;">';
                        html += '<i class="fas fa-check-circle"></i> Você acertou todas as questões! Não é possível refazer esta atividade.';
                        html += '</div>';
                    } else {
                        html += '<div class="result-badge error" style="background: rgba(239, 68, 68, 0.15); border-color: rgba(239, 68, 68, 0.3); color: #fca5a5;">';
                        html += '<i class="fas fa-ban"></i> Não é possível refazer esta atividade.';
                        html += '</div>';
                    }
                } else {
                    if (data.ja_fez) {
                        html += '<div class="result-badge" style="background: rgba(251, 191, 36, 0.15); border-color: rgba(251, 191, 36, 0.3); color: #fde047; margin-bottom: 15px;">';
                        html += '<i class="fas fa-redo"></i> Refazendo atividade - Você só ganhará recompensa pelas questões que corrigir.';
                        html += '</div>';
                    }
                    if (tentativas.tentativas_restantes > 0) {
                        html += '<div class="result-badge" style="background: rgba(59, 130, 246, 0.15); border-color: rgba(59, 130, 246, 0.3); color: #93c5fd; margin-bottom: 15px;">';
                        html += '<i class="fas fa-redo"></i> Tentativas restantes: ' + tentativas.tentativas_restantes + ' de 3';
                        html += '</div>';
                    }
                }
            }

            if (data.nota > 0) {
                html += '<div class="result-badge success"><i class="fas fa-check-circle"></i> Nota: ' + data.nota + '%</div>';
            }

            if (data.perguntas && data.perguntas.length > 0) {
                data.perguntas.forEach((pergunta, perguntaIndex) => {
                    html += '<div class="question-card">';
                    html += '<h3>' + (perguntaIndex + 1) + '. ' + pergunta.pergunta + '</h3>';

                    if (pergunta.opcoes && pergunta.opcoes.length > 0) {
                        pergunta.opcoes.forEach((opcao, opcaoIndex) => {
                            // Verifica se esta opção foi selecionada pelo usuário
                            const respostaUsuario = data.respostas_usuario[perguntaIndex];
                            const isSelected = respostaUsuario && respostaUsuario.opcao_index == opcaoIndex;
                            const selectedClass = isSelected ? 'selected' : '';

                            html += '<div class="option ' + selectedClass + '" onclick="selectOption(this, ' + perguntaIndex + ', ' + opcaoIndex + ')">';
                            html += '<input type="radio" name="pergunta_' + perguntaIndex + '" value="' + opcaoIndex + '" ' + (isSelected ? 'checked' : '') + '>';
                            html += '<span>' + opcao.texto + '</span>';
                            html += '</div>';
                        });
                    }

                    html += '</div>';
                });

                // Botão de envio - desabilitado se bloqueado
                const podeEnviar = data.tentativas && data.tentativas.pode_tentar !== false;
                const tentativasRestantes = data.tentativas ? data.tentativas.tentativas_restantes : 0;
                
                if (podeEnviar) {
                    html += '<button class="submit-btn" onclick="confirmarEnvio(' + data.atividade.id + ', ' + tentativasRestantes + ')"><i class="fas fa-paper-plane"></i> Enviar Respostas</button>';
                } else {
                    html += '<button class="submit-btn" style="opacity: 0.5; cursor: not-allowed;" disabled><i class="fas fa-lock"></i> Bloqueado - Aguarde ' + (data.tentativas ? data.tentativas.horas_restantes : 6) + ' hora(s)</button>';
                }
            } else {
                html += '<p style="color: var(--text-secondary); text-align: center;"><i class="fas fa-info-circle"></i> Esta atividade ainda não possui perguntas cadastradas.</p>';
            }

            document.getElementById('modalBody').innerHTML = html;
        }
        
        // Variáveis globais para o modal de confirmação
        let globalAtividadeId = null;
        let globalTentativasRestantes = 0;
        let globalRespostas = [];

        function confirmarEnvio(atividadeId, tentativasRestantes) {
            // Verificar se todas as perguntas foram respondidas
            const totalPerguntas = document.querySelectorAll('.question-card').length;
            const radios = document.querySelectorAll('#modalBody input[type="radio"]:checked');
            const respostasSelecionadas = radios.length;
            
            console.log('Verificando perguntas:', {
                totalPerguntas: totalPerguntas,
                respostasSelecionadas: respostasSelecionadas,
                atividadeId: atividadeId
            });
            
            if (respostasSelecionadas === 0) {
                alert('Por favor, responda pelo menos uma pergunta!');
                return;
            }
            
            // Preparar respostas para envio
            const respostas = [];
            radios.forEach(radio => {
                const perguntaIndex = parseInt(radio.name.replace('pergunta_', ''));
                const opcaoIndex = parseInt(radio.value);
                respostas.push({
                    pergunta_index: perguntaIndex,
                    opcao_index: opcaoIndex
                });
            });
            
            // Verificar se todas as perguntas foram respondidas (opcional - pode ser configurado)
            if (respostasSelecionadas < totalPerguntas) {
                const confirmar = confirm(`Você respondeu ${respostasSelecionadas} de ${totalPerguntas} perguntas.\n\nDeseja continuar mesmo assim?`);
                if (!confirmar) {
                    return;
                }
            }
            
            // Armazenar dados globalmente
            globalAtividadeId = atividadeId;
            globalTentativasRestantes = tentativasRestantes;
            globalRespostas = respostas;
            
            console.log('Dados armazenados globalmente:', {
                globalAtividadeId: globalAtividadeId,
                globalTentativasRestantes: globalTentativasRestantes,
                globalRespostas: globalRespostas
            });
            
            // Modal de confirmação estilizado
            // Preencher o modal com informações
            const modalBody = document.getElementById('confirmModalBody');
            modalBody.innerHTML = `
                <div class="confirm-info-item">
                    <i class="fas fa-question-circle"></i>
                    <span>Perguntas respondidas: <strong>${respostasSelecionadas} de ${totalPerguntas}</strong></span>
                </div>
                <div class="confirm-info-item">
                    <i class="fas fa-redo"></i>
                    <span>Tentativas restantes: <strong>${tentativasRestantes} de 3</strong></span>
                </div>
                <div class="confirm-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div class="confirm-warning-text">
                        Após 3 tentativas, você precisará aguardar 6 horas para tentar novamente.
                    </div>
                </div>
            `;
            
            // Mostrar o modal
            document.getElementById('customConfirmModal').classList.add('show');
        }
        
        function fecharConfirmModal() {
            document.getElementById('customConfirmModal').classList.remove('show');
            globalAtividadeId = null;
            globalTentativasRestantes = 0;
            globalRespostas = [];
        }
        
        function confirmarEnvioFinal() {
            console.log('Confirmando envio final:', {
                globalAtividadeId: globalAtividadeId,
                globalRespostas: globalRespostas,
                globalTentativasRestantes: globalTentativasRestantes
            });
            
            if (globalAtividadeId && globalRespostas.length > 0) {
                // Primeiro capturar os dados antes de limpar
                const atividadeId = globalAtividadeId;
                const respostas = [...globalRespostas]; // Criar cópia do array
                
                fecharConfirmModal(); // Limpar variáveis globais
                
                // Enviar com os dados capturados
                enviarRespostas(atividadeId, respostas);
            } else {
                console.error('Dados globais incompletos:', {
                    globalAtividadeId: globalAtividadeId,
                    globalRespostas: globalRespostas
                });
                alert('Erro: Dados da atividade não encontrados. Por favor, tente novamente.');
                return;
            }
        }

        function selectOption(element, perguntaIndex, opcaoIndex) {
            const questionCard = element.closest('.question-card');
            questionCard.querySelectorAll('.option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');
            element.querySelector('input[type="radio"]').checked = true;
        }

        function enviarRespostas(atividadeId, respostas) {
            console.log('Enviando respostas diretas:', {
                atividade_id: atividadeId,
                respostas: respostas,
                total_respostas: respostas.length,
                tipo_atividadeId: typeof atividadeId,
                valor_atividadeId: atividadeId
            });

            // Validação extra
            if (!atividadeId || atividadeId === null || atividadeId === undefined) {
                console.error('ERRO CRÍTICO: atividadeId é nulo!');
                alert('Erro: ID da atividade não pode ser nulo. Por favor, tente novamente.');
                return;
            }

            if (!respostas || respostas.length === 0) {
                console.error('ERRO CRÍTICO: respostas está vazio!');
                alert('Erro: Nenhuma resposta foi selecionada.');
                return;
            }

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
                console.log('Resposta do servidor:', data);
                if (data.success) {
                    // Fechar modal e recarregar sem alert de confirmação
                    closeAtividadeModal();
                    // Atualizar a página ou recarregar os dados
                    location.reload();
                } else {
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro ao enviar atividade:', error);
                alert('Erro ao enviar atividade. Por favor, tente novamente.');
            });
        }

        // Função wrapper para manter compatibilidade
        function submitAtividade(atividadeId) {
            const radios = document.querySelectorAll('#modalBody input[type="radio"]:checked');

            if (radios.length === 0) {
                alert('Por favor, responda pelo menos uma pergunta!');
                return;
            }

            const respostas = [];
            radios.forEach(radio => {
                const perguntaIndex = parseInt(radio.name.replace('pergunta_', ''));
                const opcaoIndex = parseInt(radio.value);
                respostas.push({
                    pergunta_index: perguntaIndex,
                    opcao_index: opcaoIndex
                });
            });

            enviarRespostas(atividadeId, respostas);
        }

        if (!window._atividadeModalClickHandlerAttached) {
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('atividadeModal');
                if (modal && event.target === modal) {
                    closeAtividadeModal();
                }
            });
            
            // Fechar modal de confirmação ao clicar fora
            window.addEventListener('click', function(event) {
                const confirmModal = document.getElementById('customConfirmModal');
                if (confirmModal && event.target === confirmModal) {
                    fecharConfirmModal();
                }
            });
            
            // Fechar modais com tecla ESC
            window.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const confirmModal = document.getElementById('customConfirmModal');
                    if (confirmModal && confirmModal.classList.contains('show')) {
                        fecharConfirmModal();
                    }
                    
                    const atividadeModal = document.getElementById('atividadeModal');
                    if (atividadeModal && atividadeModal.style.display === 'block') {
                        closeAtividadeModal();
                    }
                }
            });
            
            window._atividadeModalClickHandlerAttached = true;
        }

        // Função para marcar vídeo como assistido
      

      function marcarVideoComoAssistido(videoId) {
    const videoItem = document.querySelector(`.video-item[data-video-id="${videoId}"]`);
    const button = videoItem.querySelector('.btn-mark-watched');
    
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processando...';
    
    fetch('<?php echo BASE_PATH; ?>/marcar-video-assistido', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            video_id: videoId,
            progresso: 100
        })
    })
    .then(response => response.text())
    .then(text => {
        console.log('Resposta do servidor:', text);
        const data = JSON.parse(text);
        if (data.success) {
            const progressBadge = videoItem.querySelector('.video-progress-badge');
            progressBadge.className = 'video-progress-badge watched';
            progressBadge.innerHTML = '<i class="fas fa-check-circle"></i> Vídeo Assistido';
            
            button.className = 'btn-mark-watched watched';
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-check-circle"></i> Já Visualizado';
            
            // Atualizar progresso em tempo real
            atualizarProgresso();
        } else {
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-check"></i> Marcar como Visualizado';
            alert(data.message || 'Erro ao marcar vídeo como assistido.');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        button.disabled = false;
        button.innerHTML = '<i class="fas fa-check"></i> Marcar como Visualizado';
        alert('Erro ao processar. Tente novamente.');
    });
}

        // Função para atualizar progresso em tempo real
        function atualizarProgresso() {
            const cursoId = <?php echo $curso['id']; ?>;
            
            fetch(`<?php echo BASE_PATH; ?>/api/progresso/${cursoId}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.progresso !== undefined) {
                    const progressFill = document.querySelector('.progress-fill');
                    const progressText = document.querySelector('.progress-section p');
                    
                    if (progressFill) {
                        progressFill.style.width = data.progresso + '%';
                    }
                    
                    if (progressText) {
                        progressText.textContent = data.progresso + '% concluído';
                    }
                    
                    console.log('Progresso atualizado:', data.progresso + '%');
                }
            })
            .catch(error => {
                console.error('Erro ao atualizar progresso:', error);
            });
        }
    </script>
</body>
</html>