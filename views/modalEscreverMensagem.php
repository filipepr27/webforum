<?php
$usuarios = $_SESSION['usuarios'];
$msg_selecionada = null;
if (isset($_SESSION['mensagemSelecionada'])) {
    $msg_selecionada = $_SESSION['mensagemSelecionada'];
}
?>

<a href="#" class="nav-link px-2 link-secondary" data-bs-toggle="modal" data-bs-target="#mensagemModal">Escrever Mensagem</a>

<!-- Tela modal -->
<div class="modal fade" id="mensagemModal" tabindex="-1" aria-labelledby="mensagemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mensagemModalLabel">Enviar Mensagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form action="../controllers/controllerMensagem.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="usuarios" class="form-label">Destinatários:</label>
                        <!-- fazer select com pesquisa de usuários -->
                        <select name="pDestinatario" id="pDestinatario" class="form-select" onchange="toggleSubmitButton()">
                            <option value="0" selected>Selecione um destinatário</option>
                            <?php
                            foreach ($usuarios as $usuario) {
                                // fazer aparecer o email abaixo do nome do usuario
                                echo "<option value='" . $usuario->id . "' title='" . $usuario->email . "'>" . $usuario->nome . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pTitulo" class="form-label">Título:</label>
                        <input type="text" name="pTitulo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="pAssunto" class="form-label">Assunto:</label>
                        <input type="text" name="pAssunto" class="form-control">
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <label for="pCorpo" class="form-label">Corpo:</label>
                        <small class="text-muted" style="align-self: center;">Limite de 5000 caracteres</small>
                    </div>
                    <div class="mb-3">
                        <textarea name="pCorpo" class="form-control" rows="5" maxlength="5000"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pImagem" class="form-label">Foto:</label>
                        <input type="file" class="form-control" name="pImagem">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" id="submitButton" class="btn btn-primary" value="Enviar" disabled>
                    </div>
                    <input type="hidden" name="pOpcao" value="2">
                    <input type="hidden" name="pRemetente" value="<?= $_SESSION['usuarioLogado']->id; ?>">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/modalEscreverMensagem.js"></script>

</html>