<?php
namespace models;

use entities\UserEntity;
use PDOException;

class UserModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function conseguirUsuario($email, $cerrarconexion=true)
    {
        $elusuario=null;
        $fila=$this->conseguirUno("usuarios", "email", $email, $cerrarconexion);
        if($fila != null)
        {
            $elusuario=new UserEntity($fila["nombre"], $fila["email"], $fila["password"], $fila["rol"], $fila["idusuario"]);
        }
        return $elusuario;
    }
    
    public function insertarUsuario($usuario, $cerrarconexion=true)
    {
        $nombre=$usuario->getNombre();
        $email= $usuario->getEmail();
        $password = $usuario->getPassword();
        $insercion = false;
        try
        {
            $sql = "insert into usuarios
                (nombre,email,password) values
                (:nombre,:email,:password)";
            $sqlpreparado = $this->conexion->prepare($sql);
            $sqlpreparado->bindParam(':nombre', $nombre);
            $sqlpreparado->bindParam(':email', $email);
            $sqlpreparado->bindParam(':password', $password);
            $sqlpreparado->execute();
            if($sqlpreparado->rowCount()>0)
            {
                $insercion = true;
            }
            else
            {
                echo "<br>registro no se ha insertado <br>";
            }
        }
        catch (PDOException $e)
        {
            echo "<br>error al añadir el usuario<br>". $e->getMessage()."<br>";
        }
        finally
        {
            $sqlpreparado->closeCursor();
            if($cerrarconexion)
            {
                $this->conexion= null;
            }
        }
        return $insercion;
        
    }
}

