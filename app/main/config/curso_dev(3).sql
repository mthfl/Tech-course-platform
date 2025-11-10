-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10/11/2025 às 01:54
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
  `conteudo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conteudo`)),
  `ordem` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atividades`
--

INSERT INTO `atividades` (`id`, `modulo_id`, `titulo`, `descricao`, `tipo`, `conteudo`, `ordem`, `ativo`, `data_criacao`) VALUES
(1, 1, 'Quiz: Fundamentos do Git', 'Teste completo sobre conceitos básicos do Git', 'questionario', '{\"perguntas\": [{\"pergunta\": \"O que é Git?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Um sistema de controle de versão distribuído\", \"correta\": true}, {\"texto\": \"Um editor de texto\", \"correta\": false}, {\"texto\": \"Um banco de dados\", \"correta\": false}, {\"texto\": \"Uma linguagem de programação\", \"correta\": false}], \"explicacao\": \"Git é um sistema de controle de versão distribuído\"}, {\"pergunta\": \"Qual comando inicializa um repositório Git?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"git init\", \"correta\": true}, {\"texto\": \"git start\", \"correta\": false}, {\"texto\": \"git create\", \"correta\": false}, {\"texto\": \"git new\", \"correta\": false}], \"explicacao\": \"git init cria um novo repositório Git\"}, {\"pergunta\": \"Qual é o propósito do comando git clone?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Copiar um repositório remoto para local\", \"correta\": true}, {\"texto\": \"Criar uma nova branch\", \"correta\": false}, {\"texto\": \"Excluir um repositório\", \"correta\": false}, {\"texto\": \"Renomear um repositório\", \"correta\": false}], \"explicacao\": \"git clone copia um repositório remoto para sua máquina local\"}, {\"pergunta\": \"O que significa staging area no Git?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Área onde as mudanças são preparadas para commit\", \"correta\": true}, {\"texto\": \"Local de armazenamento de backups\", \"correta\": false}, {\"texto\": \"Área de testes de código\", \"correta\": false}, {\"texto\": \"Local para resolução de conflitos\", \"correta\": false}], \"explicacao\": \"Staging area é onde você prepara as mudanças antes de fazer commit\"}, {\"pergunta\": \"Qual comando verifica o status do repositório?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"git status\", \"correta\": true}, {\"texto\": \"git check\", \"correta\": false}, {\"texto\": \"git info\", \"correta\": false}, {\"texto\": \"git state\", \"correta\": false}], \"explicacao\": \"git status mostra o estado atual do repositório\"}], \"config\": {\"tempo_limite\": 30, \"tentativas\": 3}}', 1, 1, '2025-11-10 00:52:14'),
(2, 3, 'Quiz: GitHub e Colaboração', 'Avalie seu conhecimento sobre GitHub e trabalho em equipe', 'questionario', '{\"perguntas\": [{\"pergunta\": \"O que é GitHub?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Plataforma de hospedagem de repositórios Git\", \"correta\": true}, {\"texto\": \"Um tipo de banco de dados\", \"correta\": false}, {\"texto\": \"Editor de código online\", \"correta\": false}, {\"texto\": \"Linguagem de programação\", \"correta\": false}], \"explicacao\": \"GitHub é uma plataforma para hospedar repositórios Git\"}, {\"pergunta\": \"Qual a diferença principal entre Git e GitHub?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Git é o sistema, GitHub é a plataforma\", \"correta\": true}, {\"texto\": \"São a mesma coisa\", \"correta\": false}, {\"texto\": \"GitHub é mais antigo\", \"correta\": false}, {\"texto\": \"Git é online, GitHub é local\", \"correta\": false}], \"explicacao\": \"Git é o sistema de controle de versão, GitHub é a plataforma que hospeda repositórios\"}, {\"pergunta\": \"O que é um Pull Request?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Solicitação para integrar mudanças em um repositório\", \"correta\": true}, {\"texto\": \"Comando para baixar atualizações\", \"correta\": false}, {\"texto\": \"Método para excluir branches\", \"correta\": false}, {\"texto\": \"Ferramenta de debug\", \"correta\": false}], \"explicacao\": \"Pull Request é uma solicitação para integrar mudanças de uma branch para outra\"}, {\"pergunta\": \"Como fazer fork de um repositório?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Clicar no botão Fork no GitHub\", \"correta\": true}, {\"texto\": \"Usar git fork no terminal\", \"correta\": false}, {\"texto\": \"Comando git clone especial\", \"correta\": false}, {\"texto\": \"Não é possível fazer fork\", \"correta\": false}], \"explicacao\": \"Fork é feito pelo botão Fork na interface do GitHub\"}, {\"pergunta\": \"O que são Issues no GitHub?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Sistema de acompanhamento de tarefas e bugs\", \"correta\": true}, {\"texto\": \"Problemas de conexão\", \"correta\": false}, {\"texto\": \"Erros de compilação\", \"correta\": false}, {\"texto\": \"Tipos de arquivos\", \"correta\": false}], \"explicacao\": \"Issues são usadas para acompanhar tarefas, bugs e melhorias\"}], \"config\": {\"tempo_limite\": 25, \"tentativas\": 2}}', 1, 1, '2025-11-10 00:52:14'),
(3, 4, 'Quiz: Introdução ao Padlet', 'Teste seus conhecimentos sobre a ferramenta Padlet', 'questionario', '{\"perguntas\": [{\"pergunta\": \"O que é Padlet?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Ferramenta de quadro virtual colaborativo\", \"correta\": true}, {\"texto\": \"Editor de código\", \"correta\": false}, {\"texto\": \"Rede social\", \"correta\": false}, {\"texto\": \"Plataforma de e-commerce\", \"correta\": false}], \"explicacao\": \"Padlet é um quadro virtual para colaboração em tempo real\"}, {\"pergunta\": \"Qual é a função principal do Padlet?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Organizar e compartilhar conteúdo de forma visual\", \"correta\": true}, {\"texto\": \"Programar aplicações web\", \"correta\": false}, {\"texto\": \"Gerenciar banco de dados\", \"correta\": false}, {\"texto\": \"Criar apresentações animadas\", \"correta\": false}], \"explicacao\": \"Padlet organiza conteúdo de forma visual e colaborativa\"}, {\"pergunta\": \"Que tipos de conteúdo podem ser adicionados ao Padlet?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Texto, imagens, vídeos, links e arquivos\", \"correta\": true}, {\"texto\": \"Apenas texto\", \"correta\": false}, {\"texto\": \"Somente imagens\", \"correta\": false}, {\"texto\": \"Apenas vídeos\", \"correta\": false}], \"explicacao\": \"Padlet suporta diversos tipos de mídia e conteúdo\"}, {\"pergunta\": \"Como convidar pessoas para um Padlet?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Compartilhando o link ou por email\", \"correta\": true}, {\"texto\": \"Apenas com login obrigatório\", \"correta\": false}, {\"texto\": \"Somente pessoalmente\", \"correta\": false}, {\"texto\": \"Não é possível convidar\", \"correta\": false}], \"explicacao\": \"Padlet permite compartilhamento por link ou convite por email\"}, {\"pergunta\": \"O que são templates no Padlet?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Layouts pré-definidos para diferentes usos\", \"correta\": true}, {\"texto\": \"Tipos de usuários\", \"correta\": false}, {\"texto\": \"Planos de assinatura\", \"correta\": false}, {\"texto\": \"Métodos de pagamento\", \"correta\": false}], \"explicacao\": \"Templates são layouts prontos para diferentes finalidades\"}], \"config\": {\"tempo_limite\": 20, \"tentativas\": 3}}', 1, 1, '2025-11-10 00:52:14'),
(4, 5, 'Quiz: Gestão de Sprint com Padlet', 'Avalie seu conhecimento sobre uso do Padlet em sprints', 'questionario', '{\"perguntas\": [{\"pergunta\": \"Como o Padlet pode ajudar na gestão de sprint?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Visualizando tarefas e progresso da equipe\", \"correta\": true}, {\"texto\": \"Automatizando deploy\", \"correta\": false}, {\"texto\": \"Escrevendo código\", \"correta\": false}, {\"texto\": \"Testando aplicações\", \"correta\": false}], \"explicacao\": \"Padlet ajuda na visualização do progresso e organização das tarefas\"}, {\"pergunta\": \"Qual template do Padlet é mais usado para Kanban?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Shelves (Prateleiras)\", \"correta\": true}, {\"texto\": \"Wall (Parede)\", \"correta\": false}, {\"texto\": \"Stream (Fluxo)\", \"correta\": false}, {\"texto\": \"Grid (Grade)\", \"correta\": false}], \"explicacao\": \"Template Shelves é ideal para fluxo Kanban com colunas\"}, {\"pergunta\": \"Como rastrear o progresso diário da sprint?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Movendo cards entre colunas de status\", \"correta\": true}, {\"texto\": \"Escrevendo relatórios longos\", \"correta\": false}, {\"texto\": \"Usando apenas email\", \"correta\": false}, {\"texto\": \"Não é possível rastrear\", \"correta\": false}], \"explicacao\": \"Movimentar cards entre colunas mostra visualmente o progresso\"}, {\"pergunta\": \"Que informações um card de tarefa deve ter?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Título, responsável, descrição e estimativa\", \"correta\": true}, {\"texto\": \"Apenas o título\", \"correta\": false}, {\"texto\": \"Somente o responsável\", \"correta\": false}, {\"texto\": \"Nenhuma informação\", \"correta\": false}], \"explicacao\": \"Cards devem ter informações suficientes para o time entender a tarefa\"}, {\"pergunta\": \"Como usar cores no Padlet para gestão?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Para categorizar por tipo, prioridade ou responsável\", \"correta\": true}, {\"texto\": \"Apenas para deixar bonito\", \"correta\": false}, {\"texto\": \"Não é possível usar cores\", \"correta\": false}, {\"texto\": \"Para substituir textos\", \"correta\": false}], \"explicacao\": \"Cores ajudam na categorização visual rápida das tarefas\"}], \"config\": {\"tempo_limite\": 25, \"tentativas\": 2}}', 1, 1, '2025-11-10 00:52:14'),
(5, 12, 'Quiz: Introdução ao Tailwind', 'Teste seus conhecimentos sobre Tailwind CSS', 'questionario', '{\"perguntas\": [{\"pergunta\": \"O que é Tailwind CSS?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Framework CSS utility-first\", \"correta\": true}, {\"texto\": \"Linguagem de programação\", \"correta\": false}, {\"texto\": \"Biblioteca JavaScript\", \"correta\": false}, {\"texto\": \"Editor de código\", \"correta\": false}], \"explicacao\": \"Tailwind é um framework CSS focado em classes utilitárias\"}, {\"pergunta\": \"Qual a vantagem do approach utility-first?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Desenvolvimento mais rápido e consistente\", \"correta\": true}, {\"texto\": \"Menos controle sobre o design\", \"correta\": false}, {\"texto\": \"Código mais verboso\", \"correta\": false}, {\"texto\": \"Dificuldade de aprendizado\", \"correta\": false}], \"explicacao\": \"Utility-first permite desenvolvimento rápido com design consistente\"}, {\"pergunta\": \"Como aplicar padding em Tailwind?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"p-4\", \"correta\": true}, {\"texto\": \"padding-4\", \"correta\": false}, {\"texto\": \"pad-4\", \"correta\": false}, {\"texto\": \"spacing-4\", \"correta\": false}], \"explicacao\": \"p-4 aplica padding de 1rem (16px) em todos os lados\"}, {\"pergunta\": \"O que é JIT no Tailwind?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Just-In-Time, compila classes sob demanda\", \"correta\": true}, {\"texto\": \"JavaScript Integration Tool\", \"correta\": false}, {\"texto\": \"Java Interface Technology\", \"correta\": false}, {\"texto\": \"JSON Import Template\", \"correta\": false}], \"explicacao\": \"JIT compiler gera CSS sob demanda durante o desenvolvimento\"}, {\"pergunta\": \"Como criar um layout responsivo?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Usando prefixos como md:, lg:\", \"correta\": true}, {\"texto\": \"Escrevendo media queries manualmente\", \"correta\": false}, {\"texto\": \"Não é possível\", \"correta\": false}, {\"texto\": \"Usando apenas JavaScript\", \"correta\": false}], \"explicacao\": \"Prefixos como md: e lg: permitem designs responsivos facilmente\"}], \"config\": {\"tempo_limite\": 30, \"tentativas\": 3}}', 1, 1, '2025-11-10 00:52:14'),
(6, 13, 'Quiz: Introdução ao FPDF', 'Avalie seu conhecimento sobre geração de PDFs com FPDF', 'questionario', '{\"perguntas\": [{\"pergunta\": \"O que é FPDF?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Biblioteca PHP para gerar PDFs\", \"correta\": true}, {\"texto\": \"Framework frontend\", \"correta\": false}, {\"texto\": \"Sistema de banco de dados\", \"correta\": false}, {\"texto\": \"Linguagem de programação\", \"correta\": false}], \"explicacao\": \"FPDF é uma biblioteca PHP para criação de documentos PDF\"}, {\"pergunta\": \"Qual a vantagem do FPDF?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"Não depende de extensões externas\", \"correta\": true}, {\"texto\": \"Gera PDFs automaticamente\", \"correta\": false}, {\"texto\": \"Não precisa de código\", \"correta\": false}, {\"texto\": \"É mais lento que outras soluções\", \"correta\": false}], \"explicacao\": \"FPDF é puro PHP, não precisa de extensões como PDFlib\"}, {\"pergunta\": \"Como criar uma instância do FPDF?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"$pdf = new FPDF()\", \"correta\": true}, {\"texto\": \"$pdf = create_pdf()\", \"correta\": false}, {\"texto\": \"$pdf = FPDF::create()\", \"correta\": false}, {\"texto\": \"$pdf = new PDF()\", \"correta\": false}], \"explicacao\": \"Instância-se a classe FPDF com new FPDF()\"}, {\"pergunta\": \"Qual método adiciona uma página?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"AddPage()\", \"correta\": true}, {\"texto\": \"NewPage()\", \"correta\": false}, {\"texto\": \"CreatePage()\", \"correta\": false}, {\"texto\": \"InsertPage()\", \"correta\": false}], \"explicacao\": \"AddPage() adiciona uma nova página ao documento\"}, {\"pergunta\": \"Como definir a fonte do texto?\", \"tipo\": \"multipla_escolha\", \"opcoes\": [{\"texto\": \"SetFont()\", \"correta\": true}, {\"texto\": \"Font()\", \"correta\": false}, {\"texto\": \"TextFont()\", \"correta\": false}, {\"texto\": \"DefineFont()\", \"correta\": false}], \"explicacao\": \"SetFont() define família, estilo e tamanho da fonte\"}], \"config\": {\"tempo_limite\": 25, \"tentativas\": 2}}', 1, 1, '2025-11-10 00:52:14');

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
(2, 1, 2, 40, '2025-11-10 00:35:56');

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
(3, 1, 'Github e Colaboração', 'Aprenda a usar Github para trabalho em equipe', 3),
(4, 2, 'Introdução ao Padlet', 'Conheça a ferramenta Padlet e suas funcionalidades', 1),
(5, 2, 'Gestão de Sprint com Padlet', 'Organize e gerencie sprints usando Padlet', 2),
(11, 3, 'Introdução ao Tailwind', 'Aprenda os fundamentos do framework Tailwind CSS', 1),
(12, 4, 'Introdução ao FPDF', 'Aprenda a gerar PDFs com FPDF', 1),
(13, 3, 'Introdução ao Tailwind', 'Aprenda os fundamentos do framework Tailwind CSS', 1),
(14, 4, 'Introdução ao FPDF', 'Aprenda a gerar PDFs com FPDF', 1);

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
(2, 'atividade', 2, 10, 50),
(3, 'atividade', 3, 10, 50),
(4, 'atividade', 4, 10, 50),
(5, 'atividade', 5, 10, 50),
(6, 'atividade', 6, 10, 50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas_usuarios`
--

