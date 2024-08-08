-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS `letra`;

-- Usar o banco de dados
USE `letra`;

-- Criar a tabela de usuários
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `senha` VARCHAR(100) NOT NULL
    `permissao` INT NOT NULL
);

-- Criar a tabela de hinos
CREATE TABLE IF NOT EXISTS `hinos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `titulo` VARCHAR(100) NOT NULL,
    `autor` VARCHAR(100) NOT NULL,
    `letra` TEXT NOT NULL,
    `usuario_id` INT NOT NULL,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
);

-- Criar um índice na coluna de usuário para melhorar a performance de consultas
CREATE INDEX `idx_usuario_id` ON `hinos` (`usuario_id`);
