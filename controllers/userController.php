<?php
namespace controllers;

use entities\UserEntity;
use helpers\Utilidades;
use helpers\Validaciones;
use models\UserModel;
class userController
{

    public function __construct()
    {}
    
    public function login()
    {
        if(isset($_POST["btnlogin"]))
        {
            $usuDB = new UserModel();
            $usuario=$usuDB->conseguirUsuario($_POST["email"]);
            if($usuario != null)
            {     
                
                if(password_verify($_POST["clave"], $usuario->getPassword()))
                {
                    if(!isset($_SESSION))
                    {
                        session_start();
                    }
                    $_SESSION["usuario"] = $usuario;
                }
            }
        }
        header("location: ".URL_BASE);
    }
    
    public function cerrarSesion()
    {
        Utilidades::borrarSesion("usuario");
        header("location: ".URL_BASE);
    }
    
    public function registro()
    {
        $usuarioDB = null;
        $insertado = false;
        $errorValidacion = false;
        $validacion = array();
        if(isset($_POST['btnregistro']))
        {
            $nombre =  Validaciones::arreglarTextoEntrada($_POST['nombre']);
            $email =  Validaciones::arreglarTextoEntrada($_POST['email']);
            $password =  Validaciones::arreglarTextoEntrada($_POST['password']);

            $validacion['nombre'] = Validaciones::validarNombre($nombre);
            $validacion['email'] = Validaciones::validarEmail($email);
            $validacion['password'] = Validaciones::validarPassword($password);
            if(in_array(false,$validacion)) //en algun campo falla la validacion
            {
                $errorValidacion = true;
            }
            else
            {
                $clave = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
                $usuario = new UserEntity($nombre, $email, $clave);
                $usuarioDB = new UserModel();
                $insertado = $usuarioDB->insertarUsuario($usuario);
            }
        }
        require_once 'views/user/registro.php';
    }
}

