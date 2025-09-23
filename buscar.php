<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header">
        🔍 Buscar Recomendações
    </div>
    <div class="card-body">
        <form method="GET" action="/buscar" class="search-form">
            <input type="text" name="termo" class="form-control" 
                   placeholder="Digite o nome do livro, autor ou descrição..." 
                   value="<?= htmlspecialchars($termo ?? '') ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
</div>

<?php if (isset($termo) && !empty($termo)): ?>
    <div class="card">
        <div class="card-header">
            📋 Resultados da Busca por "<?= htmlspecialchars($termo) ?>"
        </div>
        <div class="card-body">
            <?php if (empty($recomendacoes)): ?>
                <p class="text-center">Nenhuma recomendação encontrada para o termo pesquisado.</p>
                <div class="text-center">
                    <a href="/buscar" class="btn btn-secondary">Nova Busca</a>
                    <a href="/recomendacoes/criar" class="btn btn-success">Criar Recomendação</a>
                </div>
            <?php else: ?>
                <p class="mb-3"><strong><?= count($recomendacoes) ?></strong> recomendação(ões) encontrada(s):</p>
                
                <?php foreach ($recomendacoes as $recomendacao): ?>
                    <div class="recomendacao-item">
                        <div class="recomendacao-titulo">
                            <?= htmlspecialchars($recomendacao['livro_recomendado']) ?>
                        </div>
                        <?php if (!empty($recomendacao['autor'])): ?>
                            <div class="recomendacao-autor">
                                por <?= htmlspecialchars($recomendacao['autor']) ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($recomendacao['descricao'])): ?>
                            <p><?= htmlspecialchars($recomendacao['descricao']) ?></p>
                        <?php endif; ?>
                        <div class="recomendacao-meta">
                            <div>
                                <strong>Usuário:</strong> <?= htmlspecialchars($recomendacao['usuario_nome']) ?> |
                                <strong>Gênero:</strong> <?= htmlspecialchars($recomendacao['genero_nome']) ?>
                            </div>
                            <div>
                                <?php if ($recomendacao['nota'] > 0): ?>
                                    <span class="nota"><?= number_format($recomendacao['nota'], 1) ?>/5</span>
                                <?php endif; ?>
                                <a href="/recomendacoes/visualizar/<?= $recomendacao['id'] ?>" class="btn btn-primary btn-sm">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-header">
            💡 Dicas de Busca
        </div>
        <div class="card-body">
            <ul>
                <li>Digite o nome do livro que você está procurando</li>
                <li>Busque pelo nome do autor</li>
                <li>Use palavras-chave da descrição</li>
                <li>A busca não diferencia maiúsculas de minúsculas</li>
                <li>Use pelo menos 3 caracteres para melhores resultados</li>
            </ul>
        </div>
    </div>
<?php endif; ?>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

