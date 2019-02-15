<?php
namespace controllers;

use helpers\Utilidades;
use helpers\Validaciones;
use models\LibroModel;
use models\BaseModel;
use entities\LibroEntity;
class libroController
{

    public function __construct()
    {}
    
    public function mostrar()
    {
        $bm = new LibroModel();
        $libros = $bm->conseguirLibros("libros");
        include "views/libro/mostrar.php";
    }
    
    public function genero()
    {
        if(!isset($_GET["genero"]))
        {
            header("location:".URL_BASE);
        }
        $lm = new LibroModel();
        $libros = $lm->librosPorGenero($_GET["genero"], 9, 0, false);
        include "views/libro/genero.php";
    }
    
    public function borrar()
    {
        Utilidades::esAdmin();
        echo $_GET["idlibro"];
        if(isset($_GET["idlibro"]))
        {
            $bm = new BaseModel();
            $bm->borrarUno("libros", "idlibro", $_GET["idlibro"]);
            echo "llega";
        }
        header("location: ".URL_BASE);
    }
    
    public function insertar()
    {
        $libroDB = null;
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
            $genero =  Validaciones::arreglarTextoEntrada($_POST['genero']);
            $autor =  Validaciones::arreglarTextoEntrada($_POST['autor']);
            $contenido = $_POST['contenido'];
            //$validacion['titulo'] = Validaciones::validarNombre($nombre);
            $validacion['genero'] = Validaciones::validarNombre($genero);
            $validacion['autor'] = Validaciones::validarNombre($autor);
            if(in_array(false,$validacion))
            {
                $errorValidacion = true;
            }
            else
            {
                $libro = new LibroEntity($titulo, $genero, $autor, $contenido, $foto);
                $libroDB = new LibroModel();
                $insertado = $libroDB->insertarLibro($libro);
            }
        }
        require_once 'views/libro/insertar.php';
    }
    
    public function ver()
    {
        $fila=null;
        $comentarios=null;
        if(isset($_GET["idlibro"]))
        {
            $bm = new LibroModel();
            $fila=$bm->conseguirLibro("libros", "idlibro", $_GET["idlibro"],false);
            $comentarios=$bm->comentariosLibro($_GET["idlibro"],false);
        }
        include "views/libro/ver.php";
    }
    
    public function editar()
    {
        Utilidades::esAdmin();
        $foto = null;
        $editado = false;
        $libro = null;
        $l1 = new LibroModel();
        if(isset($_POST['btneditar']))
        {
            if(!empty($_FILES['foto']))
            {
                $foto = Utilidades::leerimagen($_FILES['foto']);
            }
            $libro = new LibroEntity($_POST['titulo'],$_POST['genero'],$_POST['autor'],$_POST["contenido"],$foto);
            $libro->setIdlibro($_POST['idlibro']);
            $editado = $l1->editarLibro($libro,false);
            $libro = $l1->conseguirLibro("libros", "idlibro", $_POST['idlibro']);
            header("location: ".URL_BASE."/libro/mostrar");
        }
        elseif (isset($_GET["idlibro"]))
        {
            $libro = $l1->conseguirLibro("libros", "idlibro", $_GET['idlibro']);
        }
        require_once 'views/libro/editar.php' ;
    }
}

