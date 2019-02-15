<?php
namespace helpers;

class Utilidades
{
    public static function borrarSesion($nombre)
    {
        if(isset($_SESSION[$nombre]))
        {
            unset($_SESSION[$nombre]);
        }
    }
    
    public static function esAdmin()
    {
        $esadmin = false;
        if(isset($_SESSION['usuario']))
        {
            if(strcmp($_SESSION['usuario']->getRol(),"admin"))
            {
                $direccion = URL_BASE;
                header("Location:".$direccion);
            }
            else{
            $esadmin = true;
            }
        }
        else{
            $direccion = URL_BASE;
            header("Location:".$direccion);
        }
        return $esadmin;
    }

    public static function leerimagen($foto)
    {
        $contenido = null;
        if(isset($foto) && $foto["error"]!= 4 )
        {
            $archivo = fopen($foto['tmp_name'], "r");
            if ($archivo) {
                $contenido = fread($archivo, $foto['size']);
                fclose($archivo);
            }
        }
        return $contenido;
    }
}

