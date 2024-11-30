<?php
require_once '../classes/usuario.inc.php';
require_once '../dao/usuarioDao.inc.php';
require_once 'includes/cabecalho.inc.php';

$usuario = $_SESSION['usuarioLogado'];

if (isset($_SESSION['cadastroAtualizado']) && $_SESSION['cadastroAtualizado'] === true) {
    // Remove a flag imediatamente antes de continuar, para garantir que não reapareça
    unset($_SESSION['cadastroAtualizado']);

    $loadingMessage = 'Atualizando dados, aguarde...';
    $successMessage = 'Dados atualizados com sucesso!';

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
?>

<link rel="stylesheet" type="text/css" href="css/cadastroAtualizar.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<script>
    function validarSenhas() {
        var senha = document.querySelector('input[name="pSenha"]').value;
        var confirmarSenha = document.querySelector('input[name="pConfirmar_senha"]').value;

        if (senha !== confirmarSenha) {
            alert("As senhas não coincidem. Por favor, tente novamente.");
            return false;
        }

        return true;
    }
</script>

<div class="container-form">
    <h1>Atualizar Dados</h1>
    <div class="avatar-container">
        <?php
        $arquivo = './images/perfil/' . $usuario->id . '.jpg';
        $imagem = file_exists($arquivo) ? $arquivo : './assets/images/avatar.png';
        ?>
        <img src="<?= $imagem ?>" alt="Avatar" class="avatar">
        <?php
        if (file_exists($arquivo)) {
        ?>
            <div class="overlay" onclick="window.location.href='../controllers/controllerUsuario.php?pOpcao=6&id=<?= urlencode($usuario->id) ?>';">
                <i class="fa fa-trash icon"></i>
            </div>
        <?php
        }
        ?>
    </div>

    <form action="../controllers/controllerUsuario.php" method="post" onsubmit="return validarSenhas()" enctype="multipart/form-data">

        <label for="pNome" class="form-label">Nome:</label>
        <input type="text" name="pNome" placeholder="Nome" required value="<?= htmlspecialchars($usuario->nome) ?>">

        <label for="pSenha" class="form-label">Senha:</label>
        <input type="text" name="pSenha" placeholder="Senha" required value="<?= htmlspecialchars($usuario->senha) ?>">

        <label for="pConfirmar_senha" class="form-label">Confirmar Senha:</label>
        <input type="password" name="pConfirmar_senha" placeholder="Confirmar Senha" required value="<?= htmlspecialchars($usuario->senha) ?>">

        <label for="pImagem" class="form-label">Foto de Perfil:</label>
        <input type="file" class="file-input" name="pImagem">

        <?php
        if (isset($_SESSION['cadastroErro'])) {
            echo '<p>Erro ao atualizar cadastro. Tente novamente.</p>';
            unset($_SESSION['cadastroErro']);
        }
        ?>
        <input type="submit" class="botao-atualizar" value="Atualizar">
        <input type="hidden" class="btn btn-secondary" value="5" name="pOpcao">
    </form>
</div>

<?php
include 'includes/carregamento-sucesso.inc.php';
?>

<?php
require_once 'includes/rodape.inc.php';
?>