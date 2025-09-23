# 📚 Sistema de Recomendações de Livros por Gênero

Um sistema web desenvolvido em PHP utilizando o padrão de arquitetura MVC (Model-View-Controller) para gerenciar recomendações de livros baseadas em gêneros literários.

## 🎯 Objetivo

Este projeto foi desenvolvido como trabalho acadêmico para a disciplina de Aplicações para Internet, com o objetivo de demonstrar a implementação prática do padrão MVC e outros padrões de projeto em PHP.

## 🏗️ Arquitetura

O sistema foi desenvolvido seguindo os seguintes padrões de projeto:

- **MVC (Model-View-Controller)**: Separação clara entre lógica de negócio, apresentação e controle
- **DAO (Data Access Object)**: Abstração do acesso aos dados
- **Service**: Encapsulamento das regras de negócio
- **Singleton**: Gerenciamento único da conexão com o banco de dados

## 📋 Funcionalidades

### CRUD Completo para:
- **Usuários**: Cadastro, listagem, edição, visualização e exclusão
- **Gêneros**: Gerenciamento de gêneros literários
- **Recomendações**: Sistema completo de recomendações de livros

### Funcionalidades Adicionais:
- 🔍 Sistema de busca por livros, autores e descrições
- 📊 Dashboard com estatísticas do sistema
- ⭐ Sistema de avaliação com notas de 0 a 5
- 📱 Interface responsiva para dispositivos móveis
- ✅ Validação de dados no frontend e backend
- 🔒 Tratamento de erros e exceções

## 🛠️ Tecnologias Utilizadas

- **Backend**: PHP 7.4+
- **Banco de Dados**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Arquitetura**: MVC com padrões DAO e Service
- **Servidor Web**: Apache/Nginx

## 📁 Estrutura do Projeto

```
sistema-recomendacoes-livros/
├── app/
│   ├── Controllers/          # Controladores MVC
│   │   ├── HomeController.php
│   │   ├── UsuarioController.php
│   │   ├── GeneroController.php
│   │   └── RecomendacaoController.php
│   ├── Models/              # Modelos de dados
│   │   ├── Usuario.php
│   │   ├── Genero.php
│   │   └── Recomendacao.php
│   ├── Views/               # Views (interface)
│   │   ├── layout/
│   │   ├── home/
│   │   ├── usuario/
│   │   ├── genero/
│   │   └── recomendacao/
│   ├── DAO/                 # Data Access Objects
│   │   ├── IUsuarioDAO.php
│   │   ├── UsuarioDAO.php
│   │   ├── IGeneroDAO.php
│   │   ├── GeneroDAO.php
│   │   ├── IRecomendacaoDAO.php
│   │   └── RecomendacaoDAO.php
│   └── Services/            # Camada de serviços
│       ├── UsuarioService.php
│       ├── GeneroService.php
│       └── RecomendacaoService.php
├── config/                  # Configurações
│   ├── config.php
│   └── database.sql
├── core/                    # Classes base
│   ├── Autoload.php
│   ├── Controller.php
│   └── Database/
│       └── MysqlSingleton.php
├── public/                  # Arquivos públicos
│   ├── index.php           # Ponto de entrada
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── script.js
├── routes/                  # Sistema de rotas
│   └── Router.php
└── README.md
```

## 🚀 Instalação e Configuração

### Pré-requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)

### Passo a Passo

1. **Clone o repositório**
   ```bash
   git clone [URL_DO_REPOSITORIO]
   cd sistema-recomendacoes-livros
   ```

2. **Configure o banco de dados**
   - Crie um banco de dados MySQL
   - Execute o script SQL em `config/database.sql`
   - Ajuste as configurações em `config/config.php`

3. **Configure o servidor web**
   - Aponte o DocumentRoot para a pasta `public/`
   - Habilite mod_rewrite (Apache) ou configure URL rewriting (Nginx)

