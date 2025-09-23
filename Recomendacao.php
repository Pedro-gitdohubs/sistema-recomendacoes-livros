<?php
/**
 * Modelo para a entidade Recomendacao
 */
class Recomendacao {
    private $id;
    private $usuarioId;
    private $generoId;
    private $livroRecomendado;
    private $autor;
    private $descricao;
    private $nota;
    private $dataRecomendacao;
    
    /**
     * Construtor
     */
    public function __construct($id = null, $usuarioId = null, $generoId = null, $livroRecomendado = null, 
                               $autor = null, $descricao = null, $nota = null, $dataRecomendacao = null) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->generoId = $generoId;
        $this->livroRecomendado = $livroRecomendado;
        $this->autor = $autor;
        $this->descricao = $descricao;
        $this->nota = $nota;
        $this->dataRecomendacao = $dataRecomendacao;
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getUsuarioId() {
        return $this->usuarioId;
    }
    
    public function getGeneroId() {
        return $this->generoId;
    }
    
    public function getLivroRecomendado() {
        return $this->livroRecomendado;
    }
    
    public function getAutor() {
        return $this->autor;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }
    
    public function getNota() {
        return $this->nota;
    }
    
    public function getDataRecomendacao() {
        return $this->dataRecomendacao;
    }
    
    // Setters
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setUsuarioId($usuarioId) {
        $this->usuarioId = $usuarioId;
    }
    
    public function setGeneroId($generoId) {
        $this->generoId = $generoId;
    }
    
    public function setLivroRecomendado($livroRecomendado) {
        $this->livroRecomendado = $livroRecomendado;
    }
    
    public function setAutor($autor) {
        $this->autor = $autor;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    public function setNota($nota) {
        $this->nota = $nota;
    }
    
    public function setDataRecomendacao($dataRecomendacao) {
        $this->dataRecomendacao = $dataRecomendacao;
    }
    
    /**
     * Converte o objeto para array
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuarioId,
            'genero_id' => $this->generoId,
            'livro_recomendado' => $this->livroRecomendado,
            'autor' => $this->autor,
            'descricao' => $this->descricao,
            'nota' => $this->nota,
            'data_recomendacao' => $this->dataRecomendacao
        ];
    }
    
    /**
     * Cria um objeto Recomendacao a partir de um array
     */
    public static function fromArray($data) {
        return new self(
            $data['id'] ?? null,
            $data['usuario_id'] ?? null,
            $data['genero_id'] ?? null,
            $data['livro_recomendado'] ?? null,
            $data['autor'] ?? null,
            $data['descricao'] ?? null,
            $data['nota'] ?? null,
            $data['data_recomendacao'] ?? null
        );
    }
    
    /**
     * Valida os dados da recomendação
     */
    public function validar() {
        $erros = [];
        
        if (empty($this->usuarioId)) {
            $erros[] = "ID do usuário é obrigatório";
        }
        
        if (empty($this->generoId)) {
            $erros[] = "ID do gênero é obrigatório";
        }
        
        if (empty($this->livroRecomendado)) {
            $erros[] = "Nome do livro é obrigatório";
        }
        
        if (strlen($this->livroRecomendado) > 150) {
            $erros[] = "Nome do livro deve ter no máximo 150 caracteres";
        }
        
        if (!empty($this->autor) && strlen($this->autor) > 100) {
            $erros[] = "Nome do autor deve ter no máximo 100 caracteres";
        }
        
        if (!empty($this->nota) && ($this->nota < 0 || $this->nota > 5)) {
            $erros[] = "Nota deve estar entre 0 e 5";
        }
        
        return $erros;
    }
}
?>

