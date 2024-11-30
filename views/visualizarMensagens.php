<?php
require_once '../classes/usuario.inc.php';
require_once '../classes/mensagem.inc.php';
require_once '../dao/mensagemDao.inc.php';
require_once 'includes/cabecalho.inc.php';


$mensagens = $_SESSION['mensagens'] ?? [];
$mensagemSelecionada = null;

if (isset($_SESSION['mensagemEnviada']) && $_SESSION['mensagemEnviada'] === true) {
    // Remove a flag imediatamente antes de continuar, para garantir que não reapareça
    unset($_SESSION['mensagemEnviada']);

    $loadingMessage = $loadingMessage ?? 'Enviando mensagem, aguarde...';
    $successMessage = $successMessage ?? 'Mensagem enviada com sucesso!';

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
            loadingModal.show();
            showLoading();
            
            // Aguarda o tempo do carregamento e mostra o sucesso
            setTimeout(function() {
                showSuccess();
            }, 1500);
        });
    </script>";
}

// Verifica se um ID de mensagem foi passado na URL
if (isset($_GET['mensagemId'])) {
    foreach ($mensagens as $mensagem) {
        if ($mensagem->id == $_GET['mensagemId']) {
            $mensagemSelecionada = $mensagem;
            $_SESSION['mensagemSelecionada'] = $mensagemSelecionada;
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
                    <?php
                    if (isset($_SESSION['enviadas'])) {
                        echo '<h3 class="panel-title">Enviadas</h3>';
                    } else {
                        echo '<h3 class="panel-title">Recebidas</h3>';
                    }
                    ?>
                </div>
                <div class="panel-body no-padding">
                    <div class="list-group no-margin list-message">
                        <?php
                        if (count($mensagens) == 0) {
                            echo '<p class="list-group-item">Nenhuma mensagem encontrada.</p>';
                        } else {
                            foreach ($mensagens as $mensagem) {
                        ?>
                                <a href="visualizarMensagens.php?mensagemId=<?= $mensagem->id ?>" class="list-group-item d-flex align-items-center">
                                    <img src="<?php
                                                $id_perfil = (isset($_SESSION['enviadas'])) ? $mensagem->destinatario_id : $mensagem->remetente_id;
                                                $arquivo = './images/perfil/' . $id_perfil . '.jpg';

                                                if (!file_exists($arquivo)) {
                                                    $arquivo = './assets/images/avatar.png';
                                                }
                                                echo $arquivo;
                                                ?>" alt="Avatar" class="img-circle avatar img-profile">

                                    <div>
                                        <?php
                                        if (isset($_SESSION['enviadas'])) {
                                            echo '<h4 class="list-group-item-heading">' . $mensagem->destinatario_email . '</h4>';
                                        } else {
                                            echo '<h4 class="list-group-item-heading">' . $mensagem->remetente_email . '</h4>';
                                        }
                                        ?>
                                        <p class="list-group-item-text"><strong><?= $mensagem->assunto ?></strong></p>
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
            <?php if (isset($mensagemSelecionada)) { ?>
                <div class="panel">
                    <div class="panel-heading">
                        <div class="head-msg">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img src="<?php
                                                $arquivo = './images/perfil/' . $mensagemSelecionada->remetente_id . '.jpg';

                                                if (!file_exists($arquivo)) {
                                                    $arquivo = './assets/images/avatar.png';
                                                }
                                                echo $arquivo;
                                                ?>" alt="Avatar" class="img-circle avatar">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?= htmlspecialchars($mensagemSelecionada->remetente_nome) ?></h4>
                                    <small><?= htmlspecialchars($mensagemSelecionada->data) ?></small>
                                </div>
                            </div>
                            <?php
                            if (!isset($_SESSION['enviadas'])) {
                            ?>
                                <div>
                                    <a href="#" title="Excluir mensagem">
                                        <a class="fa fa-trash link-button" href="../controllers/controllerMensagem.php?pOpcao=3&pId=<?= $mensagemSelecionada->id ?>"></a>
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h4><?= htmlspecialchars($mensagemSelecionada->titulo) ?></h4>
                        <p><?= htmlspecialchars($mensagemSelecionada->conteudo) ?></p>
                        <?php
                        $arquivo_foto = './images/mensagens/' . $mensagemSelecionada->id . '.jpg';

                        if (file_exists($arquivo_foto)) {
                            echo '<img src="' . $arquivo_foto . '" alt="img" class="img-ajustada">';
                        }
                        ?>

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
?>

<?php
require_once 'includes/rodape.inc.php';
?>