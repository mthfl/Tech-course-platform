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
        $query = "SELECT * FROM questoes WHERE atividade_id = :atividade_id ORDER BY ordem ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function buscarAlternativas($questao_id) {
        $query = "SELECT * FROM alternativas WHERE questao_id = :questao_id ORDER BY ordem ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':questao_id', $questao_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function verificarResposta($questao_id, $alternativa_id) {
        $query = "SELECT correta FROM alternativas 
                  WHERE id = :alternativa_id AND questao_id = :questao_id 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':alternativa_id', $alternativa_id);
        $stmt->bindParam(':questao_id', $questao_id);
        $stmt->execute();
        
        $result = $stmt->fetch();
        return $result ? $result['correta'] : 0;
    }
    
    public function salvarResposta($usuario_id, $atividade_id, $questao_id, $alternativa_id, $correta) {
        $query = "INSERT INTO respostas_usuarios 
                  (usuario_id, atividade_id, questao_id, alternativa_id, correta) 
                  VALUES (:usuario_id, :atividade_id, :questao_id, :alternativa_id, :correta)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->bindParam(':questao_id', $questao_id);
        $stmt->bindParam(':alternativa_id', $alternativa_id);
        $stmt->bindParam(':correta', $correta);
        
        return $stmt->execute();
    }
    
    public function calcularNota($usuario_id, $atividade_id) {
        $query = "SELECT COUNT(*) as total FROM questoes WHERE atividade_id = :atividade_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->execute();
        $total = $stmt->fetch();
        
        $query = "SELECT COUNT(*) as corretas FROM respostas_usuarios 
                  WHERE usuario_id = :usuario_id AND atividade_id = :atividade_id AND correta = 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':atividade_id', $atividade_id);
        $stmt->execute();
        $corretas = $stmt->fetch();
        
        if ($total['total'] > 0) {
            return round(($corretas['corretas'] / $total['total']) * 100, 2);
        }
        
        return 0;
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
}
