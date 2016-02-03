<?php
namespace Sise\Dominio\Evaluaciones;

/**
 * Class SerialMemo
 * @package Sise\Dominio\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class SerialMemo extends Serial
{
    public function __construct($serial)
    {
        parent::__construct($serial);
    }

    public function descomponer()
    {
        // TODO: Implement descomponer() method.
        $longitud         = strlen($this->serial);
        $area             = (int)substr($this->serial, ($longitud - 1), 1);
        $this->compuesto  = true;
        $this->serialBase = substr($this->serial, 0, ($longitud - 1));
        $this->area       = $this->obtenerArea($area);
    }
}