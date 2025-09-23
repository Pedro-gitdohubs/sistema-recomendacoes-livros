<?php
/**
 * Implementação do DAO para Usuario
 */
class UsuarioDAO implements IUsuarioDAO {
    private $db;
    
    public function __construct() {
        $this->db = MysqlSingleton::getInstance();
    }
    
    /**
     * Insere um novo usuário
     */
    public function inserir(Usuario $usuario) {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $params = [
            $usuario->getNome(),
            $usuario->getEmail(),
            $usuario->getSenha()
        ];
        
        $id = $this->db->insert($sql, $params);
        $usuario->setId($id);
        return $usuario;
    }
    
    /**
     * Busca um usuário por ID
     */
    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        $data = $stmt->fetch();
        
        if ($data) {
            return Usuario::fromArray($data);
        }
        
        return null;
    }
    
    /**
     * Busca um usuário por email
     */
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->db->query($sql, [$email]);
        $data = $stmt->fetch();
        
        if ($data) {
            return Usuario::fromArray($data);
        }
        
        return null;
    }
    
    /**
     * Lista todos os usuários
     */
    public function listarTodos() {
        $sql = "SELECT * FROM usuarios ORDER BY nome";
        $stmt = $this->db->query($sql);
        $usuarios = [];
        
        while ($data = $stmt->fetch()) {
            $usuarios[] = Usuario::fromArray($data);
        }
        
        return $usuarios;
    }
    
    /**
     * Atualiza um usuário
     */
    public function atualizar(Usuario $usuario) {
        $sql = "UPDATE usuarios SET nome = ?, email = ?";
        $params = [$usuario->getNome(), $usuario->getEmail()];
        
        // Se a senha foi alterada, inclui na atualização
        if (!empty($usuario->getSenha())) {
            $sql .= ", senha = ?";
            $params[] = $usuario->getSenha();
        }
        
        $sql .= " WHERE id = ?";
        $params[] = $usuario->getId();
        
        $this->db->execute($sql, $params);
        return $usuario;
    }
    
    /**
     * Remove um usuário
     */
    public function remover($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        return $this->db->execute($sql, [$id]) > 0;
    }
    
    /**
     * Verifica se um email já existe
     */
    public function emailExiste($email, $idExcluir = null) {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
        $params = [$email];
        
        if ($idExcluir) {
            $sql .= " AND id != ?";
            $params[] = $idExcluir;
        }
        
        $stmt = $this->db->query($sql, $params);
        return $stmt->fetchColumn() > 0;
    }
}
?>

