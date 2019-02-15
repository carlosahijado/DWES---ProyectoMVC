<?php
namespace controllers;

use entities\ComentarioNoticiaEntity;
use entities\ComentarioLibroEntity;
use models\ComentarioModel;
use models\BaseModel;

class comentarioController
{

    public function __construct()
    {}
    
    public function insertarComentarioNoticia()
    {
        $insertado=false;
        if(isset($_POST["btninsertar"]))
        {
            $cm = new ComentarioModel();
            $comentario=new ComentarioNoticiaEntity($_POST["contenido"],"", 0, $_SESSION["usuario"]->getIdusuario(), $_GET["idnoticia"]);
            $insertado=$cm->insertarComentario($comentario, false);
            header("location: ".URL_BASE."/noticia/index");
        }
    }
    
    public function insertarComentarioLibro()
    {
        $insertado=false;
        echo $_GET["idlibro"];
        if(isset($_POST["btninsertar"]))
        {
            $cm = new ComentarioModel();
            $comentario=new ComentarioLibroEntity($_POST["contenido"],"", 0, $_SESSION["usuario"]->getIdusuario(), $_GET["idlibro"]);
            $insertado=$cm->insertarComentarioLibro($comentario, false);
            header("location: ".URL_BASE."/libro/mostrar");
        }
    }
    
    public function borrarComentarioNoticia()
    {
        if(isset($_GET["idcomentario"]))
        {
            $bm = new BaseModel();
            $bm->borrarUno("comentario_noticia", "idcomentario", $_GET["idcomentario"]);
        }
        header("location: ".URL_BASE);
    }
    
    public function borrarComentarioLibro()
    {
        if(isset($_GET["idcomentario"]))
        {
            $bm = new BaseModel();
            $bm->borrarUno("comentario_libro", "idcomentario", $_GET["idcomentario"]);
        }
        header("location: ".URL_BASE);
    }
}

