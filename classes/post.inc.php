<!-- TALLES HENRIQUE TEÓFILO DOS SANTOS - 2020204803 - MODIFICAÇÃO FEITA PARA PROVA -->


<?php

class Post
{
    public $ID_post;
    public $Titulo;
    public $Texto;
    public $remetente_email;

    function __construct() {}

    function setPost($ID_post, $Titulo, $Texto, $remetente_email)
    {
        $this->ID_post = $ID_post;
        $this->Titulo = $Titulo;
        $this->Texto = $Texto;
        $this->remetente_email = $remetente_email;
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
