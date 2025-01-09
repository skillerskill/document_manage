-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/01/2025 às 01:09
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
-- Banco de dados: `document_manage`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `subfolder` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `status` enum('Aberto','Em andamento','Finalizado') DEFAULT 'Aberto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `documents`
--

INSERT INTO `documents` (`id`, `name`, `description`, `upload_time`, `user_id`, `department_id`, `folder`, `subfolder`, `file_path`, `status`) VALUES
(1, 'Primeiro documento', 'Documento básico', '2025-01-03 17:57:54', 1, 1, 'uploads/Recursos Humanos/Relátorio', 'uploads/Recursos Humanos/Relátorio/1ª Simestre', 'uploads/Recursos Humanos/Relátorio/1ª Simestre/grupo 2 informatica.pdf', 'Finalizado'),
(2, 'grupo n3', 'fdf sdfg', '2025-01-03 18:34:36', 1, 1, 'uploads/Recursos Humanos/Relátorio', 'uploads/Recursos Humanos/Relátorio/1ª Simestre', 'uploads/Recursos Humanos/Relátorio/1ª Simestre/grupo III.pdf', 'Em andamento'),
(8, 'qewfwe ', 'gerg ge', '2025-01-06 09:15:32', 1, 3, 'uploads/Marketing/Publicidade', 'uploads/Marketing/Publicidade/primeiro_passo', 'uploads/Marketing/Publicidade/primeiro_passo/RH grupo 1.pdf', 'Aberto'),
(9, 'gyg', ' yty tytry ', '2025-01-06 09:19:14', 2, 1, 'uploads/Recursos Humanos/Relátorio', 'uploads/Recursos Humanos/Relátorio/1ª Simestre', 'uploads/Recursos Humanos/Relátorio/1ª Simestre/grupo 2 informatica.pdf', 'Em andamento'),
(10, 'armando', 'afsfg', '2025-01-06 09:23:50', 1, 1, 'uploads/Recursos Humanos/Relátorio', 'uploads/Recursos Humanos/Relátorio/1ª Simestre', 'uploads/Recursos Humanos/Relátorio/1ª Simestre/RH grupo 1.pdf', 'Em andamento'),
(11, 'armando22', '222', '2025-01-06 09:30:28', 1, 3, 'uploads/Marketing/Publicidade', 'uploads/Marketing/Publicidade/primeiro_passo', 'uploads/Marketing/Publicidade/primeiro_passo/ultimo tcc.docx', 'Aberto'),
(12, 'wiilll', 'dgsdg ', '2025-01-06 09:38:30', 2, 3, 'uploads/Marketing/Publicidade', 'uploads/Marketing/Publicidade/primeiro_passo', 'uploads/Marketing/Publicidade/primeiro_passo/grupo 2 informatica.pdf', 'Aberto'),
(13, 'wiilll444', 'dgsdg 44', '2025-01-06 10:47:56', 2, 3, 'uploads/Marketing/Publicidade', 'uploads/Marketing/Publicidade/primeiro_passo', 'uploads/Marketing/Publicidade/primeiro_passo/grupo 2 informatica.pdf', 'Aberto'),
(14, 'grupo numero 2', 'finanças', '2025-01-08 23:47:09', 1, 2, 'uploads/Finanças/finanças', 'uploads/Finanças/finanças/Dola americano', 'uploads/Finanças/finanças/Dola americano/plano tecnologico.pdf', 'Aberto');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
