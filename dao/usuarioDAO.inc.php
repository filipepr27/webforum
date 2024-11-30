<?php

require_once '../classes/usuario.inc.php';
require_once 'conexao.inc.php';

class UsuarioDao
{
    private $con;
    function __construct()
    {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    public function cadastrarUsuario($email, $nome, $senha)
    {
        $id_usuario = null;
        $id_usuario = $this->gerarGUID();

        $sqlVerificaEmail = $this->con->prepare("SELECT * FROM usuario WHERE email =:email");
        $sqlVerificaEmail->bindValue(':email', $email);
        $sqlVerificaEmail->execute();
        if ($sqlVerificaEmail->rowCount() == 0) {
            $sql = $this->con->prepare("INSERT INTO usuario (idUsuario, email, login, nome, senha) VALUES (:id, :email, :email, :nome, :senha)");
            $sql->bindValue(':id', $id_usuario);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':senha', $senha);
            $sql->execute();
        }

        return $id_usuario;
    }

    public function autenticarUsuario($email, $senha)
    {
        $sql = $this->con->prepare("SELECT * FROM usuario WHERE email =:email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        $usuario = null;

        if ($sql->rowCount() == 1) {
            $usuarioResponse = $sql->fetch(PDO::FETCH_ASSOC);

            if ($senha == $usuarioResponse['senha']) {
                $usuario = new Usuario();
                $usuario->setUsuarioComSenha($usuarioResponse['idUsuario'], $usuarioResponse['email'], $usuarioResponse['nome'], $usuarioResponse['senha']);
                return $usuario;
            }
        }

        return $usuario;
    }

    public function obterTodosUsuarios()
    {
        $sql = $this->con->query("SELECT idUsuario, email, nome FROM usuario");
        $usuarioResponse = $sql->fetchAll(PDO::FETCH_ASSOC);

        $usuarios = [];

        foreach ($usuarioResponse as $us) {
            $usuario = new Usuario();
            $usuario->setUsuario($us['idUsuario'], $us['email'], $us['nome']);
            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    public function excluirUsuario($id)
    {
        $sql = $this->con->prepare("DELETE FROM clientes WHERE id =:id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function recuperarSenha($email)
    {
        $sql = $this->con->prepare("SELECT * FROM usuario WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        $usuario = null;

        if ($sql->rowCount() == 1) {
            $usuarioResponse = $sql->fetch(PDO::FETCH_ASSOC);
            $usuario = new Usuario();
            $usuario->setUsuarioComSenha($usuarioResponse['idUsuario'], $usuarioResponse['email'], $usuarioResponse['nome'], $usuarioResponse['senha']);
        }

        return $usuario;
    }

    public function atualizarUsuario($id, $nome, $senha)
    {
        $sql = $this->con->prepare("UPDATE usuario SET nome = :nome, senha = :senha WHERE idUsuario = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        $sql = $this->con->prepare("SELECT * FROM usuario WHERE idUsuario = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $usuarioResponse = $sql->fetch(PDO::FETCH_ASSOC);

        $usuario = new Usuario();
        $usuario->setUsuarioComSenha($usuarioResponse['idUsuario'], $usuarioResponse['email'], $nome, $usuarioResponse['senha']);

        return $usuario;
    }

    private function gerarGUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
