<?php

require_once __DIR__ . '/../config/Database.php';

class Atividade {
    private $conn;
    private $table = 'atividades';
    
    public $id;
    public $modulo_id;
    public $titulo;
    public $descricao;
    public $tipo;
    public $ordem;
    
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function buscarPorModulo($modulo_id) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE modulo_id = :modulo_id AND ativo = 1 
                  ORDER BY ordem ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':modulo_id', $modulo_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function buscarPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function buscarQuestoes($atividade_id) {
        $query = "SELECT * FROM perguntas WHERE atividade_id = :atividade_id ORDER BY ordem ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->execute();
        
        $result = $stmt->fetchAll();
        return $result !== false ? $result : [];
    }
    
    public function buscarAlternativas($pergunta_id) {
        $query = "SELECT * FROM opcoes_pergunta WHERE pergunta_id = :pergunta_id ORDER BY id ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pergunta_id', $pergunta_id);
        $stmt->execute();
        
        $result = $stmt->fetchAll();
        return $result !== false ? $result : [];
    }
    
    public function verificarResposta($pergunta_id, $opcao_id) {
        $query = "SELECT correta FROM opcoes_pergunta 
                  WHERE id = :opcao_id AND pergunta_id = :pergunta_id 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':opcao_id', $opcao_id);
        $stmt->bindParam(':pergunta_id', $pergunta_id);
        $stmt->execute();
        
        $result = $stmt->fetch();
        return $result ? (int)$result['correta'] : 0;
    }
    
    public function salvarResposta($usuario_id, $atividade_id, $pergunta_id, $opcao_id = null, $correta = 0, $resposta_texto = null) {
        // Verifica se já existe uma resposta para esta pergunta
        $query = "SELECT id FROM respostas_usuarios 
                  WHERE usuario_id = :usuario_id AND pergunta_id = :pergunta_id 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':pergunta_id', $pergunta_id);
        $stmt->execute();
        $existe = $stmt->fetch();
        
        if ($existe) {
            // Atualiza resposta existente
            $query = "UPDATE respostas_usuarios 
                      SET opcao_escolhida_id = :opcao_id, 
                          resposta_texto = :resposta_texto, 
                          pontuacao = :pontuacao,
                          data_resposta = NOW()
                      WHERE id = :id";
            
            $pontuacao = $correta ? 1.00 : 0.00;
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':opcao_id', $opcao_id);
            $stmt->bindParam(':resposta_texto', $resposta_texto);
            $stmt->bindParam(':pontuacao', $pontuacao);
            $stmt->bindParam(':id', $existe['id']);
            
            return $stmt->execute();
        } else {
            // Insere nova resposta
            $pontuacao = $correta ? 1.00 : 0.00;
            
            $query = "INSERT INTO respostas_usuarios 
                      (usuario_id, pergunta_id, opcao_escolhida_id, resposta_texto, pontuacao) 
                      VALUES (:usuario_id, :pergunta_id, :opcao_id, :resposta_texto, :pontuacao)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':pergunta_id', $pergunta_id);
            $stmt->bindParam(':opcao_id', $opcao_id);
            $stmt->bindParam(':resposta_texto', $resposta_texto);
            $stmt->bindParam(':pontuacao', $pontuacao);
            
            return $stmt->execute();
        }
    }
    
    public function calcularNota($usuario_id, $atividade_id) {
        $query = "SELECT COUNT(*) as total FROM perguntas WHERE atividade_id = :atividade_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->execute();
        $total = $stmt->fetch();
        
        $query = "SELECT SUM(pontuacao) as total_pontos FROM respostas_usuarios 
                  WHERE usuario_id = :usuario_id 
                  AND pergunta_id IN (SELECT id FROM perguntas WHERE atividade_id = :atividade_id)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->execute();
        $pontos = $stmt->fetch();
        
        if ($total['total'] > 0 && $pontos['total_pontos'] !== null) {
            return round(($pontos['total_pontos'] / $total['total']) * 100, 2);
        }
        
        return 0;
    }
    
    public function verificarRespostasUsuario($usuario_id, $atividade_id) {
        $query = "SELECT pergunta_id, opcao_escolhida_id, resposta_texto, pontuacao 
                  FROM respostas_usuarios 
                  WHERE usuario_id = :usuario_id 
                  AND pergunta_id IN (SELECT id FROM perguntas WHERE atividade_id = :atividade_id)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->execute();
        
        $respostas = [];
        while ($row = $stmt->fetch()) {
            $respostas[$row['pergunta_id']] = $row;
        }
        
        return $respostas;
    }
    
    public function buscarRecompensa($atividade_id) {
        $query = "SELECT coins, xp FROM recompensas 
                  WHERE tipo_referencia = 'atividade' AND referencia_id = :atividade_id 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function verificarRecompensaRecebida($usuario_id, $atividade_id) {
        $query = "SELECT id FROM transacoes 
                  WHERE usuario_id = :usuario_id 
                  AND tipo_referencia = 'atividade' 
                  AND referencia_id = :atividade_id 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
    
    public function registrarRecompensa($usuario_id, $atividade_id, $coins, $xp) {
        $this->conn->beginTransaction();
        
        try {
            if ($coins > 0) {
                $query = "INSERT INTO transacoes 
                          (usuario_id, tipo, operacao, quantidade, descricao, referencia_id, tipo_referencia) 
                          VALUES (:usuario_id, 'coins', 'entrada', :quantidade, 'Recompensa por completar atividade', :atividade_id, 'atividade')";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':usuario_id', $usuario_id);
                $stmt->bindParam(':quantidade', $coins);
                $stmt->bindParam(':atividade_id', $atividade_id);
                $stmt->execute();
            }
            
            if ($xp > 0) {
                $query = "INSERT INTO transacoes 
                          (usuario_id, tipo, operacao, quantidade, descricao, referencia_id, tipo_referencia) 
                          VALUES (:usuario_id, 'xp', 'entrada', :quantidade, 'Recompensa por completar atividade', :atividade_id, 'atividade')";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':usuario_id', $usuario_id);
                $stmt->bindParam(':quantidade', $xp);
                $stmt->bindParam(':atividade_id', $atividade_id);
                $stmt->execute();
            }
            
            $this->conn->commit();
            return true;
            
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
    
    public function buscarAtividadesDoUsuario($usuario_id) {
        $query = "SELECT DISTINCT a.*, m.curso_id, c.titulo as curso_titulo
                  FROM atividades a
                  INNER JOIN modulos m ON a.modulo_id = m.id
                  INNER JOIN cursos c ON m.curso_id = c.id
                  INNER JOIN compras_cursos cc ON c.id = cc.curso_id
                  WHERE cc.usuario_id = :usuario_id 
                  AND a.ativo = 1
                  ORDER BY a.ordem ASC
                  LIMIT 10";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        
        $result = $stmt->fetchAll();
        return $result ? $result : [];
    }
}
