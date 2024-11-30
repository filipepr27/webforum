<!-- TALLES HENRIQUE TEÓFILO DOS SANTOS - 2020204803 - MODIFICAÇÃO FEITA PARA PROVA -->



<?php
require_once '../classes/usuario.inc.php';
require_once 'includes/cabecalho.inc.php';

?>

<link rel="stylesheet" type="text/css" href="css/visualizarMensagens.css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="../controllers/controllerPost.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="pOpcao" value="2">
                <div class="form-group">
                    <label for="pTitulo">Título</label>
                    <input type="text" class="form-control" id="pTitulo" name="pTitulo" required>
                </div>
                <div class="form-group">
                    <label for="pTexto">Texto</label>
                    <textarea class="form-control" id="pTexto" name="pTexto" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="pRemetenteEmail">Seu Email</label>
                    <input type="email" class="form-control" id="pRemetenteEmail" name="pRemetenteEmail" value="<?= $_SESSION['usuarioLogado']->email ?>" readonly>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Enviar Post</button>
            </form>
        </div>
    </div>
</div>

<?php
include 'includes/carregamento-sucesso.inc.php';
require_once 'includes/rodape.inc.php';
?>