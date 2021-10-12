-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Set-2021 às 18:24
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `logins`
--

CREATE TABLE `logins` (
  `id` int(10) NOT NULL,
  `usuario` varchar(10) DEFAULT NULL,
  `senha` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `logins`
--

INSERT INTO `logins` (`id`, `usuario`, `senha`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pgcredito`
--

CREATE TABLE `pgcredito` (
  `pagValor` float DEFAULT NULL,
  `pagData` date DEFAULT NULL,
  `idUsuario` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pgdebito`
--

CREATE TABLE `pgdebito` (
  `pagValor` float DEFAULT NULL,
  `pagData` date DEFAULT NULL,
  `idUsuario` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pgdinheiro`
--

CREATE TABLE `pgdinheiro` (
  `pagValor` float DEFAULT NULL,
  `pagData` date DEFAULT NULL,
  `idUsuario` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProd` varchar(10) DEFAULT NULL,
  `nomeProd` varchar(15) DEFAULT NULL,
  `quantProd` int(10) DEFAULT NULL,
  `valorProd` float DEFAULT NULL,
  `idUsuario` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pgcredito`
--
ALTER TABLE `pgcredito`
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `pgdebito`
--
ALTER TABLE `pgdebito`
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `pgdinheiro`
--
ALTER TABLE `pgdinheiro`
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pgcredito`
--
ALTER TABLE `pgcredito`
  ADD CONSTRAINT `pgcredito_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `logins` (`id`);

--
-- Limitadores para a tabela `pgdebito`
--
ALTER TABLE `pgdebito`
  ADD CONSTRAINT `pgdebito_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `logins` (`id`);

--
-- Limitadores para a tabela `pgdinheiro`
--
ALTER TABLE `pgdinheiro`
  ADD CONSTRAINT `pgdinheiro_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `logins` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `logins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
