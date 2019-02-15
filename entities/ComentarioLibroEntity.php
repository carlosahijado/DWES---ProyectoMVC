<?php
namespace entities;

class ComentarioLibroEntity
{
    private $idlibro;
    private $idcomentario;
    private $contenido;
    private $idusuario;
    private $nombreusuario;
    public function __construct($contenido, $nombreusuario="", $idcomentario = 0, $idusuario = 0, $idlibro=0)
    {
        $this->contenido=$contenido;
        $this->idcomentario=$idcomentario;
        $this->idusuario=$idusuario;
        $this->idlibro=$idlibro;
        $this->nombreusuario=$nombreusuario;
    }
    /**
     * @return number
     */
    public function getIdlibro()
    {
        return $this->idlibro;
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
     * @param number $idlibro
     */
    public function setIdlibro($idlibro)
    {
        $this->idlibro = $idlibro;
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
     * @return string
     */
    public function getNombreusuario()
    {
        return $this->nombreusuario;
    }

    /**
     * @param string $nombreusuario
     */
    public function setNombreusuario($nombreusuario)
    {
        $this->nombreusuario = $nombreusuario;
    }
}

