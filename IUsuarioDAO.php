<?php
/**
 * Interface para DAO de Usuario
 */
interface IUsuarioDAO {
    
    /**
     * Insere um novo usuário
     */
    public function inserir(Usuario $usuario);
    
    /**
     * Busca um usuário por ID
     */
    public function buscarPorId($id);
    
    /**
     * Busca um usuário por email
     */
    public function buscarPorEmail($email);
    
    /**
     * Lista todos os usuários
     */
    public function listarTodos();
    
    /**
     * Atualiza um usuário
     */
    public function atualizar(Usuario $usuario);
    
    /**
     * Remove um usuário
     */
    public function remover($id);
    
    /**
     * Verifica se um email já existe
     */
    public function emailExiste($email, $idExcluir = null);
}
?>

