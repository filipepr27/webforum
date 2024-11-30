<!-- TALLES HENRIQUE TEÓFILO DOS SANTOS - 2020204803 - MODIFICAÇÃO FEITA PARA PROVA -->

<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <a href="../controllers/controllerMensagem.php?pOpcao=1" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img src="./assets/images/logo-semfundo.png" style="height: 8rem; width: auto;">&nbsp;&nbsp;
        <h4> Web Forum</h4>
    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

        <li><a href="../controllers/controllerMensagem.php?pOpcao=1" class="nav-link px-2 link-secondary">Caixa de Entrada</a></li>
        <li><a href="../controllers/controllerMensagem.php?pOpcao=4" class="nav-link px-2 link-secondary">Enviados</a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="postDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                POST
            </a>
            <ul class="dropdown-menu" aria-labelledby="postDropdown">
                <li><a class="dropdown-item" href="../controllers/controllerPost.php?pOpcao=1">Visualizar POST</a></li>
                <li><a class="dropdown-item" href="../views/criarPost.php">Criar POST</a></li>
            </ul>
        </li>
        <?php
        include "./modalEscreverMensagem.php";
        ?>
        </li>

        <li><a href="cadastroAtualizar.php" class="nav-link px-2 link-secondary">Atualizar Dados</a></li>

    </ul>

    <div class="col-md-3 text-end">

        <?php
        $usuario = $_SESSION['usuarioLogado'];
        echo $usuario->email;
        include_once "modal.inc.php";
        ?>

    </div>
</header>