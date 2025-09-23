<?php
/**
 * Modelo para a entidade Usuario
 */
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $dataCadastro;
    
    /**
     * Construtor
     */
    public function __construct($id = null, $nome = null, $email = null, $senha = null, $dataCadastro = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->dataCadastro = $dataCadastro;
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getSenha() {
        return $this->senha;
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
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
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
            'email' => $this->email,
            'senha' => $this->senha,
            'data_cadastro' => $this->dataCadastro
        ];
    }
    
    /**
     * Cria um objeto Usuario a partir de um array
     */
    public static function fromArray($data) {
        return new self(
            $data['id'] ?? null,
            $data['nome'] ?? null,
            $data['email'] ?? null,
            $data['senha'] ?? null,
            $data['data_cadastro'] ?? null
        );
    }
    
    /**
     * Valida os dados do usuário
     */
    public function validar() {
        $erros = [];
        
        if (empty($this->nome)) {
            $erros[] = "Nome é obrigatório";
        }
        
        if (empty($this->email)) {
            $erros[] = "Email é obrigatório";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "Email inválido";
        }
        
        if (empty($this->senha)) {
            $erros[] = "Senha é obrigatória";
        } elseif (strlen($this->senha) < 6) {
            $erros[] = "Senha deve ter pelo menos 6 caracteres";
        }
        
        return $erros;
    }
    
    /**
     * Criptografa a senha
     */
    public function criptografarSenha() {
        if (!empty($this->senha)) {
            $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
        }
    }
    
    /**
     * Verifica se a senha está correta
     */
    public function verificarSenha($senhaPlana) {
        return password_verify($senhaPlana, $this->senha);
    }
}
?>

