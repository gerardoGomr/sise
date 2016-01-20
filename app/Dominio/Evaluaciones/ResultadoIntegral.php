<?php
namespace Sise\Dominio\Evaluaciones;

/**
 * Class ResultadoIntegral
 * @author  Gerardo Adrián Gómez Ruiz
 * @package Sise\Evaluaciones
 */
class ResultadoIntegral
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $resultadoIntegral;

    public function __construct($id = null, $resultadoIntegral = null)
    {
        $this->id                = $id;
        $this->resultadoIntegral = $resultadoIntegral;
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
    public function getResultadoIntegral()
    {
        return $this->resultadoIntegral;
    }

    /**
     * @param string $resultadoIntegral
     */
    public function setResultadoIntegral($resultadoIntegral)
    {
        $this->resultadoIntegral = $resultadoIntegral;
    }
}