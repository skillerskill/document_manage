-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Jan-2025 às 14:48
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
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(2, 'Finanças'),
(3, 'Marketing'),
(1, 'Recursos Humanos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `subfolder` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('aberto','em andamento','finalizado') DEFAULT 'aberto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `documents`
--

INSERT INTO `documents` (`id`, `name`, `description`, `user_id`, `department_id`, `folder`, `subfolder`, `file_path`, `upload_time`, `status`) VALUES
(1, 'teste', 'ffsdf', 1, 1, 'uploads/Recursos Humanos/Relátorio', 'uploads/Recursos Humanos/Relátorio/Primeiro relátorio', 'uploads/Recursos Humanos/Relátorio/Primeiro relátorio/lista-das-tags-mais-usadas-na-linguagem-html.pdf', '2025-01-09 10:15:35', 'aberto'),
(2, 'outro', 'dwwx', 1, 1, 'uploads/Recursos Humanos/Relátorio', 'uploads/Recursos Humanos/Relátorio/Primeiro relátorio', 'uploads/Recursos Humanos/Relátorio/Primeiro relátorio/resume-example.moises_24 (1).pdf', '2025-01-09 10:20:10', 'em andamento'),
(3, 'teste', 'tEste 1', 1, 2, 'uploads/Finanças/finanças', 'uploads/Finanças/finanças/Relátorio', 'uploads/Finanças/finanças/Relátorio/KOMEMA (1).pdf', '2025-01-09 13:10:28', 'em andamento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `folders`
--

INSERT INTO `folders` (`id`, `name`, `description`, `path`, `department_id`) VALUES
(1, 'Relátorio', 'Está pasta vai constar os relátorios', 'uploads/Recursos Humanos/Relátorio', 1),
(2, 'finanças', 'afff ', 'uploads/Finanças/finanças', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `department_id`, `content`, `is_read`, `created_at`) VALUES
(5, 1, 2, 'oi', 0, '2025-01-09 11:21:56'),
(6, 2, 2, 'efef', 0, '2025-01-09 12:30:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 1, 'Novo documento adicionado: outro', 0, '2025-01-09 10:20:10'),
(2, 1, 'Novo documento adicionado: teste', 0, '2025-01-09 13:10:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subfolders`
--

CREATE TABLE `subfolders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `subfolders`
--

INSERT INTO `subfolders` (`id`, `name`, `description`, `path`, `folder_id`, `created_at`) VALUES
(1, 'Primeiro relátorio', 'wdw wrg w', 'uploads/Recursos Humanos/Relátorio/Primeiro relátorio', 1, '2025-01-09 10:14:52'),
(2, 'Relátorio', 'wefwe rwg', 'uploads/Finanças/finanças/Relátorio', 2, '2025-01-09 13:09:55');

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
(1, 'Armando', '$2y$10$U3guEEuWvXMiusnW1Tij2OOmCkosV73cEXvK5YKY8KQF.QHDmEVMO', 'admin', 'Chefe do Departamento', 'Marketing', '2024-12-16 13:50:40'),
(2, 'Will', '$2y$10$/d4pOq293NAXF1HKN6EhSOmc4gbF1KJvJLBROCO/emfdIQH81Kup6', 'user', 'Especialista do Departamento', 'Finanças', '2024-12-16 13:54:45'),
(3, 'Enoque', '$2y$10$248lCZjsUb/rF.XtEsFZ2uVODYcZO2jLjzGN8Zo/dKPTvmkyhH/rS', 'user', 'Técnico do Departamento', 'Marketing', '2024-12-17 11:46:04');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices para tabela `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Índices para tabela `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Índices para tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Índices para tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `subfolders`
--
ALTER TABLE `subfolders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folder_id` (`folder_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `subfolders`
--
ALTER TABLE `subfolders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `subfolders`
--
ALTER TABLE `subfolders`
  ADD CONSTRAINT `subfolders_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
