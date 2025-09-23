<?php
/**
 * Sistema de autoload para carregar classes automaticamente
 */
class Autoload {
    
    /**
     * Registra o autoloader
     */
    public static function register() {
        spl_autoload_register([__CLASS__, 'load']);
    }
    
    /**
     * Carrega a classe baseada no nome
     */
    public static function load($className) {
        $baseDir = dirname(__DIR__) . '/';
        
        // Mapeamento de namespaces/diretórios
        $directories = [
            'app/Models/',
            'app/Controllers/',
            'app/DAO/',
            'app/Services/',
            'core/',
            'core/Database/'
        ];
        
        foreach ($directories as $directory) {
            $file = $baseDir . $directory . $className . '.php';
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
}

// Registra o autoloader
Autoload::register();
?>

