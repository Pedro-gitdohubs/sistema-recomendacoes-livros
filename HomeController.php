<?php
/**
 * Controller para a página inicial
 */
class HomeController extends Controller {
    private $recomendacaoService;
    
    public function __construct() {
        $this->recomendacaoService = new RecomendacaoService();
    }
    
    /**
     * Página inicial
     */
    public function index() {
        try {
            $recomendacoes = $this->recomendacaoService->listarRecomendacoesComDetalhes();
            $estatisticas = $this->recomendacaoService->obterEstatisticas();
            
            $this->render('home/index', [
                'recomendacoes' => $recomendacoes,
                'estatisticas' => $estatisticas,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage("Erro ao carregar página inicial: " . $e->getMessage());
            $this->render('home/index', [
                'recomendacoes' => [],
                'estatisticas' => [],
                'error_message' => $this->getErrorMessage()
            ]);
        }
    }
    
    /**
     * Busca recomendações
     */
    public function buscar() {
        $termo = $this->getGet('termo', '');
        
        try {
            if (!empty($termo)) {
                $recomendacoes = $this->recomendacaoService->buscarPorTermo($termo);
            } else {
                $recomendacoes = $this->recomendacaoService->listarRecomendacoesComDetalhes();
            }
            
            $this->render('home/buscar', [
                'recomendacoes' => $recomendacoes,
                'termo' => $termo,
                'success_message' => $this->getSuccessMessage(),
                'error_message' => $this->getErrorMessage()
            ]);
        } catch (Exception $e) {
            $this->setErrorMessage("Erro na busca: " . $e->getMessage());
            $this->render('home/buscar', [
                'recomendacoes' => [],
                'termo' => $termo,
                'error_message' => $this->getErrorMessage()
            ]);
        }
    }
}
?>

