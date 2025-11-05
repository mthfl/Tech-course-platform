<?php

require_once __DIR__ . '/../models/Curso.php';
require_once __DIR__ . '/../models/Usuario.php';

class CursoController {
    
    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_PATH . '/login');
            exit;
        }
    }
    
    public function index() {
        $cursoModel = new Curso();
        $cursos = $cursoModel->listarTodos($_SESSION['usuario_nivel']);
        
        require_once __DIR__ . '/../views/cursos/index.php';
    }
    
    public function detalhes($id) {
        $cursoModel = new Curso();
        $curso = $cursoModel->buscarPorId($id);
        
        if (!$curso) {
            $_SESSION['erro'] = 'Curso não encontrado!';
            header('Location: ' . BASE_PATH . '/cursos');
            exit;
        }
        
        $modulos = $cursoModel->buscarModulos($id);
        $tem_acesso = $cursoModel->verificarAcesso($_SESSION['usuario_id'], $id);
        $progresso = 0;
        
        if ($tem_acesso) {
            $progresso = $cursoModel->calcularProgresso($_SESSION['usuario_id'], $id);
        }
        
        require_once __DIR__ . '/../views/cursos/detalhes.php';
    }
    
    public function comprar($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_PATH . '/curso/' . $id);
            exit;
        }
        
        $cursoModel = new Curso();
        $curso = $cursoModel->buscarPorId($id);
        
        if (!$curso) {
            $_SESSION['erro'] = 'Curso não encontrado!';
            header('Location: ' . BASE_PATH . '/cursos');
            exit;
        }
        
        if ($cursoModel->verificarAcesso($_SESSION['usuario_id'], $id)) {
            $_SESSION['erro'] = 'Você já possui este curso!';
            header('Location: ' . BASE_PATH . '/curso/' . $id);
            exit;
        }
        
        if ($_SESSION['usuario_coins'] < $curso['preco_coins']) {
            $_SESSION['erro'] = 'Você não tem coins suficientes!';
            header('Location: ' . BASE_PATH . '/curso/' . $id);
            exit;
        }
        
        $usuarioModel = new Usuario();
        
        if ($usuarioModel->removerCoins($_SESSION['usuario_id'], $curso['preco_coins'])) {
            if ($cursoModel->comprarCurso($_SESSION['usuario_id'], $id, $curso['preco_coins'])) {
                $_SESSION['usuario_coins'] -= $curso['preco_coins'];
                $_SESSION['sucesso'] = 'Curso comprado com sucesso!';
                header('Location: ' . BASE_PATH . '/curso/' . $id);
                exit;
            }
        }
        
        $_SESSION['erro'] = 'Erro ao comprar curso. Tente novamente!';
        header('Location: ' . BASE_PATH . '/curso/' . $id);
        exit;
    }
    
    public function meusCursos() {
        $cursoModel = new Curso();
        $cursos = $cursoModel->buscarCursosComprados($_SESSION['usuario_id']);
        
        require_once __DIR__ . '/../views/cursos/meus-cursos.php';
    }
}
