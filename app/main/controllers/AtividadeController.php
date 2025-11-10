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
        header('Content-Type: application/json');

        $atividadeModel = new Atividade();
        $atividade = $atividadeModel->buscarPorId($id);

        if (!$atividade) {
            echo json_encode(['success' => false, 'message' => 'Atividade não encontrada!']);
            exit;
        }

        // Verificar acesso ao curso
        require_once __DIR__ . '/../models/Curso.php';
        $cursoModel = new Curso();

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
            echo json_encode(['success' => false, 'message' => 'Você não tem acesso a esta atividade!']);
            exit;
        }

        // Buscar perguntas e opções (já vêm do JSON)
        $perguntas = $atividadeModel->buscarQuestoes($id);
        if (!$perguntas) {
            $perguntas = [];
        }

        // As opções já estão dentro de cada pergunta no JSON
        // Não precisa buscar separadamente

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
        
        // Verificar tentativas disponíveis
        $tentativas_info = $atividadeModel->verificarTentativas($_SESSION['usuario_id'], $id);
        
        // Verifica se já fez a atividade
        $ja_fez = !empty($respostas_usuario);

        echo json_encode([
            'success' => true,
            'atividade' => $atividade,
            'perguntas' => $perguntas,
            'respostas_usuario' => $respostas_usuario,
            'nota' => $nota,
            'recompensa' => $recompensa,
            'recompensa_recebida' => $recompensa_recebida,
            'tentativas' => $tentativas_info,
            'ja_fez' => $ja_fez
        ]);
        exit;
    }
    
    public function responder() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Método inválido']);
            exit;
        }
        
        header('Content-Type: application/json');
        
        // Recebe dados via JSON ou POST
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        if (!$data) {
            $data = $_POST;
        }
        
        $atividade_id = $data['atividade_id'] ?? 0;
        $respostas = $data['respostas'] ?? [];
        
        if (!$atividade_id || empty($respostas)) {
            echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
            exit;
        }
        
        $atividadeModel = new Atividade();
        
        // Verifica se pode tentar
        $tentativas_info = $atividadeModel->verificarTentativas($_SESSION['usuario_id'], $atividade_id);
        
        if (!$tentativas_info['pode_tentar']) {
            $horas_restantes = isset($tentativas_info['horas_restantes']) ? $tentativas_info['horas_restantes'] : 6;
            echo json_encode([
                'success' => false, 
                'message' => 'Você já utilizou todas as 3 tentativas. Tente novamente em ' . $horas_restantes . ' hora(s).',
                'bloqueado' => true,
                'tentativas' => $tentativas_info
            ]);
            exit;
        }
        
        // Salvar todas as respostas de uma vez
        if ($atividadeModel->salvarResposta($_SESSION['usuario_id'], $atividade_id, $respostas)) {
            $nota = $atividadeModel->calcularNota($_SESSION['usuario_id'], $atividade_id);
            
            // Atualiza informações de tentativas após salvar
            $tentativas_info = $atividadeModel->verificarTentativas($_SESSION['usuario_id'], $atividade_id);
            
            // Verificar se todas as perguntas foram respondidas
            $perguntas = $atividadeModel->buscarQuestoes($atividade_id);
            $respostas_usuario = $atividadeModel->verificarRespostasUsuario($_SESSION['usuario_id'], $atividade_id);
            $total_perguntas = count($perguntas);
            $total_respostas = count($respostas_usuario);
            // Verifica se todas as perguntas foram respondidas (todas as respostas foram enviadas)
            // Como acabamos de salvar, todas as perguntas devem ter sido respondidas
            $todas_respondidas = $total_respostas >= $total_perguntas && $total_perguntas > 0;
            
            // Verifica se é primeira vez ou refazendo
            $ja_recebeu_recompensa = $atividadeModel->verificarRecompensaRecebida($_SESSION['usuario_id'], $atividade_id);
            $recompensa_recebida = false;
            $recompensa_valor = null;
            
            // Busca a recompensa da atividade
            $recompensa = $atividadeModel->buscarRecompensa($atividade_id);
            
            // Se todas as perguntas foram respondidas e nota >= 70
            // IMPORTANTE: A recompensa só é dada se nota >= 70
            if ($todas_respondidas && $nota >= 70 && $recompensa) {
                if (!$ja_recebeu_recompensa) {
                    // Primeira vez - recebe recompensa completa
                    if ($recompensa['coins'] > 0 || $recompensa['xp'] > 0) {
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
                        $recompensa_recebida = true;
                        $recompensa_valor = $recompensa;
                    }
                } else {
                    // Refazendo - calcula recompensa proporcional apenas para questões corrigidas
                    $recompensa_proporcional = $atividadeModel->calcularRecompensaProporcional($_SESSION['usuario_id'], $atividade_id, $respostas);
                    
                    if ($recompensa_proporcional['coins'] > 0 || $recompensa_proporcional['xp'] > 0) {
                        $usuarioModel = new Usuario();
                        
                        if ($recompensa_proporcional['coins'] > 0) {
                            $usuarioModel->adicionarCoins($_SESSION['usuario_id'], $recompensa_proporcional['coins']);
                            $_SESSION['usuario_coins'] += $recompensa_proporcional['coins'];
                        }
                        
                        if ($recompensa_proporcional['xp'] > 0) {
                            $usuarioModel->adicionarXP($_SESSION['usuario_id'], $recompensa_proporcional['xp']);
                            $_SESSION['usuario_xp'] += $recompensa_proporcional['xp'];
                        }
                        
                        // Registra transação separada para recompensa proporcional
                        $atividadeModel->registrarRecompensa($_SESSION['usuario_id'], $atividade_id, $recompensa_proporcional['coins'], $recompensa_proporcional['xp']);
                        $recompensa_recebida = true;
                        $recompensa_valor = [
                            'coins' => $recompensa_proporcional['coins'],
                            'xp' => $recompensa_proporcional['xp'],
                            'questoes_corrigidas' => $recompensa_proporcional['questoes_corrigidas'],
                            'total_perguntas' => $recompensa_proporcional['total_perguntas']
                        ];
                    }
                }
                
                // Verifica se o curso foi concluído após esta atividade
                require_once __DIR__ . '/../models/Curso.php';
                $cursoModel = new Curso();
                
                // Busca o curso_id da atividade
                $query = "SELECT m.curso_id FROM modulos m
                          INNER JOIN atividades a ON m.id = a.modulo_id
                          WHERE a.id = :atividade_id LIMIT 1";
                $stmt = $atividadeModel->getConnection()->prepare($query);
                $stmt->bindParam(':atividade_id', $atividade_id);
                $stmt->execute();
                $modulo = $stmt->fetch();
                
                $curso_concluido = false;
                if ($modulo) {
                    $curso_concluido = $cursoModel->verificarEConceberRecompensaConclusao($_SESSION['usuario_id'], $modulo['curso_id']);
                    
                    // Atualiza sessão se curso foi concluído
                    if ($curso_concluido) {
                        $usuarioModel = new Usuario();
                        $usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);
                        if ($usuario) {
                            $_SESSION['usuario_coins'] = $usuario['coins'];
                            $_SESSION['usuario_xp'] = $usuario['xp_total'];
                            $_SESSION['usuario_nivel'] = $usuario['nivel_conta'];
                        }
                    }
                }
                
                echo json_encode([
                    'success' => true,
                    'nota' => $nota,
                    'recompensa' => $recompensa_valor,
                    'recompensa_recebida' => $recompensa_recebida,
                    'todas_respondidas' => true,
                    'curso_concluido' => $curso_concluido,
                    'novo_saldo_coins' => $_SESSION['usuario_coins'],
                    'novo_xp' => $_SESSION['usuario_xp'],
                    'tentativas' => $tentativas_info
                ]);
                exit;
            }
            
            echo json_encode([
                'success' => true,
                'nota' => $nota,
                'todas_respondidas' => $todas_respondidas,
                'tentativas' => $tentativas_info,
                'recompensa' => $recompensa_valor,
                'recompensa_recebida' => $recompensa_recebida
            ]);
            exit;
        }
        
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar resposta']);
        exit;
    }
}
