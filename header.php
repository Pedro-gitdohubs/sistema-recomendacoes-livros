<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistema de Recomendações de Livros' ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>📚 Sistema de Recomendações de Livros</h1>
            <p>Descubra novos livros baseados em seus gêneros favoritos</p>
        </div>
    </header>
    
    <nav class="nav">
        <div class="container">
            <ul>
                <li><a href="/">🏠 Início</a></li>
                <li><a href="/usuarios">👥 Usuários</a></li>
                <li><a href="/generos">📖 Gêneros</a></li>
                <li><a href="/recomendacoes">⭐ Recomendações</a></li>
                <li><a href="/buscar">🔍 Buscar</a></li>
            </ul>
        </div>
    </nav>
    
    <main class="main">
        <div class="container">
            <?php if (isset($success_message) && $success_message): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success_message) ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error_message) && $error_message): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>

