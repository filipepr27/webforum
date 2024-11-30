<?php

class Mensagem
{
    public $id;
    public $remetente_email;
    public $remetente_nome;
    public $remetente_id;
    public $destinatario_email;
    public $destinatario_nome;
    public $destinatario_id;
    public $data;
    public $conteudo;
    public $titulo;
    public $assunto;

    function __construct() {}

    function criarMensagem($remetente_id, $destinatario_id, $conteudo, $titulo, $assunto)
    {
        $this->remetente_id = $remetente_id;
        $this->destinatario_id = $destinatario_id;
        $this->conteudo = $conteudo;
        $this->titulo = $titulo;
        $this->assunto = $assunto;
        $this->data = new DateTime();
        $this->data = $this->data->format('Y-m-d H:i:s');
    }

    function setMensagem($id, $remetente_id, $remetente_email, $remetente_nome, $destinatario_id, $destinatario_email, $destinatario_nome, $data, $conteudo, $titulo, $assunto)
    {
        $this->id = $id;
        $this->remetente_id = $remetente_id;
        $this->remetente_email = $remetente_email;
        $this->remetente_nome = $remetente_nome;
        $this->destinatario_id = $destinatario_id;
        $this->destinatario_email = $destinatario_email;
        $this->destinatario_nome = $destinatario_nome;
        $this->data = new DateTime($data);
        $this->data->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        $this->data = $this->data->format('d-m-Y H:i');
        $this->conteudo = $conteudo;
        $this->titulo = $titulo;
        $this->assunto = $assunto;
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
