<?php
require_once 'autocarga.php';
require_once 'config/parametros.php';
require_once 'views/layout/header.php';
require_once 'views/layout/nav.php';
$controladorvalido = true;
$accionvalida = true;
$nombreControlador = '';
$accion = '';

if(!isset($_GET['controlador'])&&!isset($_GET['accion']))
{
    $nombreControlador = 'controllers\\'. CONTROLADOR_DEFECTO. 'Controller';
    $accion = ACCION_DEFECTO;
    $controlador = new $nombreControlador;
    $controlador->$accion();
}
elseif(isset($_GET['controlador']))
{
    $nombreControlador = 'controllers\\'. $_GET['controlador']. 'Controller';
    $nombreFichero = CARPETA_BASE.'\\controllers\\'. $_GET['controlador']. 'Controller.php';
    if(file_exists($nombreFichero) && class_exists($nombreControlador))
    {
        if( isset($_GET['accion']) && method_exists($nombreControlador, $_GET['accion']))
        {
            $accion = $_GET['accion'];
            $controlador = new $nombreControlador;
            $controlador->$accion();
        }
        else{
            $accionvalida = false;
        }
    }
    else
    {
        $controladorvalido = false;
    }
}
else
{
    $controladorvalido = false;
}

if(!$controladorvalido || !$accionvalida)
{
    $nombreControlador = "controllers\\".CONTROLADOR_DEFECTO."Controller";
    $accion = ACCION_DEFECTO;
    $controlador = new $nombreControlador;
    $controlador->$accion();
    
}
require_once 'views/layout/footer.php';