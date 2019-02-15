<?php
namespace models;

use PDOException;

class ComentarioModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function insertarComentario($comentario, $cerrarconexion=true)
    {
        $contenido=$comentario->getContenido();
        $idusuario=$comentario->getIdusuario();
        $idnoticia=$comentario->getIdnoticia();
        
        $insercion = false;
        
        try
        {
            $sql = "insert into comentario_noticia
                    (contenido, idnoticia, idusuario) values 
                    (:contenido, :idnoticia, :idusuario)";
            $sqlpreparado = $this->conexion->prepare($sql);
            $sqlpreparado->bindParam(':contenido', $contenido);
            $sqlpreparado->bindParam(':idusuario', $idusuario);
            $sqlpreparado->bindParam(':idnoticia', $idnoticia);
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
            echo "<br>error al añadir el comentario<br>". $e->getMessage()."<br>";
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
    
    public function insertarComentarioLibro($comentario, $cerrarconexion=true)
    {
        $contenido=$comentario->getContenido();
        $idusuario=$comentario->getIdusuario();
        $idlibro=$comentario->getIdlibro();
        
        $insercion = false;
        
        try
        {
            $sql = "insert into comentario_libro
                    (contenido, idlibro, idusuario) values
                    (:contenido, :idlibro, :idusuario)";
            $sqlpreparado = $this->conexion->prepare($sql);
            $sqlpreparado->bindParam(':contenido', $contenido);
            $sqlpreparado->bindParam(':idusuario', $idusuario);
            $sqlpreparado->bindParam(':idlibro', $idlibro);
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
            echo "<br>error al añadir el comentario<br>". $e->getMessage()."<br>";
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

