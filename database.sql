-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 26/11/2023 às 15:33
-- Versão do servidor: 10.5.20-MariaDB
-- Versão do PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id21119202_socorrodb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamados`
--

CREATE TABLE `chamados` (
  `idchamado` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `unidade` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `problema` varchar(40) NOT NULL,
  `data_atendimento` datetime NOT NULL,
  `solucao` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL,
  `operador` varchar(30) NOT NULL DEFAULT '',
  `data_resolvido` datetime NOT NULL,
  `anexo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `chamados`
--

INSERT INTO `chamados` (`idchamado`, `idusuario`, `usuario`, `unidade`, `data`, `descricao`, `problema`, `data_atendimento`, `solucao`, `status`, `operador`, `data_resolvido`, `anexo`) VALUES
(1, 1, 'Administrador', 'Canoas - RS', '2023-11-22 21:51:58', 'teste', 'Suporte técnico', '2023-11-22 21:53:55', 'Solucionado', 'Resolvido', ' admin@socorro.com.br', '2023-11-22 21:54:01', ''),
(2, 1, 'Administrador', 'Canoas - RS', '2023-11-22 21:53:15', 'teste', 'Suporte operacional', '2023-11-22 21:54:10', 'solução', 'Validação', ' admin@socorro.com.br', '0000-00-00 00:00:00', ''),
(3, 1, 'Administrador', 'Canoas - RS', '2023-11-22 21:54:41', 'teste com anexo', 'Suporte técnico', '2023-11-22 23:12:24', 'anexo recebido', 'Validação', ' matheus.loreto@rede.ulbra.br', '0000-00-00 00:00:00', 'uploads/a8d727cbcaa17c78370c72bcb12b93e8.jpg'),
(4, 5, 'Usuario Socorro', 'Canoas - RS', '2023-11-26 11:56:12', 'Não consigo acessar o sistema X.', 'Suporte operacional', '2023-11-26 11:57:14', 'Sistema reestabelecido.', 'Resolvido', ' operador@socorro.com.br', '2023-11-26 12:04:09', 'uploads/c0709e37b0d71bc437db123c555fa708.jpg'),
(5, 5, 'Usuario Socorro', 'Canoas - RS', '2023-11-26 11:57:38', 'Manchas na impressão.', 'Impressora', '2023-11-26 12:01:56', 'Substituída a unidade de imagem.', 'Resolvido', ' operador@socorro.com.br', '0000-00-00 00:00:00', ''),
(6, 5, 'Usuario Socorro', 'Canoas - RS', '2023-11-26 12:06:25', 'Minha internet não está funcionando!', 'Rede', '0000-00-00 00:00:00', '', 'Pendente', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidades`
--

CREATE TABLE `unidades` (
  `idunidade` int(11) NOT NULL,
  `unidade` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `unidades`
--

INSERT INTO `unidades` (`idunidade`, `unidade`, `status`) VALUES
(1, 'Canoas - RS', 'Ativo'),
(2, 'Torres - RS', 'Ativo'),
(3, 'Santa Maria - RS', 'Ativo'),
(4, 'Gravataí - RS', 'Ativo'),
(5, 'Itumbiara - GO', 'Ativo'),
(6, 'Palmas - TO', 'Ativo'),
(7, 'Porto Alegre - RS', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `datacadastro` datetime NOT NULL,
  `dados_status` varchar(10) NOT NULL,
  `data_exclusao` datetime NOT NULL,
  `primeira_vez` tinyint(1) NOT NULL,
  `tp_usuario` varchar(50) NOT NULL DEFAULT 'usuario',
  `unidade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `senha`, `datacadastro`, `dados_status`, `data_exclusao`, `primeira_vez`, `tp_usuario`, `unidade`) VALUES
(1, 'Administrador', 'admin@socorro.com.br', 'd25a8fc276c44edc719bf2f6283ec684', '2023-11-22 20:12:06', 'Ativo', '0000-00-00 00:00:00', 0, 'admin', 'Canoas - RS'),
(4, 'Matheus Loreto', 'matheus.loreto@rede.ulbra.br', '82b54e160284d86eadc42a2c56ade9ca', '2023-11-22 21:43:16', 'Inativo', '0000-00-00 00:00:00', 0, 'operador', 'Canoas - RS'),
(5, 'Usuario Socorro', 'usuario@socorro.com.br', '4d29c966aaea7a0d1bd731cbed61b77a', '2023-11-23 00:34:24', 'Ativo', '0000-00-00 00:00:00', 0, 'usuario', 'Canoas - RS'),
(6, 'Operador Socorro', 'operador@socorro.com.br', 'c2169d274554cb586b4105dd3f0e8320', '2023-11-26 11:49:32', 'Ativo', '0000-00-00 00:00:00', 0, 'operador', 'Canoas - RS');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chamados`
--
ALTER TABLE `chamados`
  ADD PRIMARY KEY (`idchamado`);

--
-- Índices de tabela `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`idunidade`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chamados`
--
ALTER TABLE `chamados`
  MODIFY `idchamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `unidades`
--
ALTER TABLE `unidades`
  MODIFY `idunidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
