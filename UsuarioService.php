<?php
/**
 * Classe de serviço para regras de negócio de Usuario
 */
class UsuarioService {
    private $usuarioDAO;
    
    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }
    
    /**
     * Cria um novo usuário
     */
    public function criarUsuario($dados) {
        $usuario = new Usuario();
        $usuario->setNome($dados['nome']);
        $usuario->setEmail($dados['email']);
        $usuario->setSenha($dados['senha']);
        
        // Validar dados
        $erros = $usuario->validar();
        
        // Verificar se email já existe
        if ($this->usuarioDAO->emailExiste($usuario->getEmail())) {
            $erros[] = "Este email já está cadastrado";
        }
        
        if (!empty($erros)) {
            throw new Exception(implode(", ", $erros));
        }
        
        // Criptografar senha
        $usuario->criptografarSenha();
        
        return $this->usuarioDAO->inserir($usuario);
    }
    
    /**
     * Busca um usuário por ID
     */
    public function buscarUsuario($id) {
        if (empty($id)) {
            throw new Exception("ID do usuário é obrigatório");
        }
        
        $usuario = $this->usuarioDAO->buscarPorId($id);
        if (!$usuario) {
            throw new Exception("Usuário não encontrado");
        }
        
        return $usuario;
    }
    
    /**
     * Lista todos os usuários
     */
    public function listarUsuarios() {
        return $this->usuarioDAO->listarTodos();
    }
    
    /**
     * Atualiza um usuário
     */
    public function atualizarUsuario($id, $dados) {
        $usuario = $this->buscarUsuario($id);
        
        $usuario->setNome($dados['nome']);
        $usuario->setEmail($dados['email']);
        
        // Se uma nova senha foi fornecida
        if (!empty($dados['senha'])) {
            $usuario->setSenha($dados['senha']);
            $usuario->criptografarSenha();
        }
        
        // Validar dados
        $erros = $usuario->validar();
        
        // Verificar se email já existe (excluindo o próprio usuário)
        if ($this->usuarioDAO->emailExiste($usuario->getEmail(), $id)) {
            $erros[] = "Este email já está cadastrado";
        }
        
        if (!empty($erros)) {
            throw new Exception(implode(", ", $erros));
        }
        
        return $this->usuarioDAO->atualizar($usuario);
    }
    
    /**
     * Remove um usuário
     */
    public function removerUsuario($id) {
        $usuario = $this->buscarUsuario($id);
        
        if (!$this->usuarioDAO->remover($id)) {
            throw new Exception("Erro ao remover usuário");
        }
        
        return true;
    }
    
    /**
     * Autentica um usuário
     */
    public function autenticarUsuario($email, $senha) {
        if (empty($email) || empty($senha)) {
            throw new Exception("Email e senha são obrigatórios");
        }
        
        $usuario = $this->usuarioDAO->buscarPorEmail($email);
        if (!$usuario) {
            throw new Exception("Email ou senha inválidos");
        }
        
        if (!$usuario->verificarSenha($senha)) {
            throw new Exception("Email ou senha inválidos");
        }
        
        return $usuario;
    }
    
    /**
     * Verifica se um email está disponível
     */
    public function emailDisponivel($email, $idExcluir = null) {
        return !$this->usuarioDAO->emailExiste($email, $idExcluir);
    }
}
?>