CREATE TABLE `respostas_usuarios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  `respostas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`respostas`)),
  `pontuacao` decimal(5,2) DEFAULT 0.00,
  `data_resposta` datetime DEFAULT current_timestamp()
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

--
-- Despejando dados para a tabela `transacoes`
--

INSERT INTO `transacoes` (`id`, `usuario_id`, `tipo`, `operacao`, `quantidade`, `descricao`, `referencia_id`, `tipo_referencia`, `data_transacao`) VALUES
(5, 1, 'coins', 'entrada', 5, 'Recompensa por assistir vídeo', 1, 'video', '2025-11-10 00:37:16'),
(6, 1, 'xp', 'entrada', 25, 'Recompensa por assistir vídeo', 1, 'video', '2025-11-10 00:37:16'),
(7, 1, 'coins', 'entrada', 10, 'Bônus por conclusão do curso', 2, 'curso', '2025-11-10 00:37:16'),
(8, 1, 'xp', 'entrada', 100, 'Bônus por conclusão do curso', 2, 'curso', '2025-11-10 00:37:16');

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
(1, 'Matheus Felix', 'matheus.dev91@gmail.com', '$2y$10$nbtrumXfdUGNSJIQZbrtU.VqAr0x4hqF.RgO.00lTgi6ikQxjY9Eq', '2025-11-05 23:48:40', 'iniciante', 15, 125, 1);

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

