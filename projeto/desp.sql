-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/04/2025 às 02:18
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
-- Banco de dados: `sistema_despesas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `desp`
--

CREATE TABLE `desp` (
  `id_desp` int(11) NOT NULL,
  `DESPESA` varchar(20) DEFAULT NULL,
  `DATA_DA_DESPESA` varchar(20) DEFAULT NULL,
  `CATEGORIA` varchar(50) DEFAULT NULL,
  `FORMA_DE_PAGAMENTO` varchar(20) DEFAULT NULL,
  `PARCELAMENTO` varchar(20) DEFAULT NULL,
  `TIPO_DE_DESPESA` varchar(20) DEFAULT NULL,
  `VALOR` decimal(10,2) NOT NULL,
  `DESCRIÇÃO` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `desp`
--
ALTER TABLE `desp`
  ADD PRIMARY KEY (`id_desp`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `desp`
--
ALTER TABLE `desp`
  MODIFY `id_desp` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
