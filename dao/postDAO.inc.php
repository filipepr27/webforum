<!-- TALLES HENRIQUE TEÓFILO DOS SANTOS - 2020204803 - MODIFICAÇÃO FEITA PARA PROVA -->



<?php
require_once 'conexao.inc.php';
require_once '../classes/post.inc.php';

class PostDao
{
    private $con;
    function __construct()
    {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    public function obterTodosPosts()
    {
        $sql = $this->con->prepare("SELECT * FROM post ORDER BY ID_post DESC");
        $sql->execute();
        $postsResponse = $sql->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];

        if ($sql->rowCount() > 0) {
            foreach ($postsResponse as $postData) {
                $post = new Post();
                $post->setPost(
                    $postData['ID_post'],
                    $postData['Titulo'],
                    $postData['Texto'],
                    $postData['remetente_email']
                );
                $posts[] = $post;
            }
        }

        return $posts;
    }

    public function obterPostPorID($ID_post)
    {
        $sql = $this->con->prepare("SELECT * FROM post WHERE ID_post = :ID_post");
        $sql->bindValue(':ID_post', $ID_post);
        $sql->execute();
        $postData = $sql->fetch(PDO::FETCH_ASSOC);

        if ($postData) {
            $post = new Post();
            $post->setPost(
                $postData['ID_post'],
                $postData['Titulo'],
                $postData['Texto'],
                $postData['remetente_email']
            );
            return $post;
        }

        return null;
    }

    public function seguirPost($ID_post, $email)
    {
        $sql = $this->con->prepare("INSERT INTO postSeguido (ID_Post, email) VALUES (:ID_post, :email)");
        $sql->bindValue(':ID_post', $ID_post);
        $sql->bindValue(':email', $email);
        $sql->execute();
    }

    public function enviarPost($post)
    {
        $sql = $this->con->prepare("INSERT INTO post (Titulo, Texto, remetente_email) VALUES (:Titulo, :Texto, :remetente_email)");
        $sql->bindValue(':Titulo', $post->Titulo);
        $sql->bindValue(':Texto', $post->Texto);
        $sql->bindValue(':remetente_email', $post->remetente_email);
        $sql->execute();

        $post->ID_post = $this->con->lastInsertId();
    }

    public function obterSeguidoresPorPostID($ID_post)
    {
        $sql = $this->con->prepare("SELECT email FROM postSeguido WHERE ID_Post = :ID_post");
        $sql->bindValue(':ID_post', $ID_post);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
