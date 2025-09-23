<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header">
        👁️ Detalhes do Gênero
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <p><strong>ID:</strong> <?= $genero->getId() ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($genero->getNome()) ?></p>
                <p><strong>Descrição:</strong></p>
                <div class="border p-3 bg-light">
                    <?= $genero->getDescricao() ? nl2br(htmlspecialchars($genero->getDescricao())) : '<em>Nenhuma descrição fornecida</em>' ?>
                </div>
                <p class="mt-3"><strong>Data de Cadastro:</strong> <?= date('d/m/Y H:i:s', strtotime($genero->getDataCadastro())) ?></p>
            </div>
        </div>
        
        <div class="form-group mt-4">
            <a href="/generos/editar/<?= $genero->getId() ?>" class="btn btn-warning">✏️ Editar</a>
            <a href="/generos" class="btn btn-secondary">⬅️ Voltar</a>
            <a href="javascript:void(0)" 
               onclick="confirmarExclusao('<?= htmlspecialchars($genero->getNome()) ?>', '/generos/remover/<?= $genero->getId() ?>')" 
               class="btn btn-danger">🗑️ Excluir</a>
        </div>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

