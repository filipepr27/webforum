<?php

class Usuario
{
    private $email;
    private $login;
    private $nome;
    private $senha;
    private $id;

    // Email e Login serão iguais

    function __construct() {}

    function cadastrarUsuario($email, $nome, $hashSenha)
    {
        $this->email = $email;
        $this->login = $email;
        $this->nome = $nome;
        $this->senha = $hashSenha;
    }

    function setUsuario($id, $email, $nome)
    {
        $this->id = $id;
        $this->email = $email;
        $this->nome = $nome;
    }

    function setUsuarioComSenha($id, $email, $nome, $senha)
    {
        $this->id = $id;
        $this->email = $email;
        $this->nome = $nome;
        $this->senha = $senha;
    }

    function __get($atributo)
    {
        return $this->$atributo;
    }

    function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
}
