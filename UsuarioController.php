<?php
/**
 * Controller para gerenciar usuários
 */
class UsuarioController extends Controller {
    private $usuarioService;
    
    public function __construct() {
        $this->usuarioService = new UsuarioService();
    }
    
    /**
     * Lista todos os usuários
     */
    public function index() {
        try {
            $usuarios = $this->usuarioService->listarUsuarios();
            
            $this->render('usuario/index', [
                'usuarios' => $usuarios,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage("Erro ao listar usuários: " . $e->getMessage());
            $this->render('usuario/index', [
                'usuarios' => [],
                'error_message' => $this->getErrorMessage()
            ]);
        }
    }
    
    /**
     * Exibe formulário para criar usuário
     */
    public function criar() {
        $this->render('usuario/criar', [
            'success_message' => $this->getSuccessMessage(),
            'error_message' => $this->getErrorMessage()
        ]);
    }
    
    /**
     * Salva um novo usuário
     */
    public function salvar() {
        if (!$this->isPost()) {
            $this->redirect('/usuarios');
            return;
        }
        
        try {
            $dados = [
                'nome' => $this->getPost('nome'),
                'email' => $this->getPost('email'),
                'senha' => $this->getPost('senha')
            ];
            
            $usuario = $this->usuarioService->criarUsuario($dados);
            $this->setSuccessMessage("Usuário criado com sucesso!");
            $this->redirect('/usuarios');
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect('/usuarios/criar');
        }
    }
    
    /**
     * Exibe formulário para editar usuário
     */
    public function editar($id) {
        try {
            $usuario = $this->usuarioService->buscarUsuario($id);
            
            $this->render('usuario/editar', [
                'usuario' => $usuario,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect('/usuarios');
        }
    }
    
    /**
     * Atualiza um usuário
     */
    public function atualizar($id) {
        if (!$this->isPost()) {
            $this->redirect('/usuarios');
            return;
        }
        
        try {
            $dados = [
                'nome' => $this->getPost('nome'),
                'email' => $this->getPost('email'),
                'senha' => $this->getPost('senha')
            ];
            
            $this->usuarioService->atualizarUsuario($id, $dados);
            $this->setSuccessMessage("Usuário atualizado com sucesso!");
            $this->redirect('/usuarios');
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect("/usuarios/editar/{$id}");
        }
    }
    
    /**
     * Remove um usuário
     */
    public function remover($id) {
        try {
            $this->usuarioService->removerUsuario($id);
            $this->setSuccessMessage("Usuário removido com sucesso!");
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
        }
        
        $this->redirect('/usuarios');
    }
    
    /**
     * Exibe detalhes de um usuário
     */
    public function visualizar($id) {
        try {
            $usuario = $this->usuarioService->buscarUsuario($id);
            
            $this->render('usuario/visualizar', [
                'usuario' => $usuario,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage($e->getMessage());
            $this->redirect('/usuarios');
        }
    }
}
?>

