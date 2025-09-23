<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>📖 Gerenciar Gêneros</span>
        <a href="/generos/criar" class="btn btn-success">➕ Novo Gênero</a>
    </div>
    <div class="card-body">
        <?php if (empty($generos)): ?>
            <p class="text-center">Nenhum gênero cadastrado. <a href="/generos/criar">Criar primeiro gênero</a></p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Data de Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($generos as $genero): ?>
                            <tr>
                                <td><?= $genero->getId() ?></td>
                                <td><?= htmlspecialchars($genero->getNome()) ?></td>
                                <td><?= htmlspecialchars(substr($genero->getDescricao() ?? '', 0, 100)) ?><?= strlen($genero->getDescricao() ?? '') > 100 ? '...' : '' ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($genero->getDataCadastro())) ?></td>
                                <td>
                                    <a href="/generos/visualizar/<?= $genero->getId() ?>" class="btn btn-primary btn-sm">👁️ Ver</a>
                                    <a href="/generos/editar/<?= $genero->getId() ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                                    <a href="javascript:void(0)" 
                                       onclick="confirmarExclusao('<?= htmlspecialchars($genero->getNome()) ?>', '/generos/remover/<?= $genero->getId() ?>')" 
                                       class="btn btn-danger btn-sm">🗑️ Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                <p><strong>Total:</strong> <?= count($generos) ?> gênero(s) cadastrado(s)</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

