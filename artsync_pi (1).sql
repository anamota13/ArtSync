-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2024 às 23:36
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `artsync_pi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `obras`
--

CREATE TABLE `obras` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `artista` varchar(100) NOT NULL,
  `ano` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `obras`
--

INSERT INTO `obras` (`id`, `titulo`, `artista`, `ano`, `descricao`, `imagem`, `created_at`) VALUES
(17, 'A Noite Estrelada', 'Vicente Van Gogh', 1889, 'A Noite Estrelada é uma pintura de Vincent van Gogh de 1889. A obra retrata a vista da janela de um quarto do hospício de Saint-Rémy-de-Provence, pouco antes do nascer do sol, com a adição de um vilarejo idealizado pelo artista. ', 'van_gogh.jfif', '2024-10-10 20:40:02'),
(18, 'Mulher no Espelho', 'Pablo Picasso', 1932, 'Garota diante de um espelho é um óleo sobre tela de Pablo Picasso, que ele criou em 1932. A pintura é um retrato da amante e musa de Picasso, Marie-Thérèse Walter, que é retratada em frente a um espelho olhando para seu reflexo.', 'pablo_picasso.jpg', '2024-10-10 20:45:17'),
(19, 'Uma Tarde de Domingo na Ilha de Grande Jatte', 'Georges Seurat', 1884, 'Uma Tarde de Domingo na Ilha de Grande Jatte é uma pintura a óleo da autoria do pintor francês Georges-Pierre Seurat, integrante do Movimento Impressionista. É considerada sua obra mais destacada, feita em pontilhismo nos anos de 1884-86. Retrata a Ilha de Grande Jatte.', 'georges.jfif', '2024-10-10 20:51:10'),
(27, 'O Beijo ', 'Gustav Klimt', 1907, 'O beijo é uma pintura a óleo com adição de folhas de ouro, prata e platina do pintor simbolista austríaco Gustav Klimt. Foi criada em algum ponto entre 1907 e 1908, no período que os estudiosos da arte chamam de \"Fase Dourada\". Foi exibida em 1908 com o título de Liebespaar conforme constava no catálogo da exposição', 'O Beijo.jfif', '2024-10-24 14:24:30'),
(28, 'Os comedores de Batata', 'Vicent Van Gogh', 1885, 'O verdadeiro significado do quadro \'Os Comedores de Batata\' vai além de uma simples cena da vida camponesa. Para Van Gogh, a obra representava uma homenagem à vida dura e humilde dos trabalhadores rurais, que ele considerava os pilares invisíveis da sociedade.', 'Os comedores de batata.jfif', '2024-10-24 15:40:39'),
(29, 'Campo de Paupolas', 'Claude Monet', 1873, 'O Campo de Papoulas perto de Argenteuil é uma pintura de paisagem a óleo sobre tela do impressionista francês Claude Monet, concluída em 1873. Após a sua doação ao Estado francês em 1906 por Étienne Moreau-Nélaton, foi alojado sucessivamente no Louvre, no Musée des Arts Décoratifs e no Jeu de Paume.', 'Campo de Paupolas.jfif', '2024-10-24 15:42:15'),
(31, 'Operários', 'Tarsila do Amaral', 1933, 'Operários é uma obra de arte pintada por Tarsila do Amaral em 1933 e que retrata a situação dos trabalhadores no início da industrialização do estado de São Paulo. A obra está exposta no Palácio Boa Vista e faz parte do acervo do Governo do Estado de São Paulo. ', 'Tarsila do Amaral.webp', '2024-10-24 15:49:34'),
(32, 'O Artesão', 'Vicente do Rego Monteiro', 1922, '\"O Artesão\", de Vicente do Rego Monteiro, reflete a fusão entre formas geométricas e a estética das culturas indígenas brasileiras, características marcantes do artista. A obra apresenta figuras simplificadas e linhas rígidas, evocando a simetria e a harmonia típicas de trabalhos manuais. ', 'O Artesão.jfif', '2024-10-24 15:52:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reservas`
--