--
-- Despejando dados para a tabela `videos`
--

INSERT INTO `videos` (`id`, `modulo_id`, `titulo`, `descricao`, `drive_file_id`, `drive_embed_link`, `ordem`, `ativo`) VALUES
(1, 5, 'Vídeo do Google Drive', 'Descrição do vídeo (opcional)', '1qDQu-H4F8UHBEoOrxjLV2K-3AUHt-5Iu', 'https://drive.google.com/file/d/1qDQu-H4F8UHBEoOrxjLV2K-3AUHt-5Iu/preview', 1, 1);

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
-- Despejando dados para a tabela `videos_assistidos`
--

INSERT INTO `videos_assistidos` (`id`, `usuario_id`, `video_id`, `data_assistido`, `progresso`) VALUES
(7, 1, 1, '2025-11-10 00:37:16', 100.00);

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
  ADD KEY `idx_usuario_id` (`usuario_id`),
  ADD KEY `idx_atividade_id` (`atividade_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `compras_cursos`
--
ALTER TABLE `compras_cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `recompensas`
--
ALTER TABLE `recompensas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `respostas_usuarios`
--
ALTER TABLE `respostas_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `videos_assistidos`
--
ALTER TABLE `videos_assistidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Restrições para tabelas `recompensas`
--
ALTER TABLE `recompensas`
  ADD CONSTRAINT `recompensas_ibfk_1` FOREIGN KEY (`referencia_id`) REFERENCES `atividades` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `respostas_usuarios`
--
ALTER TABLE `respostas_usuarios`
  ADD CONSTRAINT `respostas_usuarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respostas_usuarios_ibfk_2` FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`) ON DELETE CASCADE;

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
