<?php
/**
 * Controller para gerenciar recomendações
 */
class RecomendacaoController extends Controller {
    private $recomendacaoService;
    private $usuarioService;
    private $generoService;
    
    public function __construct() {
        $this->recomendacaoService = new RecomendacaoService();
        $this->usuarioService = new UsuarioService();
        $this->generoService = new GeneroService();
    }
    
    /**
     * Lista todas as recomendações
     */
    public function index() {
        try {
            $recomendacoes = $this->recomendacaoService->listarRecomendacoesComDetalhes();
            
            $this->render('recomendacao/index', [
                'recomendacoes' => $recomendacoes,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage("Erro ao listar recomendações: " . $e->getMessage());
            $this->render('recomendacao/index', [
                'recomendacoes' => [],
                'error_message' => $this->getErrorMessage()
            ]);
        }
    }
    
    /**
     * Exibe formulário para criar recomendação
     */
    public function criar() {
        try {
            $usuarios = $this->usuarioService->listarUsuarios();
            $generos = $this->generoService->listarGeneros();
            
            $this->render('recomendacao/criar', [
                'usuarios' => $usuarios,
                'generos' => $generos,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage("Erro ao carregar formulário: " . $e->getMessage());
            $this->redirect('/recomendacoes');
        }
    }
    
    /**
     * Salva uma nova recomendação
     */
    public function salvar() {
        if (!$this->isPost()) {
            $this->redirect('/recomendacoes');
            return;
        }
        
        try {
            $dados = [
                'usuario_id' => $this->getPost('usuario_id'),
                'genero_id' => $this->getPost('genero_id'),
                'livro_recomendado' => $this->getPost('livro_recomendado'),
                'autor' => $this->getPost('autor'),
                'descricao' => $this->getPost('descricao'),
                'nota' => $this->getPost('nota')
            ];
            
            $recomendacao = $this->recomendacaoService->criarRecomendacao($dados);
            $this->setSuccessMessage("Recomendação criada com sucesso!");
            $this->redirect('/recomendacoes');
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect('/recomendacoes/criar');
        }
    }
    
    /**
     * Exibe formulário para editar recomendação
     */
    public function editar($id) {
        try {
            $recomendacao = $this->recomendacaoService->buscarRecomendacao($id);
            $usuarios = $this->usuarioService->listarUsuarios();
            $generos = $this->generoService->listarGeneros();
            
            $this->render('recomendacao/editar', [
                'recomendacao' => $recomendacao,
                'usuarios' => $usuarios,
                'generos' => $generos,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect('/recomendacoes');
        }
    }
    
    /**
     * Atualiza uma recomendação
     */
    public function atualizar($id) {
        if (!$this->isPost()) {
            $this->redirect('/recomendacoes');
            return;
        }
        
        try {
            $dados = [
                'usuario_id' => $this->getPost('usuario_id'),
                'genero_id' => $this->getPost('genero_id'),
                'livro_recomendado' => $this->getPost('livro_recomendado'),
                'autor' => $this->getPost('autor'),
                'descricao' => $this->getPost('descricao'),
                'nota' => $this->getPost('nota')
            ];
            
            $this->recomendacaoService->atualizarRecomendacao($id, $dados);
            $this->setSuccessMessage("Recomendação atualizada com sucesso!");
            $this->redirect('/recomendacoes');
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect("/recomendacoes/editar/{$id}");
        }
    }
    
    /**
     * Remove uma recomendação
     */
    public function remover($id) {
        try {
            $this->recomendacaoService->removerRecomendacao($id);
            $this->setSuccessMessage("Recomendação removida com sucesso!");
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        
        $this->redirect('/recomendacoes');
    }
    
    /**
     * Exibe detalhes de uma recomendação
     */
    public function visualizar($id) {
        try {
            $recomendacao = $this->recomendacaoService->buscarRecomendacao($id);
            
            $this->render('recomendacao/visualizar', [
                'recomendacao' => $recomendacao,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect('/recomendacoes');
        }
    }
}
?>

