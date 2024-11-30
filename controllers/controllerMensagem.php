<?php
require_once '../dao/usuarioDAO.inc.php';
require_once '../dao/mensagemDao.inc.php';
require_once '../classes/mensagem.inc.php';

$opcao = $_REQUEST['pOpcao'];

switch ($opcao) {
    case 1:
        // obter todas as mensagens

        $usuarioDao = new UsuarioDao();
        $usuarios = $usuarioDao->obterTodosUsuarios();
        session_start();
        $_SESSION['usuarios'] = $usuarios;

        $mensagemDao = new MensagemDao();
        $mensagens = $mensagemDao->obterTodasMensagensRecebidas($_SESSION['usuarioLogado']->id);
        $_SESSION['mensagens'] = $mensagens;
        unset($_SESSION['enviadas']);

        header('Location: ../views/visualizarMensagens.php');
        break;

    case 2:
        // enviar mensagem com nova conversa
        $remetente_id = $_REQUEST['pRemetente'];
        $destinatario_id = $_REQUEST['pDestinatario'];
        $conteudo = $_REQUEST['pCorpo'];
        $assunto = $_REQUEST['pAssunto'];
        $titulo = $_REQUEST['pTitulo'];


        $mensagem = new Mensagem();
        $mensagem->criarMensagem($remetente_id, $destinatario_id, $conteudo, $titulo, $assunto);

        $mensagemDao = new MensagemDao();
        $id_mensagem = $mensagemDao->enviarMensagem($mensagem);

        if ($_FILES['pImagem']['size'] > 0) {
            uploadImagemMensagem($id_mensagem);
        }

        session_start();
        $_SESSION['mensagemEnviada'] = true;

        header('Location: controllerMensagem.php?pOpcao=1');

        break;

    case 3:
        // excluir mensagem
        $id = $_REQUEST['pId'];

        excluirImagem($id);

        $mensagemDao = new MensagemDao();
        $mensagemDao->excluirMensagem($id);

        header('Location: controllerMensagem.php?pOpcao=1');

        break;

    case 4:
        $usuarioDao = new UsuarioDao();
        $usuarios = $usuarioDao->obterTodosUsuarios();
        session_start();
        $_SESSION['usuarios'] = $usuarios;

        $mensagemDao = new MensagemDao();
        $mensagens = $mensagemDao->obterTodasMensagensEnviadas($_SESSION['usuarioLogado']->id);
        $_SESSION['mensagens'] = $mensagens;
        $_SESSION['enviadas'] = true;

        header('Location: ../views/visualizarMensagens.php');
        break;
    default:
        break;
}

function uploadImagemMensagem($id)
{
    $imagem = $_FILES['pImagem'];
    $nome = $id . '.jpg';
    $caminho = '../views/images/mensagens/' . $nome;

    if ($imagem != null) {
        $nome_temporario = $_FILES['pImagem']['tmp_name'];
        copy($nome_temporario, $caminho);
    }
}

function excluirImagem($id)
{
    $nome = $id . '.jpg';
    $caminho = '../views/images/mensagens/' . $nome;
    if (file_exists($caminho)) {
        unlink($caminho);
    }
}
