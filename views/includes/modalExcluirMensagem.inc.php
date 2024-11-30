<!-- Botão de excluir -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModalExcluir">
    <img src="../assets/icons/lixo.png" alt="Excluir" width="10" height="10">
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Mensagem</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                Você deseja realmente excluir a mensagem?
            </div>
            <div class="modal-footer">
                <a class='btn btn-primary me-2' role='button' href='../controllers/controllerMensagem.php?pOpcao=3&pId=<?= $mensagem->id ?>'>Sim</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>