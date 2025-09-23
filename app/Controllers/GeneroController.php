<?php
/**
 * Controller para gerenciar gêneros
 */
class GeneroController extends Controller {
    private $generoService;
    
    public function __construct() {
        $this->generoService = new GeneroService();
    }
    
    /**
     * Lista todos os gêneros
     */
    public function index() {
        try {
            $generos = $this->generoService->listarGeneros();
            
            $this->render('genero/index', [
                'generos' => $generos,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage("Erro ao listar gêneros: " . $e->getMessage());
            $this->render('genero/index', [
                'generos' => [],
                'error_message' => $this->getErrorMessage()
            ]);
        }
    }
    
    /**
     * Exibe formulário para criar gênero
     */
    public function criar() {
        $this->render('genero/criar', [
            'success_message' => $this->getSuccessMessage(),
            'error_message' => $this->getErrorMessage()
        ]);
    }
    
    /**
     * Salva um novo gênero
     */
    public function salvar() {
        if (!$this->isPost()) {
            $this->redirect('/generos');
            return;
        }
        
        try {
            $dados = [
                'nome' => $this->getPost('nome'),
                'descricao' => $this->getPost('descricao')
            ];
            
            $genero = $this->generoService->criarGenero($dados);
            $this->setSuccessMessage("Gênero criado com sucesso!");
            $this->redirect('/generos');
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect('/generos/criar');
        }
    }
    
    /**
     * Exibe formulário para editar gênero
     */
    public function editar($id) {
        try {
            $genero = $this->generoService->buscarGenero($id);
            
            $this->render('genero/editar', [
                'genero' => $genero,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect('/generos');
        }
    }
    
    /**
     * Atualiza um gênero
     */
    public function atualizar($id) {
        if (!$this->isPost()) {
            $this->redirect('/generos');
            return;
        }
        
        try {
            $dados = [
                'nome' => $this->getPost('nome'),
                'descricao' => $this->getPost('descricao')
            ];
            
            $this->generoService->atualizarGenero($id, $dados);
            $this->setSuccessMessage("Gênero atualizado com sucesso!");
            $this->redirect('/generos');
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect("/generos/editar/{$id}");
        }
    }
    
    /**
     * Remove um gênero
     */
    public function remover($id) {
        try {
            $this->generoService->removerGenero($id);
            $this->setSuccessMessage("Gênero removido com sucesso!");
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        
        $this->redirect('/generos');
    }
    
    /**
     * Exibe detalhes de um gênero
     */
    public function visualizar($id) {
        try {
            $genero = $this->generoService->buscarGenero($id);
            
            $this->render('genero/visualizar', [
                'genero' => $genero,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect('/generos');
        }
    }
}
?>

