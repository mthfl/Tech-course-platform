<?php

require_once __DIR__ . '/../config/Database.php';

class Usuario {
    private $conn;
    private $table = 'usuarios';
    
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $nivel_conta;
    public $coins;
    public $xp_total;
    public $ativo;
    
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }
    
    public function criar() {
        $query = "INSERT INTO " . $this->table . " 
                  (nome, email, senha, nivel_conta, coins, xp_total) 
                  VALUES (:nome, :email, :senha, :nivel_conta, :coins, :xp_total)";
        
        $stmt = $this->conn->prepare($query);
        
        $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);
        
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':nivel_conta', $this->nivel_conta);
        $stmt->bindParam(':coins', $this->coins);
        $stmt->bindParam(':xp_total', $this->xp_total);
        
        return $stmt->execute();
    }
    
    public function login($email, $senha) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email AND ativo = 1 LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        if ($row && password_verify($senha, $row['senha'])) {
            $this->id = $row['id'];
            $this->nome = $row['nome'];
            $this->email = $row['email'];
            $this->nivel_conta = $row['nivel_conta'];
            $this->coins = $row['coins'];
            $this->xp_total = $row['xp_total'];
            return true;
        }
        
        return false;
    }
    
    public function buscarPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function adicionarXP($usuario_id, $xp) {
        $query = "UPDATE " . $this->table . " 
                  SET xp_total = xp_total + :xp 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':xp', $xp);
        $stmt->bindParam(':id', $usuario_id);
        
        if ($stmt->execute()) {
            $this->verificarNivelUp($usuario_id);
            return true;
        }
        return false;
    }
    
    public function adicionarCoins($usuario_id, $coins) {
        $query = "UPDATE " . $this->table . " 
                  SET coins = coins + :coins 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':coins', $coins);
        $stmt->bindParam(':id', $usuario_id);
        
        return $stmt->execute();
    }
    
    public function removerCoins($usuario_id, $coins) {
        $query = "UPDATE " . $this->table . " 
                  SET coins = coins - :coins 
                  WHERE id = :id AND coins >= :coins";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':coins', $coins);
        $stmt->bindParam(':id', $usuario_id);
        
        return $stmt->execute();
    }
    
    private function verificarNivelUp($usuario_id) {
        $usuario = $this->buscarPorId($usuario_id);
        $xp_atual = $usuario['xp_total'];
        
        $query = "SELECT nivel FROM niveis_usuario 
                  WHERE xp_necessario <= :xp 
                  ORDER BY xp_necessario DESC LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':xp', $xp_atual);
        $stmt->execute();
        
        $nivel = $stmt->fetch();
        
        if ($nivel && $nivel['nivel'] != $usuario['nivel_conta']) {
            $query = "UPDATE " . $this->table . " 
                      SET nivel_conta = :nivel 
                      WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nivel', $nivel['nivel']);
            $stmt->bindParam(':id', $usuario_id);
            $stmt->execute();
        }
    }
    
    public function emailExiste($email) {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
}
