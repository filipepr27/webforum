<!-- TALLES HENRIQUE TEÓFILO DOS SANTOS - 2020204803 - MODIFICAÇÃO FEITA PARA PROVA -->

<?php
require_once '../classes/usuario.inc.php';
require_once '../classes/post.inc.php';
require_once '../dao/postDao.inc.php';
require_once 'includes/cabecalho.inc.php';

$posts = $_SESSION['posts'] ?? [];
$postSelecionado = null;
$seguidores = [];
$usuarioSeguindo = false;
$usuario = $_SESSION['usuarioLogado'];

if (isset($_SESSION['postEnviado']) && $_SESSION['postEnviado'] === true) {
    unset($_SESSION['postEnviado']);

    $loadingMessage = $loadingMessage ?? 'Enviando post, aguarde...';
    $successMessage = $successMessage ?? 'Post enviado com sucesso!';

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
            loadingModal.show();
            showLoading();
            
            setTimeout(function() {
                showSuccess();
            }, 1500);
        });
    </script>";
}

if (isset($_GET['postId'])) {
    foreach ($posts as $post) {
        if ($post->ID_post == $_GET['postId']) {
            $postSelecionado = $post;
            $_SESSION['postSelecionado'] = $postSelecionado;

            $postDao = new PostDao();
            $seguidores = $postDao->obterSeguidoresPorPostID($post->ID_post);
            foreach ($seguidores as $seguidor) {
                if ($seguidor['email'] == $usuario->email) {
                    $usuarioSeguindo = true;
                    break;
                }
            }
            break;
        }
    }
}
?>

<link rel="stylesheet" type="text/css" href="css/visualizarMensagens.css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row message-wrapper rounded shadow mb-20">
        <div class="col-md-4 message-sideleft">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Posts</h3>
                </div>
                <div class="panel-body no-padding">
                    <div class="list-group no-margin list-message">
                        <?php
                        if (count($posts) == 0) {
                            echo '<p class="list-group-item">Nenhum post encontrado.</p>';
                        } else {
                            foreach ($posts as $post) {
                        ?>
                                <a href="visualizarPosts.php?postId=<?= $post->ID_post ?>" class="list-group-item d-flex align-items-center">
                                    <img src="<?php
                                                //isso aqui não vai pegar por que o post não vai ter o id do usuario
                                                $arquivo = './images/perfil/' . $post->remetente_email . '.jpg';

                                                if (!file_exists($arquivo)) {
                                                    $arquivo = './assets/images/avatar.png';
                                                }
                                                echo $arquivo;
                                                ?>" alt="Avatar" class="img-circle avatar img-profile">

                                    <div>
                                        <h4 class="list-group-item-heading"><?= $post->remetente_email ?></h4>
                                        <p class="list-group-item-text"><strong><?= $post->Titulo ?></strong></p>
                                    </div>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 message-sideright">
            <?php if (isset($postSelecionado)) { ?>
                <div class="panel">
                    <div class="panel-heading">
                        <div class="head-msg">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img src="<?php
                                                $arquivo = './images/perfil/' . $postSelecionado->remetente_email . '.jpg';

                                                if (!file_exists($arquivo)) {
                                                    $arquivo = './assets/images/avatar.png';
                                                }
                                                echo $arquivo;
                                                ?>" alt="Avatar" class="img-circle avatar">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?= htmlspecialchars($postSelecionado->remetente_email) ?></h4>
                                </div>
                            </div>
                            <div>
                                <a class="btn btn-primary <?= $usuarioSeguindo ? 'disabled' : '' ?>" href="../controllers/controllerPost.php?pOpcao=3&pIDPost=<?= $postSelecionado->ID_post ?>&pEmail=<?= $_SESSION['usuarioLogado']->email ?>" <?= $usuarioSeguindo ? 'aria-disabled="true"' : '' ?>>SEGUIR</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h4><?= htmlspecialchars($postSelecionado->Titulo) ?></h4>
                        <p><?= htmlspecialchars($postSelecionado->Texto) ?></p>
                        <h5>Seguidores:</h5>
                        <ul>
                            <?php foreach ($seguidores as $seguidor) { ?>
                                <li><?= htmlspecialchars($seguidor['email']) ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } else { ?>
                <img src="./assets/images/logo-semfundo.png" alt="Imagem" class="img-background">
            <?php } ?>
        </div>
    </div>
</div>

<?php
include 'includes/carregamento-sucesso.inc.php';
require_once 'includes/rodape.inc.php';
?>