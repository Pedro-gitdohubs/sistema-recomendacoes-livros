<?php
/**
 * Classe de serviço para regras de negócio de Recomendacao
 */
class RecomendacaoService {
    private $recomendacaoDAO;
    private $usuarioService;
    private $generoService;
    
    public function __construct() {
        $this->recomendacaoDAO = new RecomendacaoDAO();
        $this->usuarioService = new UsuarioService();
        $this->generoService = new GeneroService();
    }
    
    /**
     * Cria uma nova recomendação
     */
    public function criarRecomendacao($dados) {
        $recomendacao = new Recomendacao();
        $recomendacao->setUsuarioId($dados['usuario_id']);
        $recomendacao->setGeneroId($dados['genero_id']);
        $recomendacao->setLivroRecomendado($dados['livro_recomendado']);
        $recomendacao->setAutor($dados['autor'] ?? '');
        $recomendacao->setDescricao($dados['descricao'] ?? '');
        $recomendacao->setNota($dados['nota'] ?? 0);
        
        // Validar dados
        $erros = $recomendacao->validar();
        
        // Verificar se usuário existe
        try {
            $this->usuarioService->buscarUsuario($recomendacao->getUsuarioId());
        } catch (Exception $e) {
            $erros[] = "Usuário não encontrado";
        }
        
        // Verificar se gênero existe
        try {
            $this->generoService->buscarGenero($recomendacao->getGeneroId());
        } catch (Exception $e) {
            $erros[] = "Gênero não encontrado";
        }
        
        if (!empty($erros)) {
            throw new Exception(implode(", ", $erros));
        }
        
        return $this->recomendacaoDAO->inserir($recomendacao);
    }
    
    /**
     * Busca uma recomendação por ID
     */
    public function buscarRecomendacao($id) {
        if (empty($id)) {
            throw new Exception("ID da recomendação é obrigatório");
        }
        
        $recomendacao = $this->recomendacaoDAO->buscarPorId($id);
        if (!$recomendacao) {
            throw new Exception("Recomendação não encontrada");
        }
        
        return $recomendacao;
    }
    
    /**
     * Lista todas as recomendações
     */
    public function listarRecomendacoes() {
        return $this->recomendacaoDAO->listarTodos();
    }
    
    /**
     * Lista recomendações com detalhes (nome do usuário e gênero)
     */
    public function listarRecomendacoesComDetalhes() {
        return $this->recomendacaoDAO->listarComDetalhes();
    }
    
    /**
     * Lista recomendações por usuário
     */
    public function listarPorUsuario($usuarioId) {
        // Verificar se usuário existe
        $this->usuarioService->buscarUsuario($usuarioId);
        
        return $this->recomendacaoDAO->listarPorUsuario($usuarioId);
    }
    
    /**
     * Lista recomendações por gênero
     */
    public function listarPorGenero($generoId) {
        // Verificar se gênero existe
        $this->generoService->buscarGenero($generoId);
        
        return $this->recomendacaoDAO->listarPorGenero($generoId);
    }
    
    /**
     * Atualiza uma recomendação
     */
    public function atualizarRecomendacao($id, $dados) {
        $recomendacao = $this->buscarRecomendacao($id);
        
        $recomendacao->setUsuarioId($dados['usuario_id']);
        $recomendacao->setGeneroId($dados['genero_id']);
        $recomendacao->setLivroRecomendado($dados['livro_recomendado']);
        $recomendacao->setAutor($dados['autor'] ?? '');
        $recomendacao->setDescricao($dados['descricao'] ?? '');
        $recomendacao->setNota($dados['nota'] ?? 0);
        
        // Validar dados
        $erros = $recomendacao->validar();
        
        // Verificar se usuário existe
        try {
            $this->usuarioService->buscarUsuario($recomendacao->getUsuarioId());
        } catch (Exception $e) {
            $erros[] = "Usuário não encontrado";
        }
        
        // Verificar se gênero existe
        try {
            $this->generoService->buscarGenero($recomendacao->getGeneroId());
        } catch (Exception $e) {
            $erros[] = "Gênero não encontrado";
        }
        
        if (!empty($erros)) {
            throw new Exception(implode(", ", $erros));
        }
        
        return $this->recomendacaoDAO->atualizar($recomendacao);
    }
    
    /**
     * Remove uma recomendação
     */
    public function removerRecomendacao($id) {
        $recomendacao = $this->buscarRecomendacao($id);
        
        if (!$this->recomendacaoDAO->remover($id)) {
            throw new Exception("Erro ao remover recomendação");
        }
        
        return true;
    }
    
    /**
     * Busca recomendações por termo
     */
    public function buscarPorTermo($termo) {
        if (empty($termo)) {
            return [];
        }
        
        return $this->recomendacaoDAO->buscarPorTermo($termo);
    }
    
    /**
     * Obtém estatísticas das recomendações
     */
    public function obterEstatisticas() {
        $todasRecomendacoes = $this->listarRecomendacoes();
        $usuarios = $this->usuarioService->listarUsuarios();
        $generos = $this->generoService->listarGeneros();
        
        $estatisticas = [
            'total_recomendacoes' => count($todasRecomendacoes),
            'total_usuarios' => count($usuarios),
            'total_generos' => count($generos),
            'nota_media' => 0
        ];
        
        if (!empty($todasRecomendacoes)) {
            $somaNotas = 0;
            $contadorNotas = 0;
            
            foreach ($todasRecomendacoes as $recomendacao) {
                if ($recomendacao->getNota() > 0) {
                    $somaNotas += $recomendacao->getNota();
                    $contadorNotas++;
                }
            }
            
            if ($contadorNotas > 0) {
                $estatisticas['nota_media'] = round($somaNotas / $contadorNotas, 2);
            }
        }
        
        return $estatisticas;
    }
}
?>

