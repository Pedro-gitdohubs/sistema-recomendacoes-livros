<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header">
        👁️ Detalhes do Usuário
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>ID:</strong> <?= $usuario->getId() ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($usuario->getNome()) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($usuario->getEmail()) ?></p>
                <p><strong>Data de Cadastro:</strong> <?= date('d/m/Y H:i:s', strtotime($usuario->getDataCadastro())) ?></p>
            </div>
        </div>
        
        <div class="form-group mt-4">
            <a href="/usuarios/editar/<?= $usuario->getId() ?>" class="btn btn-warning">✏️ Editar</a>
            <a href="/usuarios" class="btn btn-secondary">⬅️ Voltar</a>
            <a href="javascript:void(0)" 
               onclick="confirmarExclusao('<?= htmlspecialchars($usuario->getNome()) ?>', '/usuarios/remover/<?= $usuario->getId() ?>')" 
               class="btn btn-danger">🗑️ Excluir</a>
        </div>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

