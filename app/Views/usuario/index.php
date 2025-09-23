<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>👥 Gerenciar Usuários</span>
        <a href="/usuarios/criar" class="btn btn-success">➕ Novo Usuário</a>
    </div>
    <div class="card-body">
        <?php if (empty($usuarios)): ?>
            <p class="text-center">Nenhum usuário cadastrado. <a href="/usuarios/criar">Criar primeiro usuário</a></p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data de Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= $usuario->getId() ?></td>
                                <td><?= htmlspecialchars($usuario->getNome()) ?></td>
                                <td><?= htmlspecialchars($usuario->getEmail()) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($usuario->getDataCadastro())) ?></td>
                                <td>
                                    <a href="/usuarios/visualizar/<?= $usuario->getId() ?>" class="btn btn-primary btn-sm">👁️ Ver</a>
                                    <a href="/usuarios/editar/<?= $usuario->getId() ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                                    <a href="javascript:void(0)" 
                                       onclick="confirmarExclusao('<?= htmlspecialchars($usuario->getNome()) ?>', '/usuarios/remover/<?= $usuario->getId() ?>')" 
                                       class="btn btn-danger btn-sm">🗑️ Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                <p><strong>Total:</strong> <?= count($usuarios) ?> usuário(s) cadastrado(s)</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

