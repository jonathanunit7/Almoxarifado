-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 31/03/2025 às 02:38
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
-- Banco de dados: `prototipo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `id_emprestimo` int(11) NOT NULL,
  `cpf_solicitante` varchar(255) NOT NULL,
  `data_emprestimo` datetime NOT NULL,
  `solicitante` varchar(255) NOT NULL,
  `nome_equipamento` varchar(255) NOT NULL,
  `codigo_de_barras` int(11) NOT NULL,
  `data_inicio_emprestimo` datetime NOT NULL,
  `data_fim_emprestimo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id`, `id_emprestimo`, `cpf_solicitante`, `data_emprestimo`, `solicitante`, `nome_equipamento`, `codigo_de_barras`, `data_inicio_emprestimo`, `data_fim_emprestimo`) VALUES
(60, 1, '40504052888', '2025-03-29 21:21:28', 'Jonathan', 'Microfone Sennheiser MK4', 100085, '2025-03-08 12:00:00', '2025-03-11 12:00:00'),
(62, 2, '40504052888', '2025-03-30 21:00:16', 'Jonathan', 'Notebook HP Pavilion', 100032, '2025-03-01 12:00:00', '2025-03-08 12:00:00'),
(63, 2, '40504052888', '2025-03-30 21:00:34', 'Jonathan', 'Mouse Microsoft', 100018, '2025-03-01 12:00:00', '2025-03-08 12:00:00'),
(64, 2, '40504052888', '2025-03-30 21:00:34', 'Jonathan', 'Microfone Samson Q2U', 100045, '2025-03-01 12:00:00', '2025-03-08 12:00:00'),
(65, 3, '40504052888', '2025-03-31 02:11:15', 'Jonathan', 'Mouse Corsair M65', 100088, '2025-03-01 12:00:00', '2025-03-08 12:00:00'),
(66, 1, '40504052888', '2025-03-31 02:11:59', 'Jonathan', 'Câmera Panasonic Lumix', 100031, '2025-03-08 12:00:00', '2025-03-11 12:00:00'),
(67, 1, '40504052888', '2025-03-31 02:11:59', 'Jonathan', 'Microfone AKG C214', 100025, '2025-03-08 12:00:00', '2025-03-11 12:00:00'),
(69, 4, '40504052888', '2025-03-31 02:28:13', 'Jonathan', 'Microfone AKG P220', 100065, '2025-03-01 12:00:00', '2025-03-08 18:35:00'),
(70, 4, '40504052888', '2025-03-31 02:28:13', 'Jonathan', 'Câmera Fujifilm X-T4', 100041, '2025-03-01 12:00:00', '2025-03-08 18:35:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `codigoDeBarra` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `equipamento`
--

INSERT INTO `equipamento` (`id`, `nome`, `tipo`, `codigoDeBarra`, `status`) VALUES
(2, 'Notebook Dell Inspiron', 'Informática', '100002', 'Disponível'),
(3, 'Projetor Epson', 'Áudio e Vídeo', '100003', 'disponível'),
(19, 'Teclado Redragon Kumara', 'Periféricos', '100019', 'disponível'),
(22, 'Notebook Acer Aspire', 'Informática', '100022', 'disponível'),
(24, 'Mesa de Som Mackie', 'Áudio', '100024', 'disponível'),
(25, 'Microfone AKG C214', 'Áudio', '100025', 'disponível'),
(28, 'Mouse Razer DeathAdder', 'Periféricos', '100028', 'disponível'),
(29, 'Teclado HyperX Alloy', 'Periféricos', '100029', 'disponível'),
(30, 'SSD 1TB Samsung', 'Armazenamento', '100030', 'disponível'),
(31, 'Câmera Panasonic Lumix', 'Fotografia', '100031', 'disponível'),
(32, 'Notebook HP Pavilion', 'Informática', '100032', 'disponível'),
(33, 'Projetor Optoma', 'Áudio e Vídeo', '100033', 'disponível'),
(34, 'Mesa de Som Soundcraft', 'Áudio', '100034', 'disponível'),
(35, 'Microfone Blue Yeti', 'Áudio', '100035', 'disponível'),
(36, 'Monitor BenQ 32\"', 'Informática', '100036', 'disponível'),
(37, 'Impressora Brother HL', 'Periféricos', '100037', 'disponível'),
(38, 'Mouse Corsair Dark Core', 'Periféricos', '100038', 'disponível'),
(39, 'Teclado Logitech G Pro', 'Periféricos', '100039', 'disponível'),
(40, 'HD Externo 2TB Toshiba', 'Armazenamento', '100040', 'disponível'),
(41, 'Câmera Fujifilm X-T4', 'Fotografia', '100041', 'disponível'),
(42, 'Notebook MSI GF63', 'Informática', '100042', 'disponível'),
(43, 'Projetor ViewSonic', 'Áudio e Vídeo', '100043', 'disponível'),
(44, 'Mesa de Som Roland', 'Áudio', '100044', 'disponível'),
(45, 'Microfone Samson Q2U', 'Áudio', '100045', 'disponível'),
(46, 'Monitor Acer Predator', 'Informática', '100046', 'disponível'),
(47, 'Impressora Samsung ML', 'Periféricos', '100047', 'disponível'),
(48, 'Mouse SteelSeries Rival', 'Periféricos', '100048', 'disponível'),
(49, 'Teclado Razer BlackWidow', 'Periféricos', '100049', 'disponível'),
(50, 'SSD 256GB Crucial', 'Armazenamento', '100050', 'disponível'),
(51, 'Câmera Olympus OM-D', 'Fotografia', '100051', 'disponível'),
(52, 'Notebook Asus ROG', 'Informática', '100052', 'disponível'),
(53, 'Projetor Vivitek', 'Áudio e Vídeo', '100053', 'disponível'),
(54, 'Mesa de Som Presonus', 'Áudio', '100054', 'disponível'),
(55, 'Microfone Audio-Technica AT2020', 'Áudio', '100055', 'disponível'),
(56, 'Monitor Philips 27\"', 'Informática', '100056', 'disponível'),
(57, 'Impressora Canon ImageClass', 'Periféricos', '100057', 'disponível'),
(58, 'Mouse Logitech G703', 'Periféricos', '100058', 'disponível'),
(59, 'Teclado Corsair K95', 'Periféricos', '100059', 'disponível'),
(60, 'SSD 1TB Western Digital', 'Armazenamento', '100060', 'disponível'),
(62, 'Notebook Samsung Expert', 'Informática', '100062', 'disponível'),
(63, 'Projetor LG PF50KG', 'Áudio e Vídeo', '100063', 'disponível'),
(64, 'Mesa de Som Tascam', 'Áudio', '100064', 'disponível'),
(65, 'Microfone AKG P220', 'Áudio', '100065', 'disponível'),
(66, 'Monitor AOC 24\"', 'Informática', '100066', 'disponível'),
(67, 'Impressora Epson Workforce', 'Periféricos', '100067', 'disponível'),
(68, 'Mouse Logitech G502', 'Periféricos', '100068', 'disponível'),
(69, 'Teclado Razer Huntsman', 'Periféricos', '100069', 'disponível'),
(70, 'HD Externo 4TB WD', 'Armazenamento', '100070', 'disponível'),
(71, 'Câmera Kodak Pixpro', 'Fotografia', '100071', 'disponível'),
(72, 'Notebook Toshiba Satellite', 'Informática', '100072', 'disponível'),
(73, 'Projetor Casio XJ-UT', 'Áudio e Vídeo', '100073', 'disponível'),
(74, 'Mesa de Som Alesis', 'Áudio', '100074', 'disponível'),
(75, 'Microfone Shure SM7B', 'Áudio', '100075', 'disponível'),
(76, 'Monitor ViewSonic VX', 'Informática', '100076', 'disponível'),
(77, 'Impressora Lexmark MS', 'Periféricos', '100077', 'disponível'),
(78, 'Mouse Microsoft Sculpt', 'Periféricos', '100078', 'disponível'),
(79, 'Teclado Logitech K780', 'Periféricos', '100079', 'disponível'),
(80, 'SSD 512GB SanDisk', 'Armazenamento', '100080', 'disponível'),
(81, 'Câmera Polaroid Now', 'Fotografia', '100081', 'disponível'),
(82, 'Notebook Fujitsu Lifebook', 'Informática', '100082', 'disponível'),
(83, 'Projetor Eiki', 'Áudio e Vídeo', '100083', 'disponível'),
(84, 'Mesa de Som Behringer X32', 'Áudio', '100084', 'disponível'),
(85, 'Microfone Sennheiser MK4', 'Áudio', '100085', 'disponível'),
(86, 'Monitor LG 32\"', 'Informática', '100086', 'disponível'),
(87, 'Impressora Xerox Phaser', 'Periféricos', '100087', 'disponível'),
(88, 'Mouse Corsair M65', 'Periféricos', '100088', 'disponível'),
(89, 'Teclado SteelSeries Apex', 'Periféricos', '100089', 'disponível'),
(90, 'HD Externo 500GB LaCie', 'Armazenamento', '100090', 'disponível'),
(91, 'Câmera Ricoh GR III', 'Fotografia', '100091', 'disponível'),
(92, 'Notebook Gateway', 'Informática', '100092', 'disponível'),
(93, 'Projetor Hitachi CP-X3022WN', 'Áudio e Vídeo', '100093', 'disponível'),
(94, 'Mesa de Som Yamaha MG', 'cabo', '100094', 'disponível'),
(95, 'Microfone Beyerdynamic M201', 'Áudio', '100095', 'disponível'),
(96, 'Monitor ASUS VG', 'Informática', '100096', 'disponível'),
(97, 'Impressora Brother HL-L', 'Periféricos', '100097', 'disponível'),
(98, 'Mouse Logitech MX Master', 'Periféricos', '100098', 'disponível'),
(99, 'Teclado Redragon K582', 'Periféricos', '100099', 'disponível'),
(100, 'SSD 2TB Intel', 'Armazenamento', '100100', 'disponível'),
(102, 'jonathan', 'jonathan', '1000131212', 'disponível'),
(103, 'jonathan', 'jonathan', '1212121', 'disponível'),
(104, 'jonathan', 'jonathan', '1000131212', 'disponível');

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `id_equipamento` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `data_manutencao` datetime NOT NULL DEFAULT current_timestamp(),
  `responsavel` varchar(255) NOT NULL,
  `custo` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `historico`
--

INSERT INTO `historico` (`id`, `id_equipamento`, `descricao`, `data_manutencao`, `responsavel`, `custo`) VALUES
(23, 2, 'testeo', '2025-05-20 00:00:00', 'Carlos Silva', 250.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `perfil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `email`, `perfil`) VALUES
(1, 'teste1', 'teste12', '$2y$10$eDpI/mFvhfDs97oMopGjkeQtKSBsy9LaiO73wuW3e2EYqYgtDSQTi', 'teste@teste.com', 'Almoxerife'),
(11, 'teste', 'teste', '$2y$10$I4t3BvNBZqpZOnaFDCY20OUTkLulyLeSdz534tASccoGjcVTd7i3m', 'teste@teste.com', 'Almoxerife');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_equipamento` (`id_equipamento`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`id_equipamento`) REFERENCES `equipamento` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
