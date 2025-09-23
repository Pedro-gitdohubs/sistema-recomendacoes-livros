<?php
/**
 * Interface para DAO de Recomendacao
 */
interface IRecomendacaoDAO {
    
    /**
     * Insere uma nova recomendação
     */
    public function inserir(Recomendacao $recomendacao);
    
    /**
     * Busca uma recomendação por ID
     */
    public function buscarPorId($id);
    
    /**
     * Lista todas as recomendações
     */
    public function listarTodos();
    
    /**
     * Lista recomendações por usuário
     */
    public function listarPorUsuario($usuarioId);
    
    /**
     * Lista recomendações por gênero
     */
    public function listarPorGenero($generoId);
    
    /**
     * Lista recomendações com informações de usuário e gênero
     */
    public function listarComDetalhes();
    
    /**
     * Atualiza uma recomendação
     */
    public function atualizar(Recomendacao $recomendacao);
    
    /**
     * Remove uma recomendação
     */
    public function remover($id);
    
    /**
     * Busca recomendações por termo de pesquisa
     */
    public function buscarPorTermo($termo);
}
?>

