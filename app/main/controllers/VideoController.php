<?php

require_once __DIR__ . '/../models/Video.php';
require_once __DIR__ . '/../models/Usuario.php';

class VideoController {
    
    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_PATH . '/login');
            exit;
        }
    }
    
    public function assistir($id) {
        $videoModel = new Video();
        $video = $videoModel->buscarPorId($id);
        
        if (!$video) {
            $_SESSION['erro'] = 'Vídeo não encontrado!';
            header('Location: ' . BASE_PATH . '/cursos');
            exit;
        }
        
        $progresso = $videoModel->verificarSeAssistido($_SESSION['usuario_id'], $id);
        $recompensa = $videoModel->buscarRecompensa($id);
        $recompensa_recebida = $videoModel->verificarRecompensaRecebida($_SESSION['usuario_id'], $id);
        
        require_once __DIR__ . '/../views/videos/assistir.php';
    }
    
    public function marcarAssistido() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método inválido']);
            exit;
        }
        
        $video_id = $_POST['video_id'] ?? 0;
        $progresso = $_POST['progresso'] ?? 100;
        
        $videoModel = new Video();
        
        if ($videoModel->marcarComoAssistido($_SESSION['usuario_id'], $video_id, $progresso)) {
            if ($progresso >= 90) {
                $recompensa = $videoModel->buscarRecompensa($video_id);
                
                if ($recompensa && !$videoModel->verificarRecompensaRecebida($_SESSION['usuario_id'], $video_id)) {
                    $usuarioModel = new Usuario();
                    
                    if ($recompensa['coins'] > 0) {
                        $usuarioModel->adicionarCoins($_SESSION['usuario_id'], $recompensa['coins']);
                        $_SESSION['usuario_coins'] += $recompensa['coins'];
                    }
                    
                    if ($recompensa['xp'] > 0) {
                        $usuarioModel->adicionarXP($_SESSION['usuario_id'], $recompensa['xp']);
                        $_SESSION['usuario_xp'] += $recompensa['xp'];
                    }
                    
                    $videoModel->registrarRecompensa($_SESSION['usuario_id'], $video_id, $recompensa['coins'], $recompensa['xp']);
                    
                    echo json_encode([
                        'success' => true, 
                        'message' => 'Vídeo marcado como assistido!',
                        'recompensa' => $recompensa
                    ]);
                    exit;
                }
            }
            
            echo json_encode(['success' => true, 'message' => 'Progresso salvo!']);
            exit;
        }
        
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar progresso']);
        exit;
    }
}
