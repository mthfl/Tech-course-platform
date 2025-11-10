<?php

require_once __DIR__ . '/../models/Video.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Curso.php';

class VideoController {
    
    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_PATH . '/login');
            exit;
        }
    }
    
    public function assistir($id) {
        $videoModel = new Video();
        $cursoModel = new Curso();
        
        // Busca vídeo com informações do módulo e curso
        $video = $videoModel->buscarComModuloECurso($id);
        
        if (!$video) {
            $_SESSION['erro'] = 'Vídeo não encontrado!';
            header('Location: ' . BASE_PATH . '/cursos');
            exit;
        }
        
        // Verifica se o usuário tem acesso ao curso
        $tem_acesso = $cursoModel->verificarAcesso($_SESSION['usuario_id'], $video['curso_id']);
        
        if (!$tem_acesso) {
            $_SESSION['erro'] = 'Você não tem acesso a este curso!';
            header('Location: ' . BASE_PATH . '/curso/' . $video['curso_id']);
            exit;
        }
        
        // Busca informações adicionais
        $progresso = $videoModel->verificarSeAssistido($_SESSION['usuario_id'], $id);
        $recompensa = $videoModel->buscarRecompensa($id);
        $recompensa_recebida = $videoModel->verificarRecompensaRecebida($_SESSION['usuario_id'], $id);
        
        // Busca vídeos do módulo para navegação
        $videos_modulo = $videoModel->buscarVideosDoModulo($video['modulo_id']);
        $proximo_video = $videoModel->buscarProximoVideo($video['modulo_id'], $video['ordem']);
        $video_anterior = $videoModel->buscarVideoAnterior($video['modulo_id'], $video['ordem']);
        
        // Busca informações do curso
        $curso = $cursoModel->buscarPorId($video['curso_id']);
        
        require_once __DIR__ . '/../views/videos/assistir.php';
    }
    
    public function visualizar($id) {
        header('Content-Type: application/json');
        
        $videoModel = new Video();
        $cursoModel = new Curso();
        
        // Busca vídeo com informações do módulo e curso
        $video = $videoModel->buscarComModuloECurso($id);
        
        if (!$video) {
            echo json_encode(['success' => false, 'message' => 'Vídeo não encontrado!']);
            exit;
        }
        
        // Verifica se o usuário tem acesso ao curso
        $tem_acesso = $cursoModel->verificarAcesso($_SESSION['usuario_id'], $video['curso_id']);
        
        if (!$tem_acesso) {
            echo json_encode(['success' => false, 'message' => 'Você não tem acesso a este curso!']);
            exit;
        }
        
        // Busca informações adicionais
        $progresso = $videoModel->verificarSeAssistido($_SESSION['usuario_id'], $id);
        $recompensa = $videoModel->buscarRecompensa($id);
        $recompensa_recebida = $videoModel->verificarRecompensaRecebida($_SESSION['usuario_id'], $id);
        
        // Busca vídeos do módulo para navegação
        $videos_modulo = $videoModel->buscarVideosDoModulo($video['modulo_id']);
        $proximo_video = $videoModel->buscarProximoVideo($video['modulo_id'], $video['ordem']);
        $video_anterior = $videoModel->buscarVideoAnterior($video['modulo_id'], $video['ordem']);
        
        echo json_encode([
            'success' => true,
            'video' => $video,
            'progresso' => $progresso,
            'recompensa' => $recompensa,
            'recompensa_recebida' => $recompensa_recebida,
            'proximo_video' => $proximo_video,
            'video_anterior' => $video_anterior,
            'videos_modulo' => $videos_modulo
        ]);
        exit;
    }
    
    public function marcarAssistido() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método inválido']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $video_id = $data['video_id'] ?? $_POST['video_id'] ?? 0;
        $progresso = $data['progresso'] ?? $_POST['progresso'] ?? 100;
        
        $videoModel = new Video();
        
        if ($videoModel->marcarComoAssistido($_SESSION['usuario_id'], $video_id, $progresso)) {
            $response = [
                'success' => true, 
                'message' => 'Vídeo marcado como assistido!'
            ];
            
            if ($progresso >= 90) {
                $recompensa = $videoModel->buscarRecompensa($video_id);
                
                if ($recompensa && ($recompensa['coins'] > 0 || $recompensa['xp'] > 0)) {
                    $recompensa_recebida = $videoModel->verificarRecompensaRecebida($_SESSION['usuario_id'], $video_id);
                    
                    if (!$recompensa_recebida) {
                        $usuarioModel = new Usuario();
                        
                        // Atualiza coins se houver
                        if ($recompensa['coins'] > 0) {
                            $usuarioModel->adicionarCoins($_SESSION['usuario_id'], $recompensa['coins']);
                            $_SESSION['usuario_coins'] += $recompensa['coins'];
                        }
                        
                        // Atualiza XP se houver
                        if ($recompensa['xp'] > 0) {
                            $usuarioModel->adicionarXP($_SESSION['usuario_id'], $recompensa['xp']);
                            $_SESSION['usuario_xp'] += $recompensa['xp'];
                            
                            // Atualiza o nível do usuário na sessão se necessário
                            $usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);
                            if ($usuario && $usuario['nivel_conta'] != $_SESSION['usuario_nivel']) {
                                $_SESSION['usuario_nivel'] = $usuario['nivel_conta'];
                            }
                        }
                        
                        // Registra a recompensa
                        $videoModel->registrarRecompensa($_SESSION['usuario_id'], $video_id, $recompensa['coins'], $recompensa['xp']);
                        
                        // Verifica se o curso foi concluído após assistir este vídeo
                        $video_info = $videoModel->buscarComModuloECurso($video_id);
                        if ($video_info && isset($video_info['curso_id'])) {
                            $cursoModel = new Curso();
                            $curso_concluido = $cursoModel->verificarEConceberRecompensaConclusao($_SESSION['usuario_id'], $video_info['curso_id']);
                            
                            // Atualiza sessão se curso foi concluído
                            if ($curso_concluido) {
                                $usuarioModel = new Usuario();
                                $usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);
                                if ($usuario) {
                                    $_SESSION['usuario_coins'] = $usuario['coins'];
                                    $_SESSION['usuario_xp'] = $usuario['xp_total'];
                                    $_SESSION['usuario_nivel'] = $usuario['nivel_conta'];
                                    $response['novo_saldo_coins'] = $_SESSION['usuario_coins'];
                                    $response['novo_xp'] = $_SESSION['usuario_xp'];
                                    $response['curso_concluido'] = true;
                                }
                            }
                        }
                        
                        $response['recompensa'] = $recompensa;
                        $response['recompensa_recebida'] = true;
                        if (!isset($response['novo_saldo_coins'])) {
                            $response['novo_saldo_coins'] = $_SESSION['usuario_coins'];
                        }
                        if (!isset($response['novo_xp'])) {
                            $response['novo_xp'] = $_SESSION['usuario_xp'];
                        }
                    } else {
                        // Já recebeu a recompensa anteriormente
                        $response['recompensa'] = $recompensa;
                        $response['recompensa_recebida'] = true;
                    }
                }
            }
            
            echo json_encode($response);
            exit;
        }
        
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar progresso']);
        exit;
    }
}
