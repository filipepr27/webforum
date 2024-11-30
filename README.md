# Webforum - Projeto de Troca de Mensagens
Trabalho da disciplina de Desenvolvimento Web

## Descrição

Este projeto é uma aplicação web simples desenvolvida em PHP que simula um webforum para troca de mensagens entre usuários. O sistema possui duas áreas principais: uma pública e uma restrita. Na área pública, os usuários podem se cadastrar e acessar a área restrita após autenticação. A área restrita permite o envio, visualização e remoção de mensagens.

## Funcionalidades

### Área Pública

- **Cadastro de Usuário**: Permite que novos usuários se registrem fornecendo um e-mail e uma senha. Esses dados são usados para autenticação futura.

### Área Restrita (Acessível após login)

- **Enviar Mensagem**: Usuários logados podem enviar mensagens para outros usuários cadastrados.
- **Editar Dados Usuário**: Usuário logado pode alterar seus dados de cadastro.
- **Visualizar Mensagens Recebidas**: Usuários podem ver uma lista de mensagens recebidas, incluindo remetente e assunto. Mensagens podem ser lidas em detalhes ao serem selecionadas.
- **Remover Mensagens**: Usuários podem excluir mensagens recebidas.

## Funcionalidades de Autenticação

- **Login**: Os usuários precisam estar autenticados para acessar a área restrita. A autenticação é gerida por sessões PHP para garantir que apenas usuários logados possam acessar recursos restritos.
- **Esqueceu a Senha**: Funcionalidade para lembrar a senha do usuário.

## Tecnologias Utilizadas

- **PHP**: Linguagem de programação para o backend.
- **MySQL**: Banco de dados para armazenamento de informações de usuários e mensagens.
- **HTML/CSS**: Estrutura e estilo das páginas web.
- **Bootstrap**: Facilitação das estilizações

## Estrutura do Projeto

- `classes/`: Contém as entidades que são usadas e manipuladas durante o fluxo do sistema (mensagem, usuario).
- `controllers/`: Contém arquivos para as controllers do sistema para manipular requisições (ControllerMensagem, ControllerUsuario).
- `dao/`: Contém os arquivos que lidam com as requisições do sistema e transpassam para o banco (conexao, mensagemDao, usuarioDAO).
- `js/`: Arquivos JavaScript para funcionalidades adicionais (Lógica para habilitar botão).
- `utils/`: Arquivos das especificações e banco usado para o sistema
- `views/`: Telas para mostragem no sistema
  - `views/css/`: Arquivos CSS para estilização.
  - `views/assets`: Imagens, icones, imagens das mensagens, foto de perfil
  - `views/includes`: Telas usadas dentro de outras


## Instalação

1. **Clone o Repositório**

   ```bash
   git clone https://github.com/Talleshts/web-forum.git

