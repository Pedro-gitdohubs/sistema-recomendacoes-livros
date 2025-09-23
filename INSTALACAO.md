# 🚀 Guia de Instalação - Sistema de Recomendações de Livros

## Pré-requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache ou Nginx)
- Git (opcional)

## Instalação Passo a Passo

### 1. Baixar o Projeto

```bash
# Opção 1: Clone do repositório (se disponível)
git clone [URL_DO_REPOSITORIO]
cd sistema-recomendacoes-livros

# Opção 2: Download direto
# Baixe e extraia o arquivo ZIP do projeto
```

### 2. Configurar o Banco de Dados

1. **Criar o banco de dados:**
   ```sql
   CREATE DATABASE sistema_recomendacoes_livros;
   ```

2. **Executar o script SQL:**
   - Abra o arquivo `config/database.sql`
   - Execute todo o conteúdo no seu cliente MySQL
   - Isso criará as tabelas e dados de exemplo

3. **Configurar a conexão:**
   - Edite o arquivo `config/config.php`
   - Ajuste as constantes de conexão:
   ```php
   const DB_HOST = 'localhost';     // Seu host MySQL
   const DB_NAME = 'sistema_recomendacoes_livros';
   const DB_USER = 'root';          // Seu usuário MySQL
   const DB_PASS = '';              // Sua senha MySQL
   ```

### 3. Configurar o Servidor Web

#### Apache

1. **Configurar Virtual Host:**
   ```apache
   <VirtualHost *:80>
       ServerName sistema-livros.local
       DocumentRoot /caminho/para/sistema-recomendacoes-livros/public
       
       <Directory /caminho/para/sistema-recomendacoes-livros/public>
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

2. **Criar arquivo .htaccess na pasta public:**
   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^(.*)$ index.php [QSA,L]
   ```

3. **Adicionar ao /etc/hosts:**
   ```
   127.0.0.1 sistema-livros.local
   ```

#### Nginx

```nginx
server {
    listen 80;
    server_name sistema-livros.local;
    root /caminho/para/sistema-recomendacoes-livros/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 4. Configurar Permissões

```bash
# Dar permissões de escrita (se necessário)
chmod -R 755 sistema-recomendacoes-livros/
chown -R www-data:www-data sistema-recomendacoes-livros/
```

### 5. Testar a Instalação

1. Acesse: `http://sistema-livros.local`
2. Você deve ver a página inicial do sistema
3. Teste as funcionalidades básicas:
   - Navegação entre páginas
   - Listagem de dados
   - Criação de registros

## Solução de Problemas

### Erro de Conexão com Banco

```
Erro na conexão com o banco de dados
```

**Solução:**
- Verifique as configurações em `config/config.php`
- Confirme se o MySQL está rodando
- Teste a conexão manualmente

### Erro 404 nas Rotas

```
Página não encontrada
```

**Solução:**
- Verifique se o mod_rewrite está habilitado (Apache)
- Confirme se o .htaccess está na pasta public
- Verifique as configurações do Nginx

### Erro de Permissão

```
Permission denied
```

**Solução:**
- Ajuste as permissões das pastas
- Verifique o usuário do servidor web

### Erro de PHP

```
Parse error ou Fatal error
```

**Solução:**
- Verifique a versão do PHP (mínimo 7.4)
- Confirme se todas as extensões estão instaladas

## Dados de Teste

O sistema vem com dados de exemplo:

### Usuários:
- João Silva (joao@email.com)
- Maria Santos (maria@email.com)
- Pedro Oliveira (pedro@email.com)

### Gêneros:
- Ficção Científica
- Romance
- Mistério
- Fantasia
- E outros...

### Recomendações:
- Várias recomendações de exemplo já cadastradas

## Próximos Passos

Após a instalação:

1. **Explore o sistema:**
   - Navegue pelas diferentes seções
   - Teste o CRUD completo
   - Use a funcionalidade de busca

2. **Personalize:**
   - Adicione seus próprios dados
   - Customize o CSS se desejar
   - Ajuste configurações conforme necessário

3. **Desenvolvimento:**
   - O código está bem documentado
   - Siga os padrões estabelecidos
   - Faça backup antes de modificações

## Suporte

Para dúvidas sobre a instalação:
1. Verifique este guia novamente
2. Consulte o README.md
3. Analise os logs de erro do servidor
4. Verifique a documentação do código

---

**Boa sorte com o sistema! 📚✨**

