<?php
/**
 * Configurações do banco de dados
 */
class Config {
    const DB_HOST = 'localhost';
    const DB_NAME = 'sistema_recomendacoes_livros';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_CHARSET = 'utf8mb4';
    
    /**
     * Retorna o DSN para conexão PDO
     */
    public static function getDSN() {
        return "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=" . self::DB_CHARSET;
    }
    
    /**
     * Retorna as opções padrão do PDO
     */
    public static function getPDOOptions() {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
    }
}
?>

