-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Maio-2021 às 21:19
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `econcri`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `idagenda` int(4) NOT NULL,
  `idcadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtagenda` date NOT NULL,
  `hora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `banda`
--

CREATE TABLE `banda` (
  `idbanda` int(4) NOT NULL,
  `idcadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estilo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoral_cover` int(11) NOT NULL,
  `num_integrantes` int(11) NOT NULL,
  `nome_integrantes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `idcadastro` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idcategoria` int(3) NOT NULL,
  `idusuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempo_atuacao` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome_contato` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone_contato` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_contato` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cantor`
--

CREATE TABLE `cantor` (
  `idcantor` int(4) NOT NULL,
  `idcadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estilo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoral_cover` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(3) NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `descricao`) VALUES
(1, 'Ator(a)'),
(2, 'Empresa'),
(3, 'Escritor(a)'),
(4, 'Músico'),
(5, 'Cantor'),
(6, 'Artesão'),
(7, 'Colaborador de backstage'),
(8, 'Banda'),
(10, 'Bar cultural');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chaverecsenha`
--

CREATE TABLE `chaverecsenha` (
  `idchave` int(4) NOT NULL,
  `chave` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `idempresa` int(4) NOT NULL,
  `idcadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `linkvideo`
--

CREATE TABLE `linkvideo` (
  `idlinkvideo` int(4) NOT NULL,
  `idcadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `redesocial`
--

CREATE TABLE `redesocial` (
  `idredesocial` int(4) NOT NULL,
  `idcadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `release`
--

CREATE TABLE `release` (
  `idrelease` int(3) NOT NULL,
  `idcadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkportfolio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `palavraschave` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfil` int(1) NOT NULL COMMENT '1 - adm; 2 - comum',
  `dtcadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `dadosconfirmados` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`idagenda`),
  ADD KEY `agendaCadastro` (`idcadastro`);

--
-- Índices para tabela `banda`
--
ALTER TABLE `banda`
  ADD PRIMARY KEY (`idbanda`),
  ADD KEY `bandaCadastro` (`idcadastro`);

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`idcadastro`),
  ADD KEY `cadastroCategoria` (`idcategoria`),
  ADD KEY `cadastroUsuario` (`idusuario`);

--
-- Índices para tabela `cantor`
--
ALTER TABLE `cantor`
  ADD PRIMARY KEY (`idcantor`),
  ADD KEY `cantorCadastro` (`idcadastro`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Índices para tabela `chaverecsenha`
--
ALTER TABLE `chaverecsenha`
  ADD PRIMARY KEY (`idchave`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`),
  ADD KEY `empresaCadastro` (`idcadastro`);

--
-- Índices para tabela `linkvideo`
--
ALTER TABLE `linkvideo`
  ADD PRIMARY KEY (`idlinkvideo`),
  ADD KEY `linkvideoCadastro` (`idcadastro`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `redesocial`
--
ALTER TABLE `redesocial`
  ADD PRIMARY KEY (`idredesocial`),
  ADD KEY `redesocialCadastro` (`idcadastro`);

--
-- Índices para tabela `release`
--
ALTER TABLE `release`
  ADD PRIMARY KEY (`idrelease`),
  ADD KEY `releaseCadastro` (`idcadastro`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `UQ_2863682842e688ca198eb25c124` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `idagenda` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `banda`
--
ALTER TABLE `banda`
  MODIFY `idbanda` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cantor`
--
ALTER TABLE `cantor`
  MODIFY `idcantor` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `chaverecsenha`
--
ALTER TABLE `chaverecsenha`
  MODIFY `idchave` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresa` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `linkvideo`
--
ALTER TABLE `linkvideo`
  MODIFY `idlinkvideo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `redesocial`
--
ALTER TABLE `redesocial`
  MODIFY `idredesocial` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `release`
--
ALTER TABLE `release`
  MODIFY `idrelease` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agendaCadastro` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`idcadastro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `banda`
--
ALTER TABLE `banda`
  ADD CONSTRAINT `bandaCadastro` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`idcadastro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `cadastroUsuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cadastro_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`);

--
-- Limitadores para a tabela `cantor`
--
ALTER TABLE `cantor`
  ADD CONSTRAINT `cantorCadastro` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`idcadastro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresaCadastro` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`idcadastro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `linkvideo`
--
ALTER TABLE `linkvideo`
  ADD CONSTRAINT `linkvideoCadastro` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`idcadastro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `redesocial`
--
ALTER TABLE `redesocial`
  ADD CONSTRAINT `redesocialCadastro` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`idcadastro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `release`
--
ALTER TABLE `release`
  ADD CONSTRAINT `releaseCadastro` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`idcadastro`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
