<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header">
        ➕ Criar Novo Usuário
    </div>
    <div class="card-body">
        <form method="POST" action="/usuarios/salvar">
            <div class="form-group">
                <label for="nome" class="form-label">Nome *</label>
                <input type="text" id="nome" name="nome" class="form-control" required maxlength="100">
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email *</label>
                <input type="email" id="email" name="email" class="form-control" required maxlength="100">
            </div>
            
            <div class="form-group">
                <label for="senha" class="form-label">Senha *</label>
                <input type="password" id="senha" name="senha" class="form-control" required minlength="6">
                <small class="form-text text-muted">A senha deve ter pelo menos 6 caracteres</small>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">💾 Salvar</button>
                <a href="/usuarios" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

