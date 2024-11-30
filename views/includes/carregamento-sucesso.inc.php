<!-- Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <!-- Loading Spinner -->
                <div id="loading" style="display: none;">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                    <p id="loadingMessage"><?= htmlspecialchars($loadingMessage) ?></p>
                </div>

                <!-- Success Check -->
                <div id="success-check" style="display: none;">
                    <i class="fa fa-check-circle" style="color: green; font-size: 48px;"></i>
                    <p id="successMessage"><?= htmlspecialchars($successMessage) ?></p>
                    <button type="button" class="btn btn-success" id="closeModalBtn" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Função para exibir o loading
    function showLoading() {
        document.getElementById('loading').style.display = 'block';
        document.getElementById('success-check').style.display = 'none';
    }

    // Função para exibir o sucesso
    function showSuccess() {
        document.getElementById('loading').style.display = 'none';
        document.getElementById('success-check').style.display = 'block';
    }

    // Atualiza as mensagens do modal
    document.addEventListener('DOMContentLoaded', function() {
        var loadingMessage = <?= json_encode($loadingMessage) ?>;
        var successMessage = <?= json_encode($successMessage) ?>;
        document.getElementById('loadingMessage').textContent = loadingMessage;
        document.getElementById('successMessage').textContent = successMessage;
    });
</script>

<style>
    .spinner-border {
        width: 48px;
        height: 48px;
        border-width: 5px;
        color: #007bff;
    }
</style>