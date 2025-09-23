<?php
/**
 * Classe para gerenciar rotas da aplicação
 */
class Router {
    private $routes = [];
    
    /**
     * Adiciona uma rota GET
     */
    public function get($path, $controller, $method) {
        $this->addRoute('GET', $path, $controller, $method);
    }
    
    /**
     * Adiciona uma rota POST
     */
    public function post($path, $controller, $method) {
        $this->addRoute('POST', $path, $controller, $method);
    }
    
    /**
     * Adiciona uma rota
     */
    private function addRoute($httpMethod, $path, $controller, $method) {
        $this->routes[] = [
            'method' => $httpMethod,
            'path' => $path,
            'controller' => $controller,
            'action' => $method
        ];
    }
    
    /**
     * Processa a requisição atual
     */
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];
        
        // Remove query string da URI
        $requestUri = strtok($requestUri, '?');
        
        // Remove a pasta do projeto da URI se estiver presente
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/') {
            $requestUri = str_replace($scriptName, '', $requestUri);
        }
        
        // Garante que a URI comece com /
        if (!str_starts_with($requestUri, '/')) {
            $requestUri = '/' . $requestUri;
        }
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $this->matchPath($route['path'], $requestUri)) {
                $this->callController($route['controller'], $route['action'], $requestUri, $route['path']);
                return;
            }
        }
        
        // Rota não encontrada
        http_response_code(404);
        echo "Página não encontrada";
    }
    
    /**
     * Verifica se o caminho da rota corresponde à URI
     */
    private function matchPath($routePath, $requestUri) {
        // Converte parâmetros da rota (ex: /usuario/{id}) em regex
        $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $routePath);
        $pattern = '#^' . $pattern . '$#';
        
        return preg_match($pattern, $requestUri);
    }
    
    /**
     * Chama o controller e método apropriados
     */
    private function callController($controllerName, $method, $requestUri, $routePath) {
        $controllerClass = $controllerName . 'Controller';
        
        if (!class_exists($controllerClass)) {
            throw new Exception("Controller não encontrado: {$controllerClass}");
        }
        
        $controller = new $controllerClass();
        
        if (!method_exists($controller, $method)) {
            throw new Exception("Método não encontrado: {$method} em {$controllerClass}");
        }
        
        // Extrai parâmetros da URL
        $params = $this->extractParams($routePath, $requestUri);
        
        // Chama o método do controller com os parâmetros
        call_user_func_array([$controller, $method], $params);
    }
    
    /**
     * Extrai parâmetros da URL
     */
    private function extractParams($routePath, $requestUri) {
        $routeParts = explode('/', trim($routePath, '/'));
        $uriParts = explode('/', trim($requestUri, '/'));
        
        $params = [];
        
        for ($i = 0; $i < count($routeParts); $i++) {
            if (isset($routeParts[$i]) && preg_match('/\{([^}]+)\}/', $routeParts[$i])) {
                $params[] = $uriParts[$i] ?? null;
            }
        }
        
        return $params;
    }
}
?>

