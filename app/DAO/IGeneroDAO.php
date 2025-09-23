<?php
/**
 * Interface para DAO de Genero
 */
interface IGeneroDAO {
    
    /**
     * Insere um novo gênero
     */
    public function inserir(Genero $genero);
    
    /**
     * Busca um gênero por ID
     */
    public function buscarPorId($id);
    
    /**
     * Busca um gênero por nome
     */
    public function buscarPorNome($nome);
    
    /**
     * Lista todos os gêneros
     */
    public function listarTodos();
    
    /**
     * Atualiza um gênero
     */
    public function atualizar(Genero $genero);
    
    /**
     * Remove um gênero
     */
    public function remover($id);
    
    /**
     * Verifica se um nome de gênero já existe
     */
    public function nomeExiste($nome, $idExcluir = null);
}
?>

