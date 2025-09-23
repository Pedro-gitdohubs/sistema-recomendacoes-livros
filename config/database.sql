-- Banco de dados para Sistema de Recomendações de Livros por Gênero
CREATE DATABASE IF NOT EXISTS sistema_recomendacoes_livros;
USE sistema_recomendacoes_livros;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de gêneros
CREATE TABLE generos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    descricao TEXT,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de recomendações
CREATE TABLE recomendacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    genero_id INT,
    livro_recomendado VARCHAR(150) NOT NULL,
    autor VARCHAR(100),
    descricao TEXT,
    nota DECIMAL(3,2) DEFAULT 0.00,
    data_recomendacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (genero_id) REFERENCES generos(id) ON DELETE CASCADE
);

-- Inserindo alguns gêneros padrão
INSERT INTO generos (nome, descricao) VALUES 
('Ficção Científica', 'Livros que exploram conceitos científicos e tecnológicos futuristas'),
('Romance', 'Histórias focadas em relacionamentos amorosos e emocionais'),
('Mistério', 'Livros com enigmas, crimes e investigações'),
('Fantasia', 'Histórias com elementos mágicos e mundos imaginários'),
('Biografia', 'Relatos da vida de pessoas reais'),
('História', 'Livros sobre eventos e períodos históricos'),
('Autoajuda', 'Livros focados no desenvolvimento pessoal'),
('Terror', 'Histórias destinadas a causar medo e suspense'),
('Aventura', 'Livros com jornadas emocionantes e desafiadoras'),
('Drama', 'Histórias com conflitos emocionais intensos');

-- Inserindo alguns usuários de exemplo
INSERT INTO usuarios (nome, email, senha) VALUES 
('João Silva', 'joao@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Maria Santos', 'maria@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Pedro Oliveira', 'pedro@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Inserindo algumas recomendações de exemplo
INSERT INTO recomendacoes (usuario_id, genero_id, livro_recomendado, autor, descricao, nota) VALUES 
(1, 1, 'Duna', 'Frank Herbert', 'Uma épica saga de ficção científica em um universo distante', 4.8),
(1, 4, 'O Senhor dos Anéis', 'J.R.R. Tolkien', 'A clássica trilogia de fantasia épica', 4.9),
(2, 2, 'Orgulho e Preconceito', 'Jane Austen', 'Um romance clássico sobre amor e sociedade', 4.5),
(2, 3, 'O Nome da Rosa', 'Umberto Eco', 'Um mistério medieval em uma abadia italiana', 4.3),
(3, 5, 'Steve Jobs', 'Walter Isaacson', 'A biografia autorizada do fundador da Apple', 4.4),
(3, 6, 'Sapiens', 'Yuval Noah Harari', 'Uma breve história da humanidade', 4.6);

