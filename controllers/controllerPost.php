<!-- TALLES HENRIQUE TEÓFILO DOS SANTOS - 2020204803 - MODIFICAÇÃO FEITA PARA PROVA -->


<?php
require_once '../dao/usuarioDAO.inc.php';
require_once '../dao/postDAO.inc.php';
require_once '../classes/post.inc.php';

$opcao = $_REQUEST['pOpcao'];

switch ($opcao) {
    case 1:
        // obter todos os posts

        $postDao = new PostDao();
        $posts = $postDao->obterTodosPosts();
        session_start();
        $_SESSION['posts'] = $posts;

        header('Location: ../views/visualizarPosts.php');
        break;

    case 2:
        // enviar post
        $titulo = $_REQUEST['pTitulo'];
        $texto = $_REQUEST['pTexto'];
        $remetente_email = $_REQUEST['pRemetenteEmail'];

        $post = new Post();
        $post->setPost(null, $titulo, $texto, $remetente_email);

        $postDao = new PostDao();
        $postDao->enviarPost($post);

        session_start();
        $_SESSION['postEnviado'] = true;

        header('Location: controllerPost.php?pOpcao=1');
        break;

    case 3:
        // seguir post
        $ID_post = $_REQUEST['pIDPost'];
        $email = $_REQUEST['pEmail'];

        $postDao = new PostDao();
        $postDao->seguirPost($ID_post, $email);

        session_start();
        $_SESSION['postSeguido'] = true;

        header('Location: controllerPost.php?pOpcao=1');
        break;

    case 4:
        // obter post por ID
        $ID_post = $_REQUEST['pIDPost'];

        $postDao = new PostDao();
        $post = $postDao->obterPostPorID($ID_post);
        session_start();
        $_SESSION['post'] = $post;

        header('Location: ../views/visualizarPosts.php');
        break;

    default:
        break;
}
?>