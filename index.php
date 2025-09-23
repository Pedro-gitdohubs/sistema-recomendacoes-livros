<?php
// Inicia a sessão
session_start();

// Inclui o autoloader
require_once dirname(__DIR__) . '/core/Autoload.php';

// Inclui o router
require_once dirname(__DIR__) . '/routes/Router.php';

// Cria uma instância do router
$router = new Router();

// Define as rotas da aplicação

// Rotas da página inicial
$router->get('/', 'Home', 'index');
$router->get('/buscar', 'Home', 'buscar');

// Rotas de usuários
$router->get('/usuarios', 'Usuario', 'index');
$router->get('/usuarios/criar', 'Usuario', 'criar');
$router->post('/usuarios/salvar', 'Usuario', 'salvar');
$router->get('/usuarios/editar/{id}', 'Usuario', 'editar');
$router->post('/usuarios/atualizar/{id}', 'Usuario', 'atualizar');
$router->get('/usuarios/remover/{id}', 'Usuario', 'remover');
$router->get('/usuarios/visualizar/{id}', 'Usuario', 'visualizar');

// Rotas de gêneros
$router->get('/generos', 'Genero', 'index');
$router->get('/generos/criar', 'Genero', 'criar');
$router->post('/generos/salvar', 'Genero', 'salvar');
$router->get('/generos/editar/{id}', 'Genero', 'editar');
$router->post('/generos/atualizar/{id}', 'Genero', 'atualizar');
$router->get('/generos/remover/{id}', 'Genero', 'remover');
$router->get('/generos/visualizar/{id}', 'Genero', 'visualizar');

// Rotas de recomendações
$router->get('/recomendacoes', 'Recomendacao', 'index');
$router->get('/recomendacoes/criar', 'Recomendacao', 'criar');
$router->post('/recomendacoes/salvar', 'Recomendacao', 'salvar');
$router->get('/recomendacoes/editar/{id}', 'Recomendacao', 'editar');
$router->post('/recomendacoes/atualizar/{id}', 'Recomendacao', 'atualizar');
$router->get('/recomendacoes/remover/{id}', 'Recomendacao', 'remover');
$router->get('/recomendacoes/visualizar/{id}', 'Recomendacao', 'visualizar');

// Processa a requisição
try {
    $router->dispatch();
} catch (Exception $e) {
    // Em caso de erro, exibe uma página de erro
    http_response_code(500);
    echo "<h1>Erro interno do servidor</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    
    // Em ambiente de desenvolvimento, mostra o stack trace
    if (true) { // Altere para false em produção
        echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    }
}
?>

