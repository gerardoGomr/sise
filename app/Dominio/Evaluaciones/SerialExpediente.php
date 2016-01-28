<?php
/**
 * Created by PhpStorm.
 * User: Rafaelc
 * Date: 28/01/2016
 * Time: 14:05
 */

namespace Sise\Dominio\Evaluaciones;


class SerialExpediente extends Serial
{
    public function descomponer()
    {
        // TODO: Implement descomponer() method.
        if (strlen($this->serial) === 10) {
            $area = (int)substr($this->serial, 9, 1);

            $this->compuesto  = true;
            $this->serialBase = substr($this->serial, 0, 9);
            $this->area       = $this->obtenerArea($area);
        } else {
            $this->compuesto  = false;
            $this->serialBase = $this->serial;
            $this->area       = null;
        }
    }
}