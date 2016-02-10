<?php
namespace Sise\Dominio\Evaluaciones;

/**
 * Class SerialExpedientePoligrafia
 * @package Sise\Dominio\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class SerialExpedientePoligrafia extends Serial
{
    private $numeroEvalPol;

    public function __construct($serial)
    {
        parent::__construct($serial);
    }

    /**
     * descomponer el serial asignado en sus elementos
     */
    public function descomponer()
    {
        // TODO: Implement descomponer() method.
        if (strlen($this->serial) === 11) {
            $numeroEvalPol = (int)substr($this->serial, 9, 1);
            $area          = (int)substr($this->serial, 10, 1);

            $this->compuesto     = true;
            $this->serialBase    = substr($this->serial, 0, 9);
            $this->area          = $this->obtenerArea($area);
            $this->numeroEvalPol = $numeroEvalPol;
        } else {
            $this->compuesto  = false;
            $this->serialBase = $this->serial;
            $this->area       = null;
        }
    }

    public function getNumeroEvaluacionPoligrafica()
    {
        return $this->numeroEvalPol;
    }
}