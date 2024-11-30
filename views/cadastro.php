<!DOCTYPE html>
<html>

<head>
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">

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

</head>

<body>
    <section class="container">
        <form action="../controllers/controllerUsuario.php" method="post" onsubmit="return validarSenhas()" enctype="multipart/form-data">
            <a href="index.php">
                <div class="voltar">
                    <img src="assets/icons/seta-voltar.png" alt="seta virada para a esquerda" class="seta">
                    <p class="back-button">
                        &#8592; &nbsp Voltar para o site
                    </p>
                </div>
            </a>
            <h1>Cadastro</h1>
            <!-- <input type="text" name="apelido" placeholder="Apelido" required> -->
            <input type="text" name="pNome" placeholder="Nome" required>
            <input type="email" name="pEmail" placeholder="Email" required>
            <input type="password" name="pSenha" placeholder="Senha" required>
            <input type="password" name="pConfirmar_senha" placeholder="Confirmar Senha" required>
            <label for="pImagem" class="form-label styled-label">Foto de Perfil:</label>
            <input type="file" class="form-control file-input" name="pImagem">

            <?php
            session_start();
            if (isset($_SESSION['cadastroErro'])) {
                echo '<p>Erro ao cadastrar. Tente novamente.</p>';
                unset($_SESSION['cadastroErro']);
            }
            ?>
            <input type="submit" value="Cadastrar">
            <input type="hidden" value="2" name="pOpcao">
        </form>
        <div class="button-container">
            <button onclick="window.location.href='login.php'">Fazer Login</button>
        </div>
    </section>
</body>

</html>