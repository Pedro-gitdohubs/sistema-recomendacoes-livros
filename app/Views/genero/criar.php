<?php include dirname(__DIR__) . '/layout/header.php'; ?>

<div class="card">
    <div class="card-header">
        ➕ Criar Novo Gênero
    </div>
    <div class="card-body">
        <form method="POST" action="/generos/salvar">
            <div class="form-group">
                <label for="nome" class="form-label">Nome *</label>
                <input type="text" id="nome" name="nome" class="form-control" required maxlength="100">
            </div>
            
            <div class="form-group">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4" 
                          placeholder="Descreva as características deste gênero literário..."></textarea>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">💾 Salvar</button>
                <a href="/generos" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include dirname(__DIR__) . '/layout/footer.php'; ?>

