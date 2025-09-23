<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header">
        📊 Estatísticas do Sistema
    </div>
    <div class="card-body">
        <div class="stats">
            <div class="stat-card">
                <span class="stat-number"><?= $estatisticas['total_recomendacoes'] ?? 0 ?></span>
                <span class="stat-label">Recomendações</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?= $estatisticas['total_usuarios'] ?? 0 ?></span>
                <span class="stat-label">Usuários</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?= $estatisticas['total_generos'] ?? 0 ?></span>
                <span class="stat-label">Gêneros</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?= $estatisticas['nota_media'] ?? 0 ?></span>
                <span class="stat-label">Nota Média</span>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        ⭐ Recomendações Recentes
    </div>
    <div class="card-body">
        <?php if (empty($recomendacoes)): ?>
            <p class="text-center">Nenhuma recomendação encontrada. <a href="/recomendacoes/criar">Criar primeira recomendação</a></p>
        <?php else: ?>
            <?php foreach (array_slice($recomendacoes, 0, 10) as $recomendacao): ?>
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
                        <?php if ($recomendacao['nota'] > 0): ?>
                            <div class="nota"><?= number_format($recomendacao['nota'], 1) ?>/5</div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="text-center mt-3">
                <a href="/recomendacoes" class="btn btn-primary">Ver Todas as Recomendações</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="card">
    <div class="card-header">
        🚀 Ações Rápidas
    </div>
    <div class="card-body text-center">
        <a href="/recomendacoes/criar" class="btn btn-success">➕ Nova Recomendação</a>
        <a href="/usuarios/criar" class="btn btn-primary">👤 Novo Usuário</a>
        <a href="/generos/criar" class="btn btn-warning">📖 Novo Gênero</a>
        <a href="/buscar" class="btn btn-secondary">🔍 Buscar Livros</a>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

