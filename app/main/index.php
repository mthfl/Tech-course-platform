<?php

session_start();

// Detecta automaticamente o caminho base baseado no diretório do script
$script_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
$script_path = str_replace('\\', '/', $script_path); // Normaliza para Unix-style
define('BASE_PATH', $script_path);
define('APP_NAME', 'Tech Course Platform');

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/DashboardController.php';
require_once __DIR__ . '/controllers/CursoController.php';
require_once __DIR__ . '/controllers/VideoController.php';
require_once __DIR__ . '/controllers/AtividadeController.php';

$request_uri = $_SERVER['REQUEST_URI'];

// Remove o caminho base da URI
$path = str_replace(BASE_PATH, '', $request_uri);
// Remove query string
$path = strtok($path, '?');
// Remove barras do início e fim
$path = trim($path, '/');

$segments = explode('/', $path);
$route = $segments[0] ?? '';
$param = $segments[1] ?? null;

switch ($route) {
    case '':
    case 'login':
        if (isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_PATH . '/dashboard');
            exit;
        }
        $controller = new AuthController();
        $controller->login();
        break;
        
    case 'registro':
        if (isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_PATH . '/dashboard');
            exit;
        }
        $controller = new AuthController();
        $controller->registro();
        break;
        
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case 'dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;
        
    case 'cursos':
        $controller = new CursoController();
        $controller->index();
        break;
        
    case 'curso':
        if ($param) {
            $controller = new CursoController();
            $controller->detalhes($param);
        } else {
            header('Location: ' . BASE_PATH . '/cursos');
        }
        break;
        
    case 'comprar-curso':
        if ($param) {
            $controller = new CursoController();
            $controller->comprar($param);
        } else {
            header('Location: ' . BASE_PATH . '/cursos');
        }
        break;
        
    case 'meus-cursos':
        $controller = new CursoController();
        $controller->meusCursos();
        break;
        
    case 'video':
        if ($param) {
            $controller = new VideoController();
            $controller->assistir($param);
        } else {
            header('Location: ' . BASE_PATH . '/cursos');
        }
        break;
        
    case 'marcar-video-assistido':
        $controller = new VideoController();
        $controller->marcarAssistido();
        break;
        
    case 'atividades':
        $controller = new AtividadeController();
        $controller->listar();
        break;

    case 'atividade':
        if ($param) {
            $controller = new AtividadeController();
            $controller->visualizar($param);
        } else {
            header('Location: ' . BASE_PATH . '/cursos');
        }
        break;
        
    case 'responder-atividade':
        $controller = new AtividadeController();
        $controller->responder();
        break;
        
    default:
        header('HTTP/1.0 404 Not Found');
        echo '<!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>404 - Página não encontrada</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                }
                .error-container {
                    text-align: center;
                }
                h1 {
                    font-size: 72px;
                    margin: 0;
                }
                p {
                    font-size: 24px;
                }
                a {
                    color: white;
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class="error-container">
                <h1>404</h1>
                <p>Página não encontrada</p>
                <a href="' . BASE_PATH . '/dashboard">Voltar ao início</a>
            </div>
        </body>
        </html>';
        break;
}