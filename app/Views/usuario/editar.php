<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header">
        ✏️ Editar Usuário
    </div>
    <div class="card-body">
        <form method="POST" action="/usuarios/atualizar/<?= $usuario->getId() ?>">
            <div class="form-group">
                <label for="nome" class="form-label">Nome *</label>
                <input type="text" id="nome" name="nome" class="form-control" 
                       value="<?= htmlspecialchars($usuario->getNome()) ?>" required maxlength="100">
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email *</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="<?= htmlspecialchars($usuario->getEmail()) ?>" required maxlength="100">
            </div>
            
            <div class="form-group">
                <label for="senha" class="form-label">Nova Senha</label>
                <input type="password" id="senha" name="senha" class="form-control" minlength="6">
                <small class="form-text text-muted">Deixe em branco para manter a senha atual</small>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">💾 Atualizar</button>
                <a href="/usuarios" class="btn btn-secondary">❌ Cancelar</a>
                <a href="/usuarios/visualizar/<?= $usuario->getId() ?>" class="btn btn-primary">👁️ Visualizar</a>
            </div>
        </form>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

