<?php
namespace Sise\Dominio\Evaluaciones;


use Sise\Dominio\Usuarios\Trabajador;

class EvaluacionPoligrafia
{
    /**
     * @var int
     */
    private $numeroEvaluacion;

    /**
     * @var Usuario
     */
    private $evaluador;

    /**
     * @var string
     */
    private $fechaEntregaArchivo;

    /**
     * EvaluacionPoligrafia constructor.
     * @param int $numeroEvaluacion
     * @param Trabajador $evaluador
     * @param string $fechaEntregaArchivo
     */
    public function __construct($numeroEvaluacion = null, Trabajador $evaluador = null, $fechaEntregaArchivo = null)
    {
        $this->numeroEvaluacion    = $numeroEvaluacion;
        $this->evaluador           = $evaluador;
        $this->fechaEntregaArchivo = $fechaEntregaArchivo;
    }


    /**
     * @return int
     */
    public function getNumeroEvaluacion()
    {
        return $this->numeroEvaluacion;
    }

    /**
     * @param int $numeroEvaluacion
     */
    public function setNumeroEvaluacion($numeroEvaluacion)
    {
        $this->numeroEvaluacion = $numeroEvaluacion;
    }

    /**
     * @return Usuario
     */
    public function getEvaluador()
    {
        return $this->evaluador;
    }

    /**
     * @param Trabajador $evaluador
     */
    public function setEvaluador(Trabajador $evaluador)
    {
        $this->evaluador = $evaluador;
    }

    /**
     * @return string
     */
    public function getFechaEntregaArchivo()
    {
        return $this->fechaEntregaArchivo;
    }

    /**
     * @param string $fechaEntregaArchivo
     */
    public function setFechaEntregaArchivo($fechaEntregaArchivo)
    {
        $this->fechaEntregaArchivo = $fechaEntregaArchivo;
    }
}