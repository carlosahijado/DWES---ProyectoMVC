<?php
namespace models;

use config\Database;
use PDO;
use PDOException;

class BaseModel
{
    protected $conexion;
    public function __construct()
    {
        $this->conexion=Database::conectar();
    }
    
    public function conseguirTodos($tabla, $limite=50, $desplazamiento=0, $cerrarconexion=true)
    {
        $filas = array();
        try
        {
            $sql="select * from $tabla ORDER BY fecha desc LIMIT $limite OFFSET $desplazamiento";
            $resultado=$this->conexion->query($sql);
            
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                $filas[]=$fila;
            }
        }
        catch (PDOException $e)
        {
            echo "<br>Error al recuperar datos<br>". $e->getMessage()."<br>";
        }
        finally
        {
            if ($cerrarconexion)
            {
                $this->conexion=null;
            }
            return $filas;
        }
    }
    
    public function conseguirUno($tabla, $columna, $valor, $cerrarconexion=true)
    {
        $fila=null;
        $sqlpreparado=null;
        try
        {
            $sql= "select * from $tabla where $columna=:valor LIMIT 1";
            $sqlpreparado = $this->conexion->prepare($sql);
            $sqlpreparado->bindParam(":valor", $valor);
            $sqlpreparado->execute();
            if($sqlpreparado->rowCount()>0)
            {
                if($registro = $sqlpreparado->fetch(PDO::FETCH_ASSOC))
                {
                    $fila=$registro;
                }
            }
        }
        catch(PDOException $e)
        {
            echo "error al recuperar el dato".$e->getMessage();
        }
        finally
        {
            $sqlpreparado->closeCursor();
            if ($cerrarconexion)
            {
                $this->conexion=null;
            }
            return $fila;
        }
    }
    
    function borrarUno($tabla, $idtabla, $valor, $cerrarconexion=true)
    {
        $borradoOK = true;
        $sqlpreparado = null;
        try{
            $sql = "delete from " . $tabla . " where " . $idtabla . " like :valor";
            $sqlpreparado = $this->conexion->prepare($sql);
            $sqlpreparado->bindParam(':valor', $valor);
            $sqlpreparado->execute();
            if($sqlpreparado->rowCount()>0)
            {
                $borradoOK = true;
            }
        }
        catch (PDOException $e)
        {
            echo "<br>error al borrar el registro <br>". $e->getMessage()."<br>";
        }
        finally {
            $sqlpreparado->closeCursor();
            if($cerrarconexion)
            {
                $this->conexion= null;
            }
        }
        return $borradoOK;
    }
}

