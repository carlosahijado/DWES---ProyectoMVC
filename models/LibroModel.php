<?php
namespace models;

use entities\LibroEntity;
use entities\ComentarioLibroEntity;
use PDO;
use PDOException;

class LibroModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function conseguirLibros($tabla, $limite=50, $desplazamiento=0, $cerrarconexion=true)
    {
        $filas = array();
        try
        {
            $sql="select * from $tabla LIMIT $limite OFFSET $desplazamiento";
            $resultado=$this->conexion->query($sql);
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                $noticia=new LibroEntity($fila["titulo"], $fila["genero"], $fila["autor"], $fila["contenido"], $fila["foto"], $fila["idlibro"]);
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
    
    public function genero($limite=1000, $desplazamiento=0, $cerrarconexion=true)
    {
        $generos = array();
        try
        {
            $sql="select distinct genero
                  from libros LIMIT $limite OFFSET $desplazamiento";
            $resultado=$this->conexion->query($sql);
            
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                $generos[]=$fila["genero"];
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
            return $generos;
        }
    }
    
    public function librosPorGenero($genero, $limite, $desplazamiento, $cerrarconexion=true)
    {
        $filas = array();
        try
        {
            $sql="select idlibro, titulo, genero, autor, contenido, foto FROM libros
                  WHERE genero like '$genero' LIMIT $limite OFFSET $desplazamiento";
            $resultado=$this->conexion->query($sql);
            
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                $filas[]=new LibroEntity($fila["titulo"], $fila["genero"], $fila["autor"], $fila["contenido"], $fila["foto"], $fila["idlibro"]);
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
    
    public function insertarLibro($libro, $cerrarconexion=true)
    {
        $titulo=$libro->getTitulo();
        $genero=$libro->getGenero();
        $autor=$libro->getAutor();
        $contenido=$libro->getContenido();
        $foto=$libro->getFoto();
        $insercion = false;
        try
        {
            $sql = "insert into libros
                (titulo,genero,autor,contenido,foto) values
                (:titulo, :genero, :autor, :contenido, :foto)";
            $sqlpreparado = $this->conexion->prepare($sql);
            $sqlpreparado->bindParam(':titulo', $titulo);
            $sqlpreparado->bindParam(':genero', $genero);
            $sqlpreparado->bindParam(':autor', $autor);
            $sqlpreparado->bindParam(':contenido', $contenido);
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
            echo "<br>error al añadir el libro<br>". $e->getMessage()."<br>";
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
    
    public function conseguirLibro($tabla, $columna, $valor, $cerrarconexion=true)
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
                    $fila=new LibroEntity($registro["titulo"], $registro["genero"], $registro["autor"], $registro["contenido"], $registro["foto"], $registro["idlibro"]);
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
    
    public function editarLibro($libro, $cerrarconexion=true)
    {
        $idlibro=$libro->getIdlibro();
        $titulo=$libro->getTitulo();
        $genero=$libro->getGenero();
        $autor=$libro->getAutor();
        $contenido=$libro->getContenido();
        $foto=$libro->getFoto();
        $actualizado=false;
        $sqlpreparado = null;
        try {
            $sql="UPDATE libros SET
                titulo=:titulo,
                genero=:genero,
                autor=:autor,
                contenido=:contenido,
                foto=:foto
                WHERE idlibro=:idlibro";
            $sqlpreparado = $this->conexion->prepare($sql);
            $sqlpreparado->bindParam(':idlibro', $idlibro);
            $sqlpreparado->bindParam(':titulo', $titulo);
            $sqlpreparado->bindParam(':contenido', $contenido);
            $sqlpreparado->bindParam(':genero', $genero);
            $sqlpreparado->bindParam(':autor', $autor);
            $sqlpreparado->bindParam(':foto', $foto);
            $sqlpreparado->execute();
            if($sqlpreparado->rowCount()>0)
            {
                $actualizado = true;
            }
        }
        catch (PDOException $e)
        {
            echo "<br>error al actualizar el libro<br>". $e->getMessage()."<br>";
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
    
    public function comentariosLibro($idlibro, $cerrarconexion=true)
    {
        $filas = array();
        try
        {
            $sql="select c.idcomentario, c.contenido, c.idlibro, c.idusuario, u.nombre
                from comentario_libro c join usuarios u on(c.idusuario=u.idusuario) WHERE idlibro=$idlibro";
            $resultado=$this->conexion->query($sql);
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                $comentario=new ComentarioLibroEntity($fila["contenido"], $fila["nombre"], $fila["idcomentario"], $fila["idusuario"], $fila["idlibro"]);
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

