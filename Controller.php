<?php
/**
 * Classe base para todos os controllers
 */
abstract class Controller {
    
    /**
     * Renderiza uma view
     */
    protected function render($view, $data = []) {
        // Extrai as variáveis do array $data para o escopo local
        extract($data);
        
        // Inclui o arquivo da view
        $viewFile = dirname(__DIR__) . "/app/Views/{$view}.php";
        
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new Exception("View não encontrada: {$view}");
        }
    }
    
    /**
     * Redireciona para uma URL
     */
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
    
    /**
     * Retorna dados em formato JSON
     */
    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    /**
     * Obtém dados do POST
     */
    protected function getPost($key = null, $default = null) {
        if ($key === null) {
            return $_POST;
        }
        
        return $_POST[$key] ?? $default;
    }
    
    /**
     * Obtém dados do GET
     */
    protected function getGet($key = null, $default = null) {
        if ($key === null) {
            return $_GET;
        }
        
        return $_GET[$key] ?? $default;
    }
    
    /**
     * Verifica se a requisição é POST
     */
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    /**
     * Verifica se a requisição é GET
     */
    protected function isGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
    
    /**
     * Define uma mensagem de sucesso na sessão
     */
    protected function setSuccessMessage($message) {
        $_SESSION['success_message'] = $message;
    }
    
    /**
     * Define uma mensagem de erro na sessão
     */
    protected function setErrorMessage($message) {
        $_SESSION['error_message'] = $message;
    }
    
    /**
     * Obtém e limpa mensagem de sucesso da sessão
     */
    protected function getSuccessMessage() {
        $message = $_SESSION['success_message'] ?? null;
        unset($_SESSION['success_message']);
        return $message;
    }
    
    /**
     * Obtém e limpa mensagem de erro da sessão
     */
    protected function getErrorMessage() {
        $message = $_SESSION['error_message'] ?? null;
        unset($_SESSION['error_message']);
        return $message;
    }
}
?>

