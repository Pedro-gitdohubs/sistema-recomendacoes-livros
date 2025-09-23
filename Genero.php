<?php
/**
 * Modelo para a entidade Genero
 */
class Genero {
    private $id;
    private $nome;
    private $descricao;
    private $dataCadastro;
    
    /**
     * Construtor
     */
    public function __construct($id = null, $nome = null, $descricao = null, $dataCadastro = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->dataCadastro = $dataCadastro;
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }
    
    public function getDataCadastro() {
        return $this->dataCadastro;
    }
    
    // Setters
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    public function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }
    
    /**
     * Converte o objeto para array
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'data_cadastro' => $this->dataCadastro
        ];
    }
    
    /**
     * Cria um objeto Genero a partir de um array
     */
    public static function fromArray($data) {
        return new self(
            $data['id'] ?? null,
            $data['nome'] ?? null,
            $data['descricao'] ?? null,
            $data['data_cadastro'] ?? null
        );
    }
    
    /**
     * Valida os dados do gênero
     */
    public function validar() {
        $erros = [];
        
        if (empty($this->nome)) {
            $erros[] = "Nome do gênero é obrigatório";
        }
        
        if (strlen($this->nome) > 100) {
            $erros[] = "Nome do gênero deve ter no máximo 100 caracteres";
        }
        
        return $erros;
    }
}
?>

