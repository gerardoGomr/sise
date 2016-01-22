<?php
namespace Sise\Dominio\Evaluaciones;

/**
 * Class Serial
 * @package Sise\Dominio\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Serial
{
    /**
     * @var string
     */
    protected $serial;

    /**
     * Serial constructor.
     * @param string $serial
     */
    public function __construct($serial) {
        $this->serial = $serial;
    }

    /**
     * @return string
     */
    public function getSerial() {
        return $this->serial;
    }

    /**
     * @param string $serial
     */
    public function setSerial($serial) {
        $this->serial = $serial;
    }

    /**
     * genera la representacion del serial en código de barras
     */
    public function generarCodigoBarras()
    {

    }
}