-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/09/2024 às 04:34
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
-- Banco de dados: `webforum`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `id` varchar(36) NOT NULL,
  `assunto` varchar(128) DEFAULT NULL,
  `titulo` char(128) NOT NULL,
  `conteudo` text DEFAULT NULL,
  `remetente` varchar(36) NOT NULL,
  `destinatario` varchar(36) NOT NULL,
  `data` datetime NOT NULL,
  `id_conversa` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `mensagem`
--

INSERT INTO `mensagem` (`id`, `assunto`, `titulo`, `conteudo`, `remetente`, `destinatario`, `data`, `id_conversa`) VALUES
('3536ac63-31c2-4d96-88ab-cf0f63f9a011', 'Trabalho', 'Protótipo de tela', '\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"\r\n\r\n', '7a987bd4-0846-4816-a410-d562dc3a8544', 'b4befde6-dbf3-421e-9637-0702495d54e7', '2024-09-20 04:31:10', ''),
('3b34cb13-6547-4892-beae-64db46cd4806', 'Projeto', 'Boa noite', '\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"\r\n\r\n', 'b4befde6-dbf3-421e-9637-0702495d54e7', '7a987bd4-0846-4816-a410-d562dc3a8544', '2024-09-20 04:27:36', ''),
('871fbce2-ea2a-4eaa-ad3c-451bce619704', 'Apenas imagem', 'Foto', '', '7a987bd4-0846-4816-a410-d562dc3a8544', '438cd455-7844-4177-97de-082a1ed7cd74', '2024-09-20 04:29:53', ''),
('8d46eb7b-16a2-4951-93cb-4e8097c031d2', 'Finibus Bonorum et Malorum', 'Boa noite', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\r\n\r\n', 'b4befde6-dbf3-421e-9637-0702495d54e7', '438cd455-7844-4177-97de-082a1ed7cd74', '2024-09-20 04:28:47', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` varchar(36) NOT NULL,
  `nome` char(50) NOT NULL,
  `email` char(25) NOT NULL,
  `login` char(13) NOT NULL,
  `senha` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `email`, `login`, `senha`) VALUES
('438cd455-7844-4177-97de-082a1ed7cd74', 'Usuário', 'usuario@mail.com', 'usuario@mail.', '1234'),
('7a987bd4-0846-4816-a410-d562dc3a8544', 'Talles', 'talles@mail.com', 'talles@mail.c', '1234'),
('b4befde6-dbf3-421e-9637-0702495d54e7', 'Filipe', 'filipe@mail.com', 'filipe@mail.c', '1234');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conversa_id_rem` (`id_conversa`),
  ADD KEY `fk_mensagem_id_dest` (`destinatario`),
  ADD KEY `fk_mensagem_id_rem` (`remetente`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `fk_mensagem_id_dest` FOREIGN KEY (`destinatario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `fk_mensagem_id_rem` FOREIGN KEY (`remetente`) REFERENCES `usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
