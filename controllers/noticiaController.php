<?php
namespace controllers;

use models\NoticiaModel;
use helpers\Utilidades;
use helpers\Validaciones;
use models\BaseModel;
use entities\NoticiaEntity;

class noticiaController
{

    public function __construct()
    {}
    
    public function index()
    {
        $bm = new NoticiaModel();
        $noticias=$bm->conseguirNoticias("noticias",5);
        include "views/noticia/mostrar.php";
    }
    
    public function ver()
    {
        $fila=null;
        $comentarios=null;
        if(isset($_GET["idnoticia"]))
        {
            $bm = new NoticiaModel();
            $fila=$bm->conseguirNoticia("noticias", "idnoticia", $_GET["idnoticia"],false);
            $comentarios=$bm->comentariosNoticia($_GET["idnoticia"],false);
        }
        include "views/noticia/ver.php";
    }
    
    public function borrar()
    {
        Utilidades::esAdmin();
        if(isset($_GET["idnoticia"]))
        {
            $bm = new BaseModel();
            $bm->borrarUno("noticias", "idnoticia", $_GET["idnoticia"]);
        }
        header("location: ".URL_BASE);
    }
    
    public function insertar()
    {
        $noticiaDB = null;
        $insertado = false;
        $errorValidacion = false;
        $validacion = array();
        if(isset($_POST['btninsertar']))
        {
            if(isset($_FILES['foto']))
            {
                $foto = Utilidades::leerimagen($_FILES['foto']);
            }
            $titulo =  Validaciones::arreglarTextoEntrada($_POST['titulo']);
            $contenido = $_POST['contenido'];
            $fecha =  $_POST['fecha'];

            if(in_array(false,$validacion))
            {
                $errorValidacion = true;
            }
            else
            {
                $noticia = new NoticiaEntity($titulo, $contenido, $fecha, $foto);
                $noticiaDB = new NoticiaModel();
                $insertado = $noticiaDB->insertarNoticia($noticia);
            }
        }
        require_once 'views/noticia/insertar.php';
    }
    
    public function editar()
    {
        Utilidades::esAdmin();
        $foto = null;
        $editado = false;
        $noticia = null;
        $n1 = new NoticiaModel();
        if(isset($_POST['btneditar']))
        {
            if(!empty($_FILES['foto']))
            {
                $foto = Utilidades::leerimagen($_FILES['foto']);
            }
            $noticia = new NoticiaEntity($_POST['titulo'],$_POST['contenido'],$_POST['fecha'],$foto);
            $noticia->setIdnoticia($_POST['idnoticia']);
            $editado = $n1->editarNoticia($noticia,false);
            $noticia = $n1->conseguirNoticia("noticias", "idnoticia", $_POST['idnoticia']);
            header("location: ".URL_BASE);
        }
        elseif (isset($_GET["idnoticia"]))
        {
            $noticia = $n1->conseguirNoticia("noticias", "idnoticia", $_GET['idnoticia']);
        }
        require_once 'views/noticia/editar.php' ;
    }
}

