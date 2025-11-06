<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->connect_database();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    private function connect_database() {
        $configFile = __DIR__ . '/../.env/config.php';
        
        if (!file_exists($configFile)) {
            die('Arquivo de configuração não encontrado em: ' . $configFile);
        }
        
        $config = require($configFile);
        
        if (!is_array($config)) {
            die('Arquivo de configuração inválido. Deve retornar um array.');
        }
        
        // Tenta conectar primeiro com a configuração local
        if (isset($config['local']['tech_course'])) {
            $dbConfig = $config['local']['tech_course'];
            
            if (isset($dbConfig['host']) && isset($dbConfig['banco']) && 
                isset($dbConfig['user']) && isset($dbConfig['senha'])) {
                
                try {
                    $host = $dbConfig['host'];
                    $database = $dbConfig['banco'];
                    $user = $dbConfig['user'];
                    $password = $dbConfig['senha'];

                    $this->conn = new PDO(
                        'mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', 
                        $user, 
                        $password
                    );
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                    return; // Conexão bem-sucedida
                } catch (PDOException $e) {
                    error_log("Erro ao conectar com banco local: " . $e->getMessage());
                    // Continua para tentar a configuração de hospedagem
                }
            }
        }
        
        // Se falhou, tenta com a configuração de hospedagem
        if (isset($config['hospedagem']['tech_course'])) {
            $dbConfig = $config['hospedagem']['tech_course'];
            
            if (isset($dbConfig['host']) && isset($dbConfig['banco']) && 
                isset($dbConfig['user']) && isset($dbConfig['senha'])) {
                
                try {
                    $host = $dbConfig['host'];
                    $database = $dbConfig['banco'];
                    $user = $dbConfig['user'];
                    $password = $dbConfig['senha'];

                    $this->conn = new PDO(
                        'mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', 
                        $user, 
                        $password
                    );
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                    return; // Conexão bem-sucedida
                } catch (PDOException $e) {
                    error_log("Erro ao conectar com banco de hospedagem: " . $e->getMessage());
                }
            }
        }
        
        // Se chegou aqui, não conseguiu conectar
        $this->conn = null;
        die("Erro ao conectar com o banco de dados. Verifique as configurações no arquivo: " . $configFile);
    }

    public function getConnection() {
        return $this->conn;
    }

    private function __clone() {}

    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}
