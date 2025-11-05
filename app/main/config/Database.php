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
        try {
            $config = require(__DIR__ . '/../.env/config.php');

            try {
                $host = $config['local']['tech_course']['host'];
                $database = $config['local']['tech_course']['banco'];
                $user = $config['local']['tech_course']['user'];
                $password = $config['local']['tech_course']['senha'];

                $this->conn = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $user, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $host = $config['hospedagem']['tech_course']['host'];
                $database = $config['hospedagem']['tech_course']['banco'];
                $user = $config['hospedagem']['tech_course']['user'];
                $password = $config['hospedagem']['tech_course']['senha'];

                $this->conn = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $user, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            error_log("Erro de conexão com banco: " . $e->getMessage());
            $this->conn = null;
            die("Erro ao conectar com o banco de dados. Verifique as configurações.");
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    private function __clone() {}

    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}
