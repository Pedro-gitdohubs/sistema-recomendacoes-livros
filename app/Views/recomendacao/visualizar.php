<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header">
        👁️ Detalhes da Recomendação
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h3><?= htmlspecialchars($recomendacao->getLivroRecomendado()) ?></h3>
                <?php if ($recomendacao->getAutor()): ?>
                    <p class="text-muted"><strong>Autor:</strong> <?= htmlspecialchars($recomendacao->getAutor()) ?></p>
                <?php endif; ?>
                
                <hr>
                
                <p><strong>ID:</strong> <?= $recomendacao->getId() ?></p>
                <p><strong>Usuário:</strong> <?= htmlspecialchars($recomendacao->getUsuarioId()) ?></p>
                <p><strong>Gênero:</strong> <?= htmlspecialchars($recomendacao->getGeneroId()) ?></p>
                
                <?php if ($recomendacao->getNota() > 0): ?>
                    <p><strong>Nota:</strong> <span class="nota"><?= number_format($recomendacao->getNota(), 1) ?>/5</span></p>
                <?php endif; ?>
                
                <p><strong>Data da Recomendação:</strong> <?= date('d/m/Y H:i:s', strtotime($recomendacao->getDataRecomendacao())) ?></p>
                
                <?php if ($recomendacao->getDescricao()): ?>
                    <div class="mt-4">
                        <strong>Descrição:</strong>
                        <div class="border p-3 bg-light mt-2">
                            <?= nl2br(htmlspecialchars($recomendacao->getDescricao())) ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="form-group mt-4">
            <a href="/recomendacoes/editar/<?= $recomendacao->getId() ?>" class="btn btn-warning">✏️ Editar</a>
            <a href="/recomendacoes" class="btn btn-secondary">⬅️ Voltar</a>
            <a href="javascript:void(0)" 
               onclick="confirmarExclusao('<?= htmlspecialchars($recomendacao->getLivroRecomendado()) ?>', '/recomendacoes/remover/<?= $recomendacao->getId() ?>')" 
               class="btn btn-danger">🗑️ Excluir</a>
        </div>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

