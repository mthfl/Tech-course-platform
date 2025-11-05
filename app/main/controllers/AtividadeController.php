<?php

require_once __DIR__ . '/../models/Atividade.php';
require_once __DIR__ . '/../models/Usuario.php';

class AtividadeController {
    
    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_PATH . '/login');
            exit;
        }
    }
    
    public function visualizar($id) {
        $atividadeModel = new Atividade();
        $atividade = $atividadeModel->buscarPorId($id);
        
        if (!$atividade) {
            $_SESSION['erro'] = 'Atividade não encontrada!';
            header('Location: ' . BASE_PATH . '/cursos');
            exit;
        }
        
        $questoes = $atividadeModel->buscarQuestoes($id);
        
        foreach ($questoes as &$questao) {
            $questao['alternativas'] = $atividadeModel->buscarAlternativas($questao['id']);
        }
        
        $nota = $atividadeModel->calcularNota($_SESSION['usuario_id'], $id);
        $recompensa = $atividadeModel->buscarRecompensa($id);
        $recompensa_recebida = $atividadeModel->verificarRecompensaRecebida($_SESSION['usuario_id'], $id);
        
        require_once __DIR__ . '/../views/atividades/visualizar.php';
    }
    
    public function responder() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método inválido']);
            exit;
        }
        
        $atividade_id = $_POST['atividade_id'] ?? 0;
        $questao_id = $_POST['questao_id'] ?? 0;
        $alternativa_id = $_POST['alternativa_id'] ?? 0;
        
        $atividadeModel = new Atividade();
        $correta = $atividadeModel->verificarResposta($questao_id, $alternativa_id);
        
        if ($atividadeModel->salvarResposta($_SESSION['usuario_id'], $atividade_id, $questao_id, $alternativa_id, $correta)) {
            $nota = $atividadeModel->calcularNota($_SESSION['usuario_id'], $atividade_id);
            
            if ($nota >= 70) {
                $recompensa = $atividadeModel->buscarRecompensa($atividade_id);
                
                if ($recompensa && !$atividadeModel->verificarRecompensaRecebida($_SESSION['usuario_id'], $atividade_id)) {
                    $usuarioModel = new Usuario();
                    
                    if ($recompensa['coins'] > 0) {
                        $usuarioModel->adicionarCoins($_SESSION['usuario_id'], $recompensa['coins']);
                        $_SESSION['usuario_coins'] += $recompensa['coins'];
                    }
                    
                    if ($recompensa['xp'] > 0) {
                        $usuarioModel->adicionarXP($_SESSION['usuario_id'], $recompensa['xp']);
                        $_SESSION['usuario_xp'] += $recompensa['xp'];
                    }
                    
                    $atividadeModel->registrarRecompensa($_SESSION['usuario_id'], $atividade_id, $recompensa['coins'], $recompensa['xp']);
                    
                    echo json_encode([
                        'success' => true,
                        'correta' => $correta,
                        'nota' => $nota,
                        'recompensa' => $recompensa
                    ]);
                    exit;
                }
            }
            
            echo json_encode([
                'success' => true,
                'correta' => $correta,
                'nota' => $nota
            ]);
            exit;
        }
        
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar resposta']);
        exit;
    }
}
