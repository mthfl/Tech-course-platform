<?php

require_once __DIR__ . '/../config/Database.php';

class Curso {
    private $conn;
    private $table = 'cursos';
    
    public $id;
    public $titulo;
    public $descricao;
    public $imagem_capa;
    public $nivel_requerido;
    public $preco_coins;
    public $ativo;
    
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }
    
    public function listarTodos($nivel_usuario = null) {
        $query = "SELECT * FROM " . $this->table . " WHERE ativo = 1";
        
        if ($nivel_usuario) {
            $niveis = ['iniciante' => 1, 'intermediario' => 2, 'avancado' => 3, 'premium' => 4];
            $nivel_num = $niveis[$nivel_usuario] ?? 1;
            
            $query .= " AND (
                (nivel_requerido = 'iniciante' AND $nivel_num >= 1) OR
                (nivel_requerido = 'intermediario' AND $nivel_num >= 2) OR
                (nivel_requerido = 'avancado' AND $nivel_num >= 3) OR
                (nivel_requerido = 'premium' AND $nivel_num >= 4)
            )";
        }
        
        $query .= " ORDER BY data_criacao DESC";
        
        $stmt = $this->conn->prepare($query);
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
    
    public function buscarModulos($curso_id) {
        $query = "SELECT * FROM modulos WHERE curso_id = :curso_id ORDER BY ordem ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function verificarAcesso($usuario_id, $curso_id) {
        $query = "SELECT id FROM compras_cursos 
                  WHERE usuario_id = :usuario_id AND curso_id = :curso_id 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
    
    public function comprarCurso($usuario_id, $curso_id, $preco_coins) {
        $this->conn->beginTransaction();
        
        try {
            $query = "INSERT INTO compras_cursos (usuario_id, curso_id, preco_pago_coins) 
                      VALUES (:usuario_id, :curso_id, :preco_coins)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':curso_id', $curso_id);
            $stmt->bindParam(':preco_coins', $preco_coins);
            $stmt->execute();
            
            $query = "INSERT INTO progresso_usuarios (usuario_id, curso_id) 
                      VALUES (:usuario_id, :curso_id)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':curso_id', $curso_id);
            $stmt->execute();
            
            $this->conn->commit();
            return true;
            
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
    
    public function buscarCursosComprados($usuario_id) {
        $query = "SELECT c.*, cc.data_compra 
                  FROM " . $this->table . " c
                  INNER JOIN compras_cursos cc ON c.id = cc.curso_id
                  WHERE cc.usuario_id = :usuario_id
                  ORDER BY cc.data_compra DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function calcularProgresso($usuario_id, $curso_id) {
        $query = "SELECT COUNT(DISTINCT v.id) as total_videos
                  FROM videos v
                  INNER JOIN modulos m ON v.modulo_id = m.id
                  WHERE m.curso_id = :curso_id AND v.ativo = 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->execute();
        $total = $stmt->fetch();
        
        $query = "SELECT COUNT(DISTINCT va.video_id) as videos_assistidos
                  FROM videos_assistidos va
                  INNER JOIN videos v ON va.video_id = v.id
                  INNER JOIN modulos m ON v.modulo_id = m.id
                  WHERE m.curso_id = :curso_id AND va.usuario_id = :usuario_id
                  AND va.progresso >= 90";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        $assistidos = $stmt->fetch();
        
        if ($total['total_videos'] > 0) {
            return round(($assistidos['videos_assistidos'] / $total['total_videos']) * 100, 2);
        }
        
        return 0;
    }
}
