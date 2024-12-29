-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Dez-2024 às 15:15
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

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
-- Estrutura da tabela `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Recursos Humanos'),
(2, 'Finanças'),
(3, 'Marketing');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `department_id` int(11) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `documents`
--

INSERT INTO `documents` (`id`, `name`, `description`, `department_id`, `folder`, `file_path`, `user_id`, `upload_time`) VALUES
(4, 'will', 'Este documento vai ser subido para o marketing', 3, 'Marketing', 'uploads/Marketing/Simbologia.pdf', 2, '2024-12-17 10:26:20'),
(6, 'Armando', 'documento para departamento de Recurso Humanos ', 1, 'Recursos Humanos', 'uploads/Recursos Humanos/CONTRATO DE AGENCIAMENTO STARTUPS.pdf', 1, '2024-12-17 10:48:17'),
(7, 'tcc_capítulo_III_software', 'tcc dos finalista do ano lectivo 2024/2025', 2, 'Finanças', 'uploads/Finanças/TCC_Capítulo_III_Software_Tradução (1).pdf', 1, '2024-12-17 12:05:32'),
(8, 'kkk', 'kkkkkk', 3, 'Recursos Humanos', 'uploads/Recursos Humanos/TCC_Capítulo_III_Software_Tradução (1).pdf', 1, '2024-12-17 14:01:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `function` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `function`, `department`, `registration_date`) VALUES
(1, 'jjjj', '$2y$10$U3guEEuWvXMiusnW1Tij2OOmCkosV73cEXvK5YKY8KQF.QHDmEVMO', 'admin', 'Chefe do Departamento', 'Marketing', '2024-12-16 13:50:40'),
(2, 'Will', '$2y$10$/d4pOq293NAXF1HKN6EhSOmc4gbF1KJvJLBROCO/emfdIQH81Kup6', 'user', 'Especialista do Departamento', 'Finanças', '2024-12-16 13:54:45'),
(3, 'Enoque', '$2y$10$248lCZjsUb/rF.XtEsFZ2uVODYcZO2jLjzGN8Zo/dKPTvmkyhH/rS', 'user', 'Técnico do Departamento', 'Marketing', '2024-12-17 11:46:04');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
