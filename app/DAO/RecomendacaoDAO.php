<?php
/**
 * Implementação do DAO para Recomendacao
 */
class RecomendacaoDAO implements IRecomendacaoDAO {
    private $db;
    
    public function __construct() {
        $this->db = MysqlSingleton::getInstance();
    }
    
    /**
     * Insere uma nova recomendação
     */
    public function inserir(Recomendacao $recomendacao) {
        $sql = "INSERT INTO recomendacoes (usuario_id, genero_id, livro_recomendado, autor, descricao, nota) VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $recomendacao->getUsuarioId(),
            $recomendacao->getGeneroId(),
            $recomendacao->getLivroRecomendado(),
            $recomendacao->getAutor(),
            $recomendacao->getDescricao(),
            $recomendacao->getNota()
        ];
        
        $id = $this->db->insert($sql, $params);
        $recomendacao->setId($id);
        return $recomendacao;
    }
    
    /**
     * Busca uma recomendação por ID
     */
    public function buscarPorId($id) {
        $sql = "SELECT * FROM recomendacoes WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        $data = $stmt->fetch();
        
        if ($data) {
            return Recomendacao::fromArray($data);
        }
        
        return null;
    }
    
    /**
     * Lista todas as recomendações
     */
    public function listarTodos() {
        $sql = "SELECT * FROM recomendacoes ORDER BY data_recomendacao DESC";
        $stmt = $this->db->query($sql);
        $recomendacoes = [];
        
        while ($data = $stmt->fetch()) {
            $recomendacoes[] = Recomendacao::fromArray($data);
        }
        
        return $recomendacoes;
    }
    
    /**
     * Lista recomendações por usuário
     */
    public function listarPorUsuario($usuarioId) {
        $sql = "SELECT * FROM recomendacoes WHERE usuario_id = ? ORDER BY data_recomendacao DESC";
        $stmt = $this->db->query($sql, [$usuarioId]);
        $recomendacoes = [];
        
        while ($data = $stmt->fetch()) {
            $recomendacoes[] = Recomendacao::fromArray($data);
        }
        
        return $recomendacoes;
    }
    
    /**
     * Lista recomendações por gênero
     */
    public function listarPorGenero($generoId) {
        $sql = "SELECT * FROM recomendacoes WHERE genero_id = ? ORDER BY nota DESC, data_recomendacao DESC";
        $stmt = $this->db->query($sql, [$generoId]);
        $recomendacoes = [];
        
        while ($data = $stmt->fetch()) {
            $recomendacoes[] = Recomendacao::fromArray($data);
        }
        
        return $recomendacoes;
    }
    
    /**
     * Lista recomendações com informações de usuário e gênero
     */
    public function listarComDetalhes() {
        $sql = "SELECT r.*, u.nome as usuario_nome, g.nome as genero_nome 
                FROM recomendacoes r 
                INNER JOIN usuarios u ON r.usuario_id = u.id 
                INNER JOIN generos g ON r.genero_id = g.id 
                ORDER BY r.data_recomendacao DESC";
        
        $stmt = $this->db->query($sql);
        $recomendacoes = [];
        
        while ($data = $stmt->fetch()) {
            $recomendacao = Recomendacao::fromArray($data);
            $data['usuario_nome'] = $data['usuario_nome'];
            $data['genero_nome'] = $data['genero_nome'];
            $recomendacoes[] = $data;
        }
        
        return $recomendacoes;
    }
    
    /**
     * Atualiza uma recomendação
     */
    public function atualizar(Recomendacao $recomendacao) {
        $sql = "UPDATE recomendacoes SET usuario_id = ?, genero_id = ?, livro_recomendado = ?, autor = ?, descricao = ?, nota = ? WHERE id = ?";
        $params = [
            $recomendacao->getUsuarioId(),
            $recomendacao->getGeneroId(),
            $recomendacao->getLivroRecomendado(),
            $recomendacao->getAutor(),
            $recomendacao->getDescricao(),
            $recomendacao->getNota(),
            $recomendacao->getId()
        ];
        
        $this->db->execute($sql, $params);
        return $recomendacao;
    }
    
    /**
     * Remove uma recomendação
     */
    public function remover($id) {
        $sql = "DELETE FROM recomendacoes WHERE id = ?";
        return $this->db->execute($sql, [$id]) > 0;
    }
    
    /**
     * Busca recomendações por termo de pesquisa
     */
    public function buscarPorTermo($termo) {
        $sql = "SELECT r.*, u.nome as usuario_nome, g.nome as genero_nome 
                FROM recomendacoes r 
                INNER JOIN usuarios u ON r.usuario_id = u.id 
                INNER JOIN generos g ON r.genero_id = g.id 
                WHERE r.livro_recomendado LIKE ? OR r.autor LIKE ? OR r.descricao LIKE ?
                ORDER BY r.nota DESC, r.data_recomendacao DESC";
        
        $termoBusca = "%{$termo}%";
        $stmt = $this->db->query($sql, [$termoBusca, $termoBusca, $termoBusca]);
        $recomendacoes = [];
        
        while ($data = $stmt->fetch()) {
            $recomendacoes[] = $data;
        }
        
        return $recomendacoes;
    }
}
?>

