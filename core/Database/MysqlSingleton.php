<?php
require_once dirname(__DIR__, 2) . '/config/config.php';

/**
 * Classe Singleton para conexão com MySQL usando PDO
 */
class MysqlSingleton {
    private static $instance = null;
    private $connection;
    
    /**
     * Construtor privado para implementar Singleton
     */
    private function __construct() {
        try {
            $this->connection = new PDO(
                Config::getDSN(),
                Config::DB_USER,
                Config::DB_PASS,
                Config::getPDOOptions()
            );
        } catch (PDOException $e) {
            throw new Exception("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
    
    /**
     * Previne clonagem da instância
     */
    private function __clone() {}
    
    /**
     * Previne deserialização da instância
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
    
    /**
     * Retorna a instância única da classe
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Retorna a conexão PDO
     */
    public function getConnection() {
        return $this->connection;
    }
    
    /**
     * Executa uma query e retorna o resultado
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Erro na execução da query: " . $e->getMessage());
        }
    }
    
    /**
     * Executa uma query de inserção e retorna o último ID inserido
     */
    public function insert($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Erro na inserção: " . $e->getMessage());
        }
    }
    
    /**
     * Executa uma query de atualização ou exclusão e retorna o número de linhas afetadas
     */
    public function execute($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception("Erro na execução: " . $e->getMessage());
        }
    }
}
?>

