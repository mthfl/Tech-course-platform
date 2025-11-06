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

    public function listar() {
        $atividadeModel = new Atividade();
        $atividades = $atividadeModel->buscarAtividadesDoUsuario($_SESSION['usuario_id']);

        require_once __DIR__ . '/../views/atividades/listar.php';
    }
    
    public function visualizar($id) {
        $atividadeModel = new Atividade();
        $atividade = $atividadeModel->buscarPorId($id);
        
        if (!$atividade) {
            $_SESSION['erro'] = 'Atividade não encontrada!';
            header('Location: ' . BASE_PATH . '/dashboard');
            exit;
        }
        
        // Buscar perguntas e opções
        $perguntas = $atividadeModel->buscarQuestoes($id);
        if (!$perguntas) {
            $perguntas = [];
        }
        
        foreach ($perguntas as &$pergunta) {
            $pergunta['opcoes'] = $atividadeModel->buscarAlternativas($pergunta['id']);
            if (!$pergunta['opcoes']) {
                $pergunta['opcoes'] = [];
            }
        }
        
        // Buscar respostas já dadas pelo usuário
        $respostas_usuario = $atividadeModel->verificarRespostasUsuario($_SESSION['usuario_id'], $id);
        if (!$respostas_usuario) {
            $respostas_usuario = [];
        }
        
        // Calcular nota atual
        $nota = $atividadeModel->calcularNota($_SESSION['usuario_id'], $id);
        if ($nota === null) {
            $nota = 0;
        }
        
        // Buscar informações de recompensa
        $recompensa = $atividadeModel->buscarRecompensa($id);
        if (!$recompensa) {
            $recompensa = false;
        }
        $recompensa_recebida = $atividadeModel->verificarRecompensaRecebida($_SESSION['usuario_id'], $id);
        
        // Verificar acesso ao curso
        require_once __DIR__ . '/../models/Curso.php';
        $cursoModel = new Curso();
        
        // Buscar módulo para verificar acesso
        $query = "SELECT m.curso_id FROM modulos m 
                  INNER JOIN atividades a ON m.id = a.modulo_id 
                  WHERE a.id = :atividade_id LIMIT 1";
        $stmt = $atividadeModel->getConnection()->prepare($query);
        $stmt->bindParam(':atividade_id', $id);
        $stmt->execute();
        $modulo = $stmt->fetch();
        
        $tem_acesso = false;
        if ($modulo) {
            $tem_acesso = $cursoModel->verificarAcesso($_SESSION['usuario_id'], $modulo['curso_id']);
        }
        
        if (!$tem_acesso) {
            $_SESSION['erro'] = 'Você não tem acesso a esta atividade. Adquira o curso primeiro!';
            header('Location: ' . BASE_PATH . '/dashboard');
            exit;
        }
        
        require_once __DIR__ . '/../views/atividades/visualizar.php';
    }
    
    public function responder() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método inválido']);
            exit;
        }
        
        $atividade_id = $_POST['atividade_id'] ?? 0;
        $pergunta_id = $_POST['pergunta_id'] ?? 0;
        $opcao_id = $_POST['opcao_id'] ?? null;
        $resposta_texto = $_POST['resposta_texto'] ?? null;
        
        if (!$pergunta_id || (!$opcao_id && !$resposta_texto)) {
            echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
            exit;
        }
        
        $atividadeModel = new Atividade();
        
        // Verificar se a resposta está correta
        $correta = 0;
        if ($opcao_id) {
            $correta = $atividadeModel->verificarResposta($pergunta_id, $opcao_id);
        }
        
        // Salvar resposta
        if ($atividadeModel->salvarResposta($_SESSION['usuario_id'], $atividade_id, $pergunta_id, $opcao_id, $correta, $resposta_texto)) {
            $nota = $atividadeModel->calcularNota($_SESSION['usuario_id'], $atividade_id);
            
            // Verificar se todas as perguntas foram respondidas
            $perguntas = $atividadeModel->buscarQuestoes($atividade_id);
            $respostas_usuario = $atividadeModel->verificarRespostasUsuario($_SESSION['usuario_id'], $atividade_id);
            $todas_respondidas = count($respostas_usuario) >= count($perguntas);
            
            // Se todas as perguntas foram respondidas e nota >= 70, dar recompensa
            if ($todas_respondidas && $nota >= 70) {
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
                        'correta' => (bool)$correta,
                        'nota' => $nota,
                        'recompensa' => $recompensa,
                        'todas_respondidas' => true
                    ]);
                    exit;
                }
            }
            
            echo json_encode([
                'success' => true,
                'correta' => (bool)$correta,
                'nota' => $nota,
                'todas_respondidas' => $todas_respondidas
            ]);
            exit;
        }
        
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar resposta']);
        exit;
    }
}
