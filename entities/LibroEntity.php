<?php
namespace entities;

class LibroEntity
{
    private $idlibro;
    private $titulo;
    private $genero;
    private $autor;
    private $contenido;
    private $foto;
    
    public function __construct($titulo, $genero, $autor, $contenido, $foto, $idlibro=0)
    {
        $this->titulo=$titulo;
        $this->genero=$genero;
        $this->autor=$autor;
        $this->contenido=$contenido;
        $this->foto=$foto;
        $this->idlibro=$idlibro;
    }
    /**
     * @return number
     */
    public function getIdlibro()
    {
        return $this->idlibro;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @return mixed
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param number $idlibro
     */
    public function setIdlibro($idlibro)
    {
        $this->idlibro = $idlibro;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
    /**
     * @return mixed
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * @param mixed $contenido
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }
}

