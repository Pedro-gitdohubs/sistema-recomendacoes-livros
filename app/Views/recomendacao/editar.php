<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header">
        ✏️ Editar Recomendação
    </div>
    <div class="card-body">
        <form method="POST" action="/recomendacoes/atualizar/<?= $recomendacao->getId() ?>">
            <div class="form-group">
                <label for="usuario_id" class="form-label">Usuário *</label>
                <select id="usuario_id" name="usuario_id" class="form-control" required>
                    <option value="">Selecione um usuário</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario->getId() ?>" <?= $usuario->getId() == $recomendacao->getUsuarioId() ? 'selected' : '' ?>>
                            <?= htmlspecialchars($usuario->getNome()) ?> (<?= htmlspecialchars($usuario->getEmail()) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="genero_id" class="form-label">Gênero *</label>
                <select id="genero_id" name="genero_id" class="form-control" required>
                    <option value="">Selecione um gênero</option>
                    <?php foreach ($generos as $genero): ?>
                        <option value="<?= $genero->getId() ?>" <?= $genero->getId() == $recomendacao->getGeneroId() ? 'selected' : '' ?>>
                            <?= htmlspecialchars($genero->getNome()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="livro_recomendado" class="form-label">Nome do Livro *</label>
                <input type="text" id="livro_recomendado" name="livro_recomendado" class="form-control" 
                       value="<?= htmlspecialchars($recomendacao->getLivroRecomendado()) ?>" required maxlength="150">
            </div>
            
            <div class="form-group">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" id="autor" name="autor" class="form-control" 
                       value="<?= htmlspecialchars($recomendacao->getAutor() ?? '') ?>" maxlength="100">
            </div>
            
            <div class="form-group">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4"><?= htmlspecialchars($recomendacao->getDescricao() ?? '') ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="nota" class="form-label">Nota (0 a 5)</label>
                <input type="number" id="nota" name="nota" class="form-control" min="0" max="5" step="0.1" 
                       value="<?= $recomendacao->getNota() ?? 0 ?>">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">💾 Atualizar</button>
                <a href="/recomendacoes" class="btn btn-secondary">❌ Cancelar</a>
                <a href="/recomendacoes/visualizar/<?= $recomendacao->getId() ?>" class="btn btn-primary">👁️ Visualizar</a>
            </div>
        </form>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

