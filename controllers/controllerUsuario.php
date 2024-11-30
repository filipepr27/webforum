<?php

require_once '../dao/usuarioDAO.inc.php';

session_start();

$opcao = $_REQUEST['pOpcao'];

switch ($opcao) {
    case 1:
        // fazer login
        $email = $_REQUEST['pLogin'];
        $senha = $_REQUEST['pSenha'];

        $usuarioDao = new UsuarioDao();
        $usuario = $usuarioDao->autenticarUsuario($email, $senha);

        if ($usuario == null) {
            $_SESSION['loginErro'] = true;
            header('Location: ../views/login.php');
        } else {
            $_SESSION['usuarioLogado'] = $usuario;
            header('Location: controllerMensagem.php?pOpcao=1');
        }
        break;
    case 2:
        // cadastrar
        $email = $_REQUEST['pEmail'];
        $nome = $_REQUEST['pNome'];
        $senha = $_REQUEST['pSenha'];

        $usuarioDao = new UsuarioDao();
        $id_usuario = $usuarioDao->cadastrarUsuario($email, $nome, $senha);

        if ($id_usuario != null) {
            if ($_FILES['pImagem']['size'] > 0) {
                uploadImagemCadastro($id_usuario);
            }
            header('Location: ../views/login.php');
        } else {
            $_SESSION['cadastroErro'] = true;
            header('Location: ../views/cadastro.php');
        }
        break;
    case 3:
        // sair
        session_destroy();
        header('Location: ../views/index.php');
        break;
    case 4:
        // recuperar senha
        $email = $_REQUEST['pEmail'];

        $usuarioDao = new UsuarioDao();
        $usuario = $usuarioDao->recuperarSenha($email);

        if ($usuario != null) {
            $senha = $usuario->senha;
            $nome = $usuario->nome;
            $_SESSION['mensagem'] = "Olá, $nome! Sua senha é: $senha";
        } else {
            $_SESSION['mensagem'] = 'Email não encontrado. Tente novamente.';
        }

        header('Location: ../views/login.php');
        break;

    case 5:
        // atualizar dados
        $id = $_SESSION['usuarioLogado']->id;
        $nome = $_REQUEST['pNome'];
        $senha = $_REQUEST['pSenha'];

        $usuarioDao = new UsuarioDao();
        $usuario = $usuarioDao->atualizarUsuario($id, $nome, $senha);
        $_SESSION['usuarioLogado'] = $usuario;

        if ($_FILES['pImagem']['size'] > 0) {
            uploadImagemCadastro($id);
        }

        $_SESSION['cadastroAtualizado'] = true;

        header('Location: ../views/cadastroAtualizar.php');

        break;

    case 6:
        // excluir foto perfil
        $id = $_SESSION['usuarioLogado']->id;
        excluirImagem($id);
        header('Location: ../views/cadastroAtualizar.php');
        break;

    default:
        break;
}

function uploadImagemCadastro($id)
{
    $nome = $id . '.jpg';
    $caminho = '../views/images/perfil/' . $nome;

    $nome_temporario = $_FILES['pImagem']['tmp_name'];
    copy($nome_temporario, $caminho);
}

function excluirImagem($id)
{
    $nome = $id . '.jpg';
    $caminho = '../views/images/perfil/' . $nome;
    if (file_exists($caminho)) {
        unlink($caminho);
    }
}
