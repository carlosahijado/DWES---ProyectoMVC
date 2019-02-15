<?php
namespace helpers;

class Validaciones
{

    public function __construct()
    {
        
    }
    
    public static function validarEmail($email)
    {
        $validado = true;
        if(!strcmp($email,''))
        {
            $validado = false;
        }
        else{
            if(!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $validado = false;
            }
        }
        return $validado;
    }
    
    public static function validarNombre($nombre)
    {
     $patronNombre = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,50}$/";
     $validado = true;
     if(!strcmp($nombre,''))
     {
         $validado = false;
     }
     else{
         if(!is_string($nombre) || !preg_match($patronNombre, $nombre))
         {
             $validado = false;
         }
     }
     return $validado;
    }
    
    public static function validarApellidos($apellidos)
    {
        $patronApellidos = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,50}$/";
        $validado = true;
        if(!strcmp($apellidos,''))
        {
            $validado = false;
        }
        else{
            if(!is_string($apellidos) || !preg_match($patronApellidos, $apellidos))
            {
                $validado = false;
            }
        }
        return $validado;
    }
    
    public static function validarPassword($password)
    {
        return true;
    }
    
    public static function arreglarTextoEntrada($texto)
    {
        $texto = trim($texto);
        $texto = stripslashes($texto);
        $texto = htmlspecialchars($texto);
        return $texto;
    }
    
    public static function validarRol($rol)
    {
        $validado=false;
        if (!strcasecmp($rol, "admin") || !strcasecmp($rol, "user"))
        {
            $validado=true;
        }
        return $validado;
    }
}

