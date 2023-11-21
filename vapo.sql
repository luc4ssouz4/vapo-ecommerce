-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 20/11/2023 às 23:43
-- Versão do servidor: 10.4.27-MariaDB
-- Versão do PHP: 8.2.0

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
(3, 'Vape124545', 'https://png.pngtree.com/png-vector/20220710/ourmid/pngtree-vape-icon-illustration-png-png-image_5837016.png', 'vapizinhoo test 123', 4.3, '0'),
(4, 'Vape2', 'https://png.pngtree.com/png-vector/20220710/ourmid/pngtree-vape-icon-illustration-png-png-image_5837016.png', 'vapizinhoo', 0.3, '0'),
(7, 'dsfdsf', 'https://sen.voopoo.com.cn/www-voopoo/static/dist/images/product/detail/drag2/drag4.png?v=38f13c8f3e', 'sdfsdfsdfdsfdsfdsfsdfdsfsfdf', 1.8, '1'),
(9, 'Vape1', 'https://png.pngtree.com/png-vector/20220710/ourmid/pngtree-vape-icon-illustration-png-png-image_5837016.png', 'vapizinhoo', 0.3, '1'),
(12, 'derfhgfhgfh', '', 'gfhgfhgfhfghfgh', 555, '0');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
