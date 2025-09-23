<?php
/**
 * Implementação do DAO para Genero
 */
class GeneroDAO implements IGeneroDAO {
    private $db;
    
    public function __construct() {
        $this->db = MysqlSingleton::getInstance();
    }
    
    /**
     * Insere um novo gênero
     */
    public function inserir(Genero $genero) {
        $sql = "INSERT INTO generos (nome, descricao) VALUES (?, ?)";
        $params = [
            $genero->getNome(),
            $genero->getDescricao()
        ];
        
        $id = $this->db->insert($sql, $params);
        $genero->setId($id);
        return $genero;
    }
    
    /**
     * Busca um gênero por ID
     */
    public function buscarPorId($id) {
        $sql = "SELECT * FROM generos WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        $data = $stmt->fetch();
        
        if ($data) {
            return Genero::fromArray($data);
        }
        
        return null;
    }
    
    /**
     * Busca um gênero por nome
     */
    public function buscarPorNome($nome) {
        $sql = "SELECT * FROM generos WHERE nome = ?";
        $stmt = $this->db->query($sql, [$nome]);
        $data = $stmt->fetch();
        
        if ($data) {
            return Genero::fromArray($data);
        }
        
        return null;
    }
    
    /**
     * Lista todos os gêneros
     */
    public function listarTodos() {
        $sql = "SELECT * FROM generos ORDER BY nome";
        $stmt = $this->db->query($sql);
        $generos = [];
        
        while ($data = $stmt->fetch()) {
            $generos[] = Genero::fromArray($data);
        }
        
        return $generos;
    }
    
    /**
     * Atualiza um gênero
     */
    public function atualizar(Genero $genero) {
        $sql = "UPDATE generos SET nome = ?, descricao = ? WHERE id = ?";
        $params = [
            $genero->getNome(),
            $genero->getDescricao(),
            $genero->getId()
        ];
        
        $this->db->execute($sql, $params);
        return $genero;
    }
    
    /**
     * Remove um gênero
     */
    public function remover($id) {
        $sql = "DELETE FROM generos WHERE id = ?";
        return $this->db->execute($sql, [$id]) > 0;
    }
    
    /**
     * Verifica se um nome de gênero já existe
     */
    public function nomeExiste($nome, $idExcluir = null) {
        $sql = "SELECT COUNT(*) FROM generos WHERE nome = ?";
        $params = [$nome];
        
        if ($idExcluir) {
            $sql .= " AND id != ?";
            $params[] = $idExcluir;
        }
        
        $stmt = $this->db->query($sql, $params);
        return $stmt->fetchColumn() > 0;
    }
}
?>

