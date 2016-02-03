<?php
namespace Sise\Dominio\Evaluaciones;

/**
 * Class Area
 * @package Sise\Dominio\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Area
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * Area constructor.
     * @param int $id
     * @param string $nombre
     */
    public function __construct($id = null, $nombre = null)
    {
        $this->id     = $id;
        $this->nombre = $nombre;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}