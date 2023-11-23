-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/11/2023 às 02:31
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vapo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mp_id` varchar(255) NOT NULL,
  `qr_code` text NOT NULL,
  `items_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items_id`)),
  `valor` float NOT NULL,
  `status` int(11) NOT NULL,
  `envio` int(11) DEFAULT NULL,
  `data` int(25) NOT NULL,
  `data_update` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `data` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `preco` float DEFAULT NULL,
  `promocao` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `titulo`, `imagem`, `descricao`, `preco`, `promocao`) VALUES
(13, ' IGNITE - 1500 PUFFs', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9T00MGnxdU6VH6QIuHIJRv16FvKMzVxr3qg&usqp=CAU', 'Um dos pods mais usados em festas e bailes de sao paulo', 0.3, '0'),
(14, 'IGNITE V50 - 5000 PUFFS', 'https://cdn.sistemawbuy.com.br/arquivos/c8bef0061e66d70da2db9d58afa9255c/produtos/64be99fdd3b0e/e5011af2727bcfe7a38eb18b60cc2f9b-64be99fe0be12.png', 'um dos pods com a melhor entrega de sabores,perfeito para o dia a dia', 0.5, '0'),
(15, 'LIFE POD - 8000 PUFFs', 'https://i0.wp.com/pineapplerec.com/wp-content/uploads/2023/11/LIFE-POD-KIT-ATACADO-PODS.png?resize=300%2C300&ssl=1', 'o mais usado e procurado do momento', 0.7, '0'),
(20, 'Elfbar - 4000 PUFFs', 'https://podzvape.com/wp-content/uploads/2023/06/nikbar-4000-puffs-mango-grape-ice-1.png', 'dsad', 0.3, '0'),
(21, 'ZOMO PARTY Mesh - 800 Puff', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCAaRHNcLn21VaFYV9HLokI3XVpOtIyZvcgQ&usqp=CAU', 'perfeito para sua diversão em festas', 0.1, '0'),
(22, 'NikBar Blue Razz - 6000 Puffs', 'https://vapelandbr.com/wp-content/uploads/2023/05/15174938715_PDNB01.png', 'perfeito para sua diversão em festas', 2, '0'),
(23, 'Bee Bar Gummy - 5000 Puffs', 'https://vapelandbr.com/wp-content/uploads/2023/05/15139750481_Sem20Titulo-2-1.jpg', 'perfeito para sua diversão em festas', 0.25, '0'),
(24, ' Elf Bar APPLE - 10000 Puffs ', 'https://vapelandbr.com/wp-content/uploads/2023/10/15223603495_PODSER13-575x575.png', 'perfeito para sua diversão em festas', 0.6, '0'),
(25, ' RandM  APPLE - 7000 Puffs', 'https://vapelandbr.com/wp-content/uploads/2023/05/15169865122_RDMTR13-575x575.png', 'pod descartável essencial para suas festas e baladas', 1, '0'),
(30, ' Vpengin Jupiter 20000 Puffs – Bubble Gum Ice', 'https://vapelandbr.com/wp-content/uploads/2023/05/15179528963_PDVJ2P01-575x575.png', '', 2, '0'),
(31, 'Vpengin Jupiter 20000 Puffs – Cool Mint Ice', 'https://vapelandbr.com/wp-content/uploads/2023/05/15194302012_PDVJ2P08-575x575.jpg', '', 1, '0'),
(32, 'Vpengin Jupiter 20000 Puffs – Pineapple Ice', 'https://vapelandbr.com/wp-content/uploads/2023/05/15194316332_PDVJ2P07-575x575.png', '', 0.5, '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `end_rua` varchar(100) NOT NULL,
  `end_numero` int(5) NOT NULL,
  `end_estado` varchar(20) NOT NULL,
  `end_cidade` varchar(20) NOT NULL,
  `end_bairro` varchar(20) NOT NULL,
  `end_cep` int(10) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `rank` int(1) NOT NULL DEFAULT 1,
  `hash` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
