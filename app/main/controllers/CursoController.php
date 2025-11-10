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
        $cursos = $cursoModel->listarTodos($_SESSION['usuario_nivel'], $_SESSION['usuario_id']);

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
            
            // Verifica se concluiu 100% e concede recompensa se necessário
            if ($progresso >= 100) {
                $recompensa = $cursoModel->concederRecompensaConclusao($_SESSION['usuario_id'], $id);
                if ($recompensa && is_array($recompensa)) {
                    // Atualiza a sessão com os novos valores
                    $usuarioModel = new Usuario();
                    $usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);
                    if ($usuario) {
                        $_SESSION['usuario_coins'] = $usuario['coins'];
                        $_SESSION['usuario_xp'] = $usuario['xp_total'];
                        $_SESSION['usuario_nivel'] = $usuario['nivel_conta'];
                    }
                    
                    // Mostra mensagem de sucesso se recebeu recompensa agora
                    if (!isset($_SESSION['recompensa_conclusao_' . $id])) {
                        $_SESSION['sucesso'] = 'Parabéns! Você concluiu 100% do curso e ganhou ' . $recompensa['coins'] . ' coins e ' . $recompensa['xp'] . ' XP de bônus!';
                        $_SESSION['recompensa_conclusao_' . $id] = true;
                    }
                }
            }
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
        
        // Verifica se o usuário tem nível suficiente para o curso
        if (!$cursoModel->verificarAcessoNivel($_SESSION['usuario_nivel'], $curso['nivel_requerido'])) {
            $_SESSION['erro'] = 'Você não tem nível suficiente para este curso! Você precisa ser nível ' . ucfirst($curso['nivel_requerido']) . ' ou superior.';
            header('Location: ' . BASE_PATH . '/curso/' . $id);
            exit;
        }
        
        if ($cursoModel->verificarAcesso($_SESSION['usuario_id'], $id)) {
            $_SESSION['erro'] = 'Você já possui este curso!';
            header('Location: ' . BASE_PATH . '/curso/' . $id);
            exit;
        }
        
        // Verifica se concluiu o curso anterior (se houver)
        if (!$cursoModel->verificarCursoAnteriorConcluido($_SESSION['usuario_id'], $id)) {
            // Busca informações do curso anterior
            $curso_anterior = $cursoModel->buscarCursoAnterior($id);
            
            if ($curso_anterior) {
                $tem_acesso_anterior = $cursoModel->verificarAcesso($_SESSION['usuario_id'], $curso_anterior['id']);
                if ($tem_acesso_anterior) {
                    // Verifica o progresso do curso anterior
                    $progresso_anterior = $cursoModel->calcularProgresso($_SESSION['usuario_id'], $curso_anterior['id']);
                    $_SESSION['erro'] = 'Você precisa concluir 100% do curso "' . htmlspecialchars($curso_anterior['titulo']) . '" antes de comprar este curso! Seu progresso atual: ' . round($progresso_anterior, 1) . '%.';
                } else {
                    $_SESSION['erro'] = 'Você precisa comprar e concluir o curso "' . htmlspecialchars($curso_anterior['titulo']) . '" antes de comprar este curso!';
                }
            } else {
                // Não há curso anterior (é o primeiro curso), mas a verificação falhou
                // Isso não deveria acontecer, mas permite a compra por segurança
                // Não bloqueia a compra se não há curso anterior
            }
            
            // Se há um curso anterior e a verificação falhou, bloqueia a compra
            if ($curso_anterior) {
                header('Location: ' . BASE_PATH . '/curso/' . $id);
                exit;
            }
        }
        
        if ($_SESSION['usuario_coins'] < $curso['preco_coins']) {
            $_SESSION['erro'] = 'Você não tem coins suficientes! Você precisa de ' . $curso['preco_coins'] . ' coins, mas tem apenas ' . $_SESSION['usuario_coins'] . ' coins.';
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