4. **Configuração do Apache (.htaccess)**
   Crie um arquivo `.htaccess` na pasta `public/`:
   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^(.*)$ index.php [QSA,L]
   ```

## 🗄️ Estrutura do Banco de Dados

### Tabela: usuarios
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `nome` (VARCHAR(100), NOT NULL)
- `email` (VARCHAR(100), UNIQUE, NOT NULL)
- `senha` (VARCHAR(255), NOT NULL)
- `data_cadastro` (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)

### Tabela: generos
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `nome` (VARCHAR(100), NOT NULL, UNIQUE)
- `descricao` (TEXT)
- `data_cadastro` (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)

### Tabela: recomendacoes
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `usuario_id` (INT, FOREIGN KEY)
- `genero_id` (INT, FOREIGN KEY)
- `livro_recomendado` (VARCHAR(150), NOT NULL)
- `autor` (VARCHAR(100))
- `descricao` (TEXT)
- `nota` (DECIMAL(3,2), DEFAULT 0.00)
- `data_recomendacao` (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)

## 🎨 Interface do Usuário

O sistema possui uma interface moderna e responsiva com:
- Design limpo e intuitivo
- Navegação clara entre as seções
- Formulários com validação
- Tabelas responsivas para listagens
- Sistema de alertas para feedback
- Dashboard com estatísticas

## 🔧 Funcionalidades Técnicas

### Padrão MVC
- **Models**: Representam as entidades de dados
- **Views**: Interface do usuário em PHP/HTML
- **Controllers**: Lógica de controle e fluxo

### Padrão DAO
- Interfaces para cada entidade
- Implementações concretas para MySQL
- Abstração completa do acesso aos dados

### Padrão Service
- Encapsulamento das regras de negócio
- Validações e processamento de dados
- Orquestração entre DAOs e Models

### Sistema de Rotas
- Roteamento automático baseado em URLs
- Suporte a parâmetros dinâmicos
- Mapeamento para controllers e métodos

## 📊 Funcionalidades do Sistema

### Dashboard
- Estatísticas gerais do sistema
- Recomendações recentes
- Ações rápidas

### Gestão de Usuários
- Cadastro com validação de email único
- Criptografia de senhas
- CRUD completo

### Gestão de Gêneros
- Cadastro de gêneros literários
- Descrições detalhadas
- CRUD completo

### Gestão de Recomendações
- Associação usuário-gênero-livro
- Sistema de notas (0-5)
- Busca avançada
- CRUD completo

## 🔍 Sistema de Busca

O sistema permite buscar recomendações por:
- Nome do livro
- Nome do autor
- Conteúdo da descrição
- Busca case-insensitive

## 🛡️ Segurança

- Validação de dados no frontend e backend
- Proteção contra SQL Injection (PDO com prepared statements)
- Criptografia de senhas (password_hash)
- Sanitização de dados de saída (htmlspecialchars)
- Tratamento de exceções

## 📱 Responsividade

O sistema é totalmente responsivo, adaptando-se a:
- Desktops
- Tablets
- Smartphones

## 🧪 Testes

Para testar o sistema:

1. Acesse a página inicial
2. Cadastre usuários e gêneros
3. Crie recomendações
4. Teste as funcionalidades de busca
5. Verifique o CRUD completo

## 👥 Contribuição

Este projeto foi desenvolvido como trabalho acadêmico. Para contribuições:

1. Fork o projeto
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

## 📄 Licença

Este projeto é desenvolvido para fins educacionais.

## 👨‍💻 Desenvolvedor

Desenvolvido como trabalho da disciplina de Aplicações para Internet.

## 🚀 Demonstração

O sistema implementa todas as funcionalidades solicitadas:
- ✅ Padrão MVC completo
- ✅ Padrões DAO e Service
- ✅ CRUD completo para todas as entidades
- ✅ Interface responsiva
- ✅ Sistema de busca
- ✅ Validações e tratamento de erros
- ✅ Documentação completa

---

**Nota**: Este sistema foi desenvolvido seguindo as melhores práticas de desenvolvimento web com PHP e demonstra a aplicação prática dos conceitos de arquitetura MVC e padrões de projeto.

