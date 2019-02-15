<?php
namespace entities;

class ComentarioNoticiaEntity
{
    private $idnoticia;
    private $idcomentario;
    private $contenido;
    private $idusuario;
    private $nombreusuario;
    public function __construct($contenido, $nombreusuario="" ,$idcomentario = 0, $idusuario = 0, $idnoticia=0)
    {
        $this->contenido=$contenido;
        $this->idcomentario=$idcomentario;
        $this->idusuario=$idusuario;
        $this->idnoticia=$idnoticia;
        $this->nombreusuario=$nombreusuario;
    }
    /**
     * @return mixed
     */
    public function getIdnoticia()
    {
        return $this->idnoticia;
    }

    /**
     * @param mixed $idnoticia
     */
    public function setIdnoticia($idnoticia)
    {
        $this->idnoticia = $idnoticia;
    }
    /**
     * @return number
     */
    public function getIdcomentario()
    {
        return $this->idcomentario;
    }

    /**
     * @return mixed
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * @return number
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * @param number $idcomentario
     */
    public function setIdcomentario($idcomentario)
    {
        $this->idcomentario = $idcomentario;
    }

    /**
     * @param mixed $contenido
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }

    /**
     * @param number $idusuario
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }
    /**
     * @return mixed
     */
    public function getNombreusuario()
    {
        return $this->nombreusuario;
    }

    /**
     * @param mixed $nombreusuario
     */
    public function setNombreusuario($nombreusuario)
    {
        $this->nombreusuario = $nombreusuario;
    }
    
}

