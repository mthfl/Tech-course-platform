-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 06/11/2025 às 05:05
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
-- Banco de dados: `curso_dev`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

CREATE TABLE `atividades` (
  `id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `tipo` enum('questionario','projeto','exercicio') DEFAULT 'questionario',
  `ordem` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atividades`
--

INSERT INTO `atividades` (`id`, `modulo_id`, `titulo`, `descricao`, `tipo`, `ordem`, `ativo`) VALUES
(1, 1, 'Quiz: Conceitos Básicos do Git', 'Teste seus conhecimentos sobre os fundamentos do Git', 'questionario', 1, 1),
(2, 1, 'Exercício: Primeiro Repositório', 'Crie seu primeiro repositório Git', 'exercicio', 2, 1),
(3, 2, 'Quiz: Branches e Merge', 'Avalie seu entendimento sobre branches', 'questionario', 1, 1),
(4, 2, 'Projeto: Trabalhando com Branches', 'Pratique criação e merge de branches', 'projeto', 2, 1),
(5, 3, 'Quiz: Github Básico', 'Teste seus conhecimentos sobre Github', 'questionario', 1, 1),
(6, 3, 'Projeto: Colaboração em Equipe', 'Trabalhe em um projeto colaborativo no Github', 'projeto', 2, 1),
(7, 4, 'Quiz: Conhecendo o Padlet', 'Avalie seu conhecimento sobre Padlet', 'questionario', 1, 1),
(8, 4, 'Exercício: Criando seu Primeiro Padlet', 'Crie e configure um Padlet', 'exercicio', 2, 1),
(9, 5, 'Quiz: Gestão de Sprint', 'Teste seus conhecimentos sobre gestão de sprint', 'questionario', 1, 1),
(10, 5, 'Projeto: Organizando uma Sprint', 'Organize uma sprint completa no Padlet', 'projeto', 2, 1),
(11, 6, 'Quiz: Fundamentos do React', 'Avalie seu conhecimento sobre React', 'questionario', 1, 1),
(12, 6, 'Exercício: Primeiro Componente React', 'Crie seu primeiro componente React', 'exercicio', 2, 1),
(13, 7, 'Quiz: Vue.js Básico', 'Teste seus conhecimentos sobre Vue.js', 'questionario', 1, 1),
(14, 7, 'Projeto: Aplicação Vue', 'Desenvolva uma aplicação simples com Vue.js', 'projeto', 2, 1),
(15, 8, 'Quiz: Angular Essencial', 'Avalie seu entendimento sobre Angular', 'questionario', 1, 1),
(16, 8, 'Exercício: Componentes Angular', 'Pratique criação de componentes no Angular', 'exercicio', 2, 1),
(17, 9, 'Quiz: FPDF Básico', 'Teste seus conhecimentos sobre FPDF', 'questionario', 1, 1),
(18, 9, 'Exercício: Gerando seu Primeiro PDF', 'Crie um PDF usando FPDF', 'exercicio', 2, 1),
(19, 10, 'Quiz: Bibliotecas de Documentos', 'Avalie seu conhecimento sobre bibliotecas', 'questionario', 1, 1),
(20, 10, 'Projeto: Sistema de Relatórios', 'Desenvolva um sistema completo de geração de relatórios', 'projeto', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras_cursos`
--

CREATE TABLE `compras_cursos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `preco_pago_coins` int(11) NOT NULL,
  `data_compra` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `compras_cursos`
--

INSERT INTO `compras_cursos` (`id`, `usuario_id`, `curso_id`, `preco_pago_coins`, `data_compra`) VALUES
(1, 1, 2, 40, '2025-11-05 23:53:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem_capa` varchar(255) DEFAULT NULL,
  `nivel_requerido` enum('iniciante','intermediario','avancado') NOT NULL,
  `preco_coins` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`id`, `titulo`, `descricao`, `imagem_capa`, `nivel_requerido`, `preco_coins`, `ativo`, `data_criacao`) VALUES
(1, 'Git e Github com Boas Práticas', 'Aprenda Git e Github com boas práticas e muita atividade em equipe. Desenvolva suas habilidades de controle de versão e colaboração em projetos reais.', NULL, 'intermediario', 80, 1, '2025-11-05 23:50:48'),
(2, 'Padlet: Colaboração e Gestão de Sprint', 'Aprenda a usar e atualizar o Padlet com prática associada às ações da sprint. Domine ferramentas de colaboração e organização de equipe.', NULL, 'iniciante', 40, 1, '2025-11-05 23:50:48'),
(3, 'Frameworks Frontend', 'Explore os principais frameworks frontend do mercado. Aprenda React, Vue, Angular e outras tecnologias modernas para desenvolvimento web.', NULL, 'intermediario', 100, 1, '2025-11-05 23:50:48'),
(4, 'FPDF e Outras Bibliotecas', 'Domine a geração de PDFs com FPDF e outras bibliotecas essenciais. Aprenda a criar documentos profissionais programaticamente.', NULL, 'intermediario', 80, 1, '2025-11-05 23:50:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `ordem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `modulos`
--

INSERT INTO `modulos` (`id`, `curso_id`, `titulo`, `descricao`, `ordem`) VALUES
(1, 1, 'Fundamentos do Git', 'Aprenda os conceitos básicos do Git e controle de versão', 1),
(2, 1, 'Trabalhando com Branches', 'Domine o uso de branches e merge no Git', 2),
(3, 1, 'Github e Colaboração', 'Aprenda a usar Github para trabalho em equipe', 3),
(4, 2, 'Introdução ao Padlet', 'Conheça a ferramenta Padlet e suas funcionalidades', 1),
(5, 2, 'Gestão de Sprint com Padlet', 'Organize e gerencie sprints usando Padlet', 2),
(6, 3, 'Introdução ao React', 'Fundamentos do React e componentes', 1),
(7, 3, 'Vue.js Essencial', 'Aprenda os conceitos básicos do Vue.js', 2),
(8, 3, 'Angular Fundamentals', 'Introdução ao framework Angular', 3),
(9, 4, 'Introdução ao FPDF', 'Aprenda a gerar PDFs com FPDF', 1),
(10, 4, 'Bibliotecas Avançadas', 'Explore outras bibliotecas para geração de documentos', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `niveis_usuario`
--

CREATE TABLE `niveis_usuario` (
  `nivel` enum('iniciante','intermediario','avancado','premium') NOT NULL,
  `xp_necessario` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `niveis_usuario`
--

INSERT INTO `niveis_usuario` (`nivel`, `xp_necessario`, `descricao`) VALUES
('iniciante', 0, 'Acesso a cursos básicos'),
('intermediario', 1000, 'Acesso a cursos intermediários'),
('avancado', 3000, 'Acesso a cursos avançados'),
('premium', 5000, 'Acesso a todos os cursos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcoes_pergunta`
--

CREATE TABLE `opcoes_pergunta` (
  `id` int(11) NOT NULL,
  `pergunta_id` int(11) NOT NULL,
  `texto_opcao` text NOT NULL,
  `correta` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `opcoes_pergunta`
--

INSERT INTO `opcoes_pergunta` (`id`, `pergunta_id`, `texto_opcao`, `correta`) VALUES
(1, 1, 'Um sistema de controle de versão distribuído', 1),
(2, 1, 'Um editor de texto', 0),
(3, 1, 'Um banco de dados', 0),
(4, 1, 'Uma linguagem de programação', 0),
(5, 2, 'git init', 1),
(6, 2, 'git start', 0),
(7, 2, 'git create', 0),
(8, 2, 'git new', 0),
(9, 3, 'Salva as alterações no repositório local', 1),
(10, 3, 'Envia alterações para o servidor remoto', 0),
(11, 3, 'Cria uma nova branch', 0),
(12, 3, 'Deleta arquivos do repositório', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  `pergunta` text NOT NULL,
  `tipo` enum('multipla_escolha','verdadeiro_falso','texto_livre') DEFAULT 'multipla_escolha',
  `ordem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perguntas`
--

INSERT INTO `perguntas` (`id`, `atividade_id`, `pergunta`, `tipo`, `ordem`) VALUES
(1, 1, 'O que é Git?', 'multipla_escolha', 1),
(2, 1, 'Qual comando inicializa um repositório Git?', 'multipla_escolha', 2),
(3, 1, 'O que faz o comando git commit?', 'multipla_escolha', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `recompensas`
--

CREATE TABLE `recompensas` (
  `id` int(11) NOT NULL,
  `tipo_referencia` enum('video','atividade','curso_conclusao') NOT NULL,
  `referencia_id` int(11) NOT NULL,
  `coins` int(11) DEFAULT 0,
  `xp` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `recompensas`
--

INSERT INTO `recompensas` (`id`, `tipo_referencia`, `referencia_id`, `coins`, `xp`) VALUES
(1, 'atividade', 1, 10, 50),
(2, 'atividade', 2, 15, 75),
(3, 'atividade', 3, 10, 50),
(4, 'atividade', 4, 20, 100),
(5, 'atividade', 5, 10, 50),
(6, 'atividade', 6, 25, 125),
(7, 'atividade', 7, 10, 50),
(8, 'atividade', 8, 15, 75),
(9, 'atividade', 9, 10, 50),
(10, 'atividade', 10, 20, 100),
(11, 'atividade', 11, 15, 75),
(12, 'atividade', 12, 20, 100),
(13, 'atividade', 13, 15, 75),
(14, 'atividade', 14, 25, 125),
(15, 'atividade', 15, 15, 75),
(16, 'atividade', 16, 20, 100),
(17, 'atividade', 17, 15, 75),
(18, 'atividade', 18, 20, 100),
(19, 'atividade', 19, 15, 75),
(20, 'atividade', 20, 30, 150);

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas_usuarios`
--

CREATE TABLE `respostas_usuarios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pergunta_id` int(11) NOT NULL,
  `resposta_texto` text DEFAULT NULL,
  `opcao_escolhida_id` int(11) DEFAULT NULL,
  `data_resposta` datetime DEFAULT current_timestamp(),
  `pontuacao` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacoes`
--

CREATE TABLE `transacoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo` enum('coins','xp') NOT NULL,
  `operacao` enum('entrada','saida') NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `referencia_id` int(11) DEFAULT NULL,
  `tipo_referencia` enum('video','atividade','curso','compra','outro') DEFAULT NULL,
  `data_transacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `nivel_conta` enum('iniciante','intermediario','avancado','premium') DEFAULT 'iniciante',
  `coins` int(11) DEFAULT 0,
  `xp_total` int(11) DEFAULT 0,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`, `nivel_conta`, `coins`, `xp_total`, `ativo`) VALUES
(1, 'Matheus Felix', 'matheus.dev91@gmail.com', '$2y$10$nbtrumXfdUGNSJIQZbrtU.VqAr0x4hqF.RgO.00lTgi6ikQxjY9Eq', '2025-11-05 23:48:40', 'intermediario', 60, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `drive_file_id` varchar(100) NOT NULL,
  `drive_embed_link` varchar(500) NOT NULL,
  `ordem` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `videos_assistidos`
--

CREATE TABLE `videos_assistidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `data_assistido` datetime DEFAULT current_timestamp(),
  `progresso` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_modulo_id` (`modulo_id`),
  ADD KEY `idx_ordem` (`ordem`),
  ADD KEY `idx_ativo` (`ativo`);

--
-- Índices de tabela `compras_cursos`
--
ALTER TABLE `compras_cursos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_compra_usuario_curso` (`usuario_id`,`curso_id`),
  ADD KEY `idx_usuario_id` (`usuario_id`),
  ADD KEY `idx_curso_id` (`curso_id`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_nivel_requerido` (`nivel_requerido`),
  ADD KEY `idx_ativo` (`ativo`);

--
-- Índices de tabela `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_curso_id` (`curso_id`),
  ADD KEY `idx_ordem` (`ordem`);

--
-- Índices de tabela `niveis_usuario`
--
ALTER TABLE `niveis_usuario`
  ADD PRIMARY KEY (`nivel`),
  ADD KEY `idx_xp_necessario` (`xp_necessario`);

--
-- Índices de tabela `opcoes_pergunta`
--
ALTER TABLE `opcoes_pergunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_pergunta_id` (`pergunta_id`),
  ADD KEY `idx_correta` (`correta`);

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_atividade_id` (`atividade_id`),
  ADD KEY `idx_ordem` (`ordem`);

--
-- Índices de tabela `recompensas`
--
ALTER TABLE `recompensas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_recompensa` (`tipo_referencia`,`referencia_id`),
  ADD KEY `idx_tipo_referencia` (`tipo_referencia`),
  ADD KEY `idx_referencia_id` (`referencia_id`);

--
-- Índices de tabela `respostas_usuarios`
--
ALTER TABLE `respostas_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opcao_escolhida_id` (`opcao_escolhida_id`),
  ADD KEY `idx_usuario_id` (`usuario_id`),
  ADD KEY `idx_pergunta_id` (`pergunta_id`);

--
-- Índices de tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario_id` (`usuario_id`),
  ADD KEY `idx_data_transacao` (`data_transacao`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_nivel` (`nivel_conta`);

--
-- Índices de tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_modulo_id` (`modulo_id`),
  ADD KEY `idx_ordem` (`ordem`),
  ADD KEY `idx_ativo` (`ativo`);

--
-- Índices de tabela `videos_assistidos`
--
ALTER TABLE `videos_assistidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_video_usuario` (`usuario_id`,`video_id`),
  ADD KEY `idx_usuario_id` (`usuario_id`),
  ADD KEY `idx_video_id` (`video_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividades`
--
ALTER TABLE `atividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `compras_cursos`
--
ALTER TABLE `compras_cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `opcoes_pergunta`
--
ALTER TABLE `opcoes_pergunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `recompensas`
--
ALTER TABLE `recompensas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `respostas_usuarios`
--
ALTER TABLE `respostas_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `videos_assistidos`
--
ALTER TABLE `videos_assistidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividades`
--
ALTER TABLE `atividades`
  ADD CONSTRAINT `atividades_ibfk_1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `compras_cursos`
--
ALTER TABLE `compras_cursos`
  ADD CONSTRAINT `compras_cursos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compras_cursos_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `modulos_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `opcoes_pergunta`
--
ALTER TABLE `opcoes_pergunta`
  ADD CONSTRAINT `opcoes_pergunta_ibfk_1` FOREIGN KEY (`pergunta_id`) REFERENCES `perguntas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `perguntas`
--
ALTER TABLE `perguntas`
  ADD CONSTRAINT `perguntas_ibfk_1` FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `respostas_usuarios`
--
ALTER TABLE `respostas_usuarios`
  ADD CONSTRAINT `respostas_usuarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respostas_usuarios_ibfk_2` FOREIGN KEY (`pergunta_id`) REFERENCES `perguntas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respostas_usuarios_ibfk_3` FOREIGN KEY (`opcao_escolhida_id`) REFERENCES `opcoes_pergunta` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `transacoes`
--
ALTER TABLE `transacoes`
  ADD CONSTRAINT `transacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `videos_assistidos`
--
ALTER TABLE `videos_assistidos`
  ADD CONSTRAINT `videos_assistidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `videos_assistidos_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
