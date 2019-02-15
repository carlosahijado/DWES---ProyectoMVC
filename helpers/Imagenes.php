<?php
namespace helpers;

class Imagenes
{

    public function __construct()
    {}
    
    public static function leerimagen($foto)
    {
        $contenido = null;
        if(isset($foto) && $foto["error"]!= 4 ) 
        //si hay foto y seleccionaste algo para subir (error code 4)
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

