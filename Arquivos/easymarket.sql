-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23-Ago-2021 às 17:12
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `easymarket`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCategoria` varchar(255) NOT NULL,
  `removido` varchar(3) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nomeCategoria`, `removido`) VALUES
(1, 'Frios', ''),
(2, 'Padaria', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `idProduto` int(255) NOT NULL AUTO_INCREMENT,
  `codigoProduto` varchar(255) NOT NULL,
  `nomeProduto` varchar(255) NOT NULL,
  `fotoProduto` varchar(255) NOT NULL,
  `marcaProduto` varchar(255) NOT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `precoProduto` varchar(255) NOT NULL,
  `precoPromocao` varchar(255) NOT NULL,
  `pesoProduto` varchar(255) NOT NULL,
  `unidadePeso` varchar(20) NOT NULL,
  `localizacaoProduto` varchar(255) NOT NULL,
  `avaliacaoProduto` varchar(255) NOT NULL,
  `descricaoProduto` text NOT NULL,
  `destaqueProduto` varchar(3) NOT NULL,
  `removido` varchar(3) NOT NULL,
  PRIMARY KEY (`idProduto`),
  KEY `categoria_produto` (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `codigoProduto`, `nomeProduto`, `fotoProduto`, `marcaProduto`, `idCategoria`, `precoProduto`, `precoPromocao`, `pesoProduto`, `unidadePeso`, `localizacaoProduto`, `avaliacaoProduto`, `descricaoProduto`, `destaqueProduto`, `removido`) VALUES
(1, '679325693245', 'teste', '822d666b75c20d2948286812117b801d50050.png', 'marca', 2, '34', '31', '12', 'ml', 'a34', '01', '&lt;p&gt;bjhivflasduog&lt;/p&gt;', '', ''),
(2, 'sdfg456', 'papaco', '988358304052217595e1342384eb966514652.png', 'Papaco', 1, '45', '40', '12', 'ml', 'f35t', '15', '&lt;p&gt;papapapapaco&lt;/p&gt;', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `funcao` varchar(255) NOT NULL,
  `contaAtiva` varchar(255) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `cpf`, `nome`, `email`, `senha`, `funcao`, `contaAtiva`) VALUES
(1, '0', 'admin ', 'admin@easymarket.com', '21232f297a57a5a743894a0e4a801fc3', 'adm', '');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `categoria_produto` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
