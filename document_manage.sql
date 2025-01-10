-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/01/2025 às 12:03
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
-- Estrutura para tabela `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Recursos Humanos'),
(2, 'Finanças'),
(3, 'Marketing'),
(4, 'Novo_Messi');

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `path` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `folders`
--

INSERT INTO `folders` (`id`, `name`, `description`, `department_id`, `created_at`, `path`) VALUES
(1, 'Relátorio', 'Relátorio do RH', 1, '2025-01-03 17:53:13', 'uploads/Recursos Humanos/Relátorio'),
(2, 'Publicidade', 'Pasta para publicidade', 3, '2025-01-05 23:39:56', 'uploads/Marketing/Publicidade'),
(3, 'finanças', 'wf ewg', 2, '2025-01-08 23:46:18', 'uploads/Finanças/finanças');

-- --------------------------------------------------------

--
-- Estrutura para tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `department_id`, `timestamp`, `content`, `is_read`) VALUES
(1, 1, 2, '2025-01-08 10:03:41', 'Olá Finança', 0),
(2, 2, 0, '2025-01-08 10:04:59', 'Estou Bem obrigado', 0),
(3, 1, 2, '2025-01-08 10:21:10', 'oiiiii finnna', 0),
(4, 2, 0, '2025-01-08 10:22:51', 'estamos fixes', 0),
(5, 2, 0, '2025-01-08 10:23:40', 'estamos fixesf', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 2, 'Novo documento adicionado: rre', 1, '2025-01-06 08:40:05'),
(2, 1, 'Novo documento adicionado: qewfwe ', 0, '2025-01-06 09:15:32'),
(3, 2, 'Novo documento adicionado: gyg', 1, '2025-01-06 09:19:14'),
(4, 1, 'Novo documento adicionado: armando', 0, '2025-01-06 09:23:50'),
(5, 1, 'Novo documento adicionado: armando22', 0, '2025-01-06 09:30:28'),
(6, 2, 'Novo documento adicionado: wiilll', 0, '2025-01-06 09:38:30'),
(7, 2, 'Novo documento adicionado: wiilll444', 0, '2025-01-06 10:47:56'),
(8, 1, 'Novo documento adicionado: grupo numero 2', 0, '2025-01-08 23:47:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `subfolders`
--

CREATE TABLE `subfolders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `folder_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `path` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `subfolders`
--

INSERT INTO `subfolders` (`id`, `name`, `description`, `folder_id`, `created_at`, `path`) VALUES
(1, '1ª Simestre', 'Relátorio do 1 ª simestre', 1, '2025-01-03 17:54:43', 'uploads/Recursos Humanos/Relátorio/1ª Simestre'),
(2, 'primeiro_passo', 'sa dsg s', 2, '2025-01-05 23:50:10', 'uploads/Marketing/Publicidade/primeiro_passo'),
(3, 'Dola americano', 'e egsrg', 3, '2025-01-08 23:46:37', 'uploads/Finanças/finanças/Dola americano');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
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
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `function`, `department`, `registration_date`) VALUES
(1, 'Armando', '$2y$10$ZBac6oFGxZ/L7c9a/xSoJ.oyqSjd1pPOMRdz2.a3iSUDQVeQtJNhq', 'admin', 'Chefe do Departamento', 'Recursos Humanos', '2024-12-16 13:50:40'),
(2, 'Will', '$2y$10$QRVbbCkauTeSDdbRIiSwpu7B0KGQWFs25yYZazZe5VLHi5YJrMld.', 'user', 'Especialista do Departamento', 'Finanças', '2024-12-16 13:54:45');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Índices de tabela `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Índices de tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `subfolders`
--
ALTER TABLE `subfolders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folder_id` (`folder_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `subfolders`
--
ALTER TABLE `subfolders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Restrições para tabelas `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Restrições para tabelas `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `subfolders`
--
ALTER TABLE `subfolders`
  ADD CONSTRAINT `subfolders_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
