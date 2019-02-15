<?php
namespace models;

use PDO;
use PDOException;
use entities\NoticiaEntity;
use entities\ComentarioNoticiaEntity;

class NoticiaModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function conseguirNoticias($tabla, $limite=50, $desplazamiento=0, $cerrarconexion=true)
    {
        $filas = array();
        try
        {
            $sql="select * from $tabla ORDER BY fecha desc LIMIT $limite OFFSET $desplazamiento";
            $resultado=$this->conexion->query($sql);
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
            {     
                $noticia=new NoticiaEntity($fila["titulo"], $fila["contenido"], $fila["fecha"], $fila["foto"], $fila["idnoticia"]);
                $filas[]=$noticia;
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
    
    public function conseguirNoticia($tabla, $columna, $valor, $cerrarconexion=true)
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
                    $fila=new NoticiaEntity($registro["titulo"], $registro["contenido"], $registro["fecha"], $registro["foto"],$registro["idnoticia"]);
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
    
    public function insertarNoticia($noticia, $cerrarconexion=true)
    {
        $titulo=$noticia->getTitulo();
        $contenido=$noticia->getContenido();
        $foto=$noticia->getFoto();
        $fecha=$noticia->getFecha();
        $insercion = false;
        try
        {
            $sql = "insert into noticias
                (titulo,contenido,fecha,foto) values
                (:titulo, :contenido, :fecha, :foto)";
            $sqlpreparado = $this->conexion->prepare($sql);
            $sqlpreparado->bindParam(':titulo', $titulo);
            $sqlpreparado->bindParam(':contenido', $contenido);
            $sqlpreparado->bindParam(':fecha', $fecha);
            $sqlpreparado->bindParam(':foto', $foto);
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
            echo "<br>error al añadir la noticia<br>". $e->getMessage()."<br>";
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
    
    public function editarNoticia($noticia, $cerrarconexion=true)
    {
        $idnoticia=$noticia->getIdnoticia();
        $titulo=$noticia->getTitulo();
        $contenido=$noticia->getContenido();
        $fecha=$noticia->getFecha();
        $foto=$noticia->getFoto();
        $actualizado=false;
        $sqlpreparado = null;
        try {
            $sql="UPDATE noticias SET 
                titulo=:titulo,
                contenido=:contenido,
                fecha=:fecha,
                foto=:foto 
                WHERE idnoticia=:idnoticia";
            $sqlpreparado = $this->conexion->prepare($sql);
            $sqlpreparado->bindParam(':idnoticia', $idnoticia);
            $sqlpreparado->bindParam(':titulo', $titulo);
            $sqlpreparado->bindParam(':contenido', $contenido);
            $sqlpreparado->bindParam(':fecha', $fecha);
            $sqlpreparado->bindParam(':foto', $foto);
            $sqlpreparado->execute();
            if($sqlpreparado->rowCount()>0)
            {
                $actualizado = true;
            }
        } 
        catch (PDOException $e)
        {
            echo "<br>error al actualizar la noticia<br>". $e->getMessage()."<br>";
        }
        finally {
            $sqlpreparado->closeCursor();
            if($cerrarconexion)
            {
                $this->conexion= null;
            }
        }
        return $actualizado;
    }
    
    public function comentariosNoticia($idnoticia, $cerrarconexion=true)
    {
        $filas = array();
        try
        {
            $sql="select c.idcomentario, c.contenido, c.idnoticia, c.idusuario, u.nombre
                from comentario_noticia c join usuarios u on(c.idusuario=u.idusuario) WHERE idnoticia=$idnoticia";
            $resultado=$this->conexion->query($sql);
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                $comentario=new ComentarioNoticiaEntity($fila["contenido"], $fila["nombre"], $fila["idcomentario"], $fila["idusuario"], $fila["idnoticia"]);
                $filas[]=$comentario;
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
}

