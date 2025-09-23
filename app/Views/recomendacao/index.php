<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>⭐ Gerenciar Recomendações</span>
        <a href="/recomendacoes/criar" class="btn btn-success">➕ Nova Recomendação</a>
    </div>
    <div class="card-body">
        <?php if (empty($recomendacoes)): ?>
            <p class="text-center">Nenhuma recomendação cadastrada. <a href="/recomendacoes/criar">Criar primeira recomendação</a></p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Livro</th>
                            <th>Autor</th>
                            <th>Usuário</th>
                            <th>Gênero</th>
                            <th>Nota</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recomendacoes as $recomendacao): ?>
                            <tr>
                                <td><?= $recomendacao['id'] ?></td>
                                <td><?= htmlspecialchars($recomendacao['livro_recomendado']) ?></td>
                                <td><?= htmlspecialchars($recomendacao['autor'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($recomendacao['usuario_nome']) ?></td>
                                <td><?= htmlspecialchars($recomendacao['genero_nome']) ?></td>
                                <td>
                                    <?php if ($recomendacao['nota'] > 0): ?>
                                        <span class="nota"><?= number_format($recomendacao['nota'], 1) ?>/5</span>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y', strtotime($recomendacao['data_recomendacao'])) ?></td>
                                <td>
                                    <a href="/recomendacoes/visualizar/<?= $recomendacao['id'] ?>" class="btn btn-primary btn-sm">👁️ Ver</a>
                                    <a href="/recomendacoes/editar/<?= $recomendacao['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                                    <a href="javascript:void(0)" 
                                       onclick="confirmarExclusao('<?= htmlspecialchars($recomendacao['livro_recomendado']) ?>', '/recomendacoes/remover/<?= $recomendacao['id'] ?>')" 
                                       class="btn btn-danger btn-sm">🗑️ Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                <p><strong>Total:</strong> <?= count($recomendacoes) ?> recomendação(ões) cadastrada(s)</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

