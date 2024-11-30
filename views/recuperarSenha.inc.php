<!-- Tela modal -->
<div class="modal fade" id="recuperarSenhaModal" tabindex="-1" aria-labelledby="recuperarSenhaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recuperarSenhaModalLabel">Esqueci Minha Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm" action="../controllers/controllerUsuario.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Insira seu e-mail:</label>
                        <input type="email" id="email" name="pEmail" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <input type="hidden" value="4" name="pOpcao">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>