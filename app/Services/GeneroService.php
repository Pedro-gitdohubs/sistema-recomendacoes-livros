<?php
/**
 * Classe de serviço para regras de negócio de Genero
 */
class GeneroService {
    private $generoDAO;
    
    public function __construct() {
        $this->generoDAO = new GeneroDAO();
    }
    
    /**
     * Cria um novo gênero
     */
    public function criarGenero($dados) {
        $genero = new Genero();
        $genero->setNome($dados['nome']);
        $genero->setDescricao($dados['descricao'] ?? '');
        
        // Validar dados
        $erros = $genero->validar();
        
        // Verificar se nome já existe
        if ($this->generoDAO->nomeExiste($genero->getNome())) {
            $erros[] = "Este nome de gênero já está cadastrado";
        }
        
        if (!empty($erros)) {
            throw new Exception(implode(", ", $erros));
        }
        
        return $this->generoDAO->inserir($genero);
    }
    
    /**
     * Busca um gênero por ID
     */
    public function buscarGenero($id) {
        if (empty($id)) {
            throw new Exception("ID do gênero é obrigatório");
        }
        
        $genero = $this->generoDAO->buscarPorId($id);
        if (!$genero) {
            throw new Exception("Gênero não encontrado");
        }
        
        return $genero;
    }
    
    /**
     * Lista todos os gêneros
     */
    public function listarGeneros() {
        return $this->generoDAO->listarTodos();
    }
    
    /**
     * Atualiza um gênero
     */
    public function atualizarGenero($id, $dados) {
        $genero = $this->buscarGenero($id);
        
        $genero->setNome($dados['nome']);
        $genero->setDescricao($dados['descricao'] ?? '');
        
        // Validar dados
        $erros = $genero->validar();
        
        // Verificar se nome já existe (excluindo o próprio gênero)
        if ($this->generoDAO->nomeExiste($genero->getNome(), $id)) {
            $erros[] = "Este nome de gênero já está cadastrado";
        }
        
        if (!empty($erros)) {
            throw new Exception(implode(", ", $erros));
        }
        
        return $this->generoDAO->atualizar($genero);
    }
    
    /**
     * Remove um gênero
     */
    public function removerGenero($id) {
        $genero = $this->buscarGenero($id);
        
        if (!$this->generoDAO->remover($id)) {
            throw new Exception("Erro ao remover gênero");
        }
        
        return true;
    }
    
    /**
     * Verifica se um nome de gênero está disponível
     */
    public function nomeDisponivel($nome, $idExcluir = null) {
        return !$this->generoDAO->nomeExiste($nome, $idExcluir);
    }
    
    /**
     * Busca gênero por nome
     */
    public function buscarPorNome($nome) {
        return $this->generoDAO->buscarPorNome($nome);
    }
}
?>

