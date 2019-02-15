<?php
namespace entities;

class NoticiaEntity
{
    private $idnoticia;
    private $titulo;
    private $contenido;
    private $fecha;
    private $foto;

    public function __construct($titulo, $contenido, $fecha, $foto, $idnoticia=0)
    {
        $this->idnoticia=$idnoticia;
        $this->titulo=$titulo;
        $this->contenido=$contenido;
        $this->fecha=$fecha;
        $this->foto=$foto;
    }
    /**
     * @return mixed
     */
    public function getIdnoticia()
    {
        return $this->idnoticia;
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
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $idnoticia
     */
    public function setIdnoticia($idnoticia)
    {
        $this->idnoticia = $idnoticia;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @param mixed $contenido
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
}