INSERT INTO `reservas` (`id`, `data`, `horario`, `usuario_id`) VALUES
(109, '2024-10-01', '10:00:00', NULL),
(110, '2024-12-03', '09:00:00', NULL),
(111, '2024-11-14', '14:00:00', NULL),
(112, '2024-11-20', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reset_senha`
--

CREATE TABLE `reset_senha` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expiracao` datetime NOT NULL,
  `usado` tinyint(1) DEFAULT 0,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reset_senha`
--

INSERT INTO `reset_senha` (`id`, `email`, `token`, `expiracao`, `usado`, `criado_em`) VALUES
(9, 'miguelsoares3005@gmail.com', '9747b8f3b4b490b02dc54afeca46fa7772bf1967cc62194212fc3542fb2f5e3e', '2024-10-24 03:05:11', 0, '2024-10-24 00:05:11'),
(10, 'miguelsoares3005@gmail.com', '52f4daa877134b405e5df6f0c239a28d31b518b6ac12dd0a7386ee0a941e1166', '2024-10-24 03:11:10', 0, '2024-10-24 00:11:10'),
(11, 'miguelsoares3005@gmail.com', '685e616ba68301b4856917a43c1be4dacde27c8d297e3ede1849edfa08c12780', '2024-10-24 03:15:32', 0, '2024-10-24 00:15:32'),
(12, 'miguelsoares3005@gmail.com', 'deb40d402588f30bf41b6558c3095bf98f99dab4a94bdceae894fbc3a1224ce2', '2024-10-24 03:26:31', 0, '2024-10-24 00:26:31'),
(13, 'miguelsoares3005@gmail.com', '7585eea033bf945811a4d136766b281f7a7ba06ad7880f6cdcb9930471458467', '2024-10-24 03:33:39', 0, '2024-10-24 00:33:39'),
(14, 'miguelsoares3005@gmail.com', 'c13304552542e7a066be6debeb8fa65d3bf5eb301d2f199af7495c72b39c365b', '2024-10-24 03:38:08', 0, '2024-10-24 00:38:08'),
(15, 'miguelsoares3005@gmail.com', 'db1e387288e7f47961ee5c07f0a29d466a33d46e2a2181f4dcc8272ab5bf29a1', '2024-10-24 03:42:20', 0, '2024-10-24 00:42:20'),
(16, 'miguelsoares3005@gmail.com', '1e2cedb5b08010234941984bed1989539f61b475f198e53726ae110e5bec31df', '2024-10-23 22:46:38', 0, '2024-10-24 00:46:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('visitante','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_usuario`, `email`, `senha`, `tipo`, `created_at`) VALUES
(23, 'Lauane Toledo', 'lauanegabtoledo@gmail.com', '$2y$10$0nVlT1jGcZAA3Z9Pgbi4qufQO8LjH4rzc7zxffKUpCcBlu9K98KEi', 'admin', '2024-10-11 22:40:11'),
(24, 'Ana Teste', 'anateste@gmail.com', '$2y$10$P5cnvXi9NLVXUDSt8ZfvBOCdXyWsY43cDSRgKnGb53K6ArzLpHxfy', 'visitante', '2024-10-14 11:36:04'),
(25, 'Miguel Luperi', 'miguelluperi@gmail.com', '$2y$10$JFGrYcIpcXmTQMiyeBajrOXl2zi6lUe345fNvA/uSWAilLNvDJ82i', 'visitante', '2024-10-15 00:28:06'),
(26, 'Miguel Luperi', 'miguelsoares3005@gmail.com', '$2y$10$/O2XMRDJyx6jgBqjVB5/0OiL9sOsug8/PHrQKIw6lCHkJkzUHUYyy', 'visitante', '2024-10-21 13:49:27'),
(27, 'carla ', 'carlaalvescarvalhobenedito@gmail.com', '$2y$10$jvCEMa2lyX9QICM1Evzh2OTiymSRWpW7N2Dhqa/T2Dg1IVNc5Sl3S', 'visitante', '2024-10-25 00:22:34'),
(34, 'Ana Júlia ', 'anajuliaalvesmota@gmail.com', '$2y$10$4DG.fSxReTZSUaC2JtQSyuRrvcJyhtM0B2wKderTCvdIIaHUTGnVa', 'admin', '2024-11-11 22:45:58'),
(38, 'Ana ', 'anaamota06@gmail.com', '$2y$10$iTWEOBRFsCXukczC0nwXeO4sKgPAJrXXd9ii5OMvNhwogGBmN3EpS', 'visitante', '2024-11-19 21:24:57');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `reset_senha`
--
ALTER TABLE `reset_senha`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de tabela `reset_senha`
--
ALTER TABLE `reset_senha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
