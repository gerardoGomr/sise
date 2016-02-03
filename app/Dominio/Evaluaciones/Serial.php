<?php
namespace Sise\Dominio\Evaluaciones;

/**
 * Class Serial
 * @package Sise\Dominio\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
abstract class Serial
{
    /**
     * @var string
     */
    protected $serial;

    /**
     * @var string
     */
    protected $serialBase;

    /**
     * @var Area
     */
    protected $area;

    /**
     * @var bool
     */
    protected $compuesto;

    /**
     * Serial constructor.
     * @param string $serial
     */
    public function __construct($serial) {
        $this->serial = $serial;
        $this->descomponer();
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
     * @return boolean
     */
    public function compuesto()
    {
        return $this->compuesto;
    }

    /**
     * @param boolean $compuesto
     */
    public function setCompuesto($compuesto)
    {
        $this->compuesto = $compuesto;
    }

    /**
     * @return Area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param Area $area
     */
    public function setArea(Area $area)
    {
        $this->area = $area;
    }

    /**
     * @return string
     */
    public function getSerialBase()
    {
        return $this->serialBase;
    }

    /**
     * @param string $serialBase
     */
    public function setSerialBase($serialBase)
    {
        $this->serialBase = $serialBase;
    }



    /**
     * genera la representacion del serial en código de barras
     */
    public function generarCodigoBarras()
    {

    }

    /**
     * descomponer el serial en sus componentes
     */
    abstract public function descomponer();

    /**
     * @param int $numero
     * @return Area
     */
    protected function obtenerArea($numero)
    {
        $nombre = '';
        switch ($numero) {
            case 1:
                $nombre = 'Dirección de registro y cadena de custodia';
                break;

            case 2:
                $nombre = 'Dirección de investigación socioeconómica';
                break;

            case 3:
                $nombre = 'Dirección de psicología';
                break;

            case 4:
                $nombre = 'Dirección de poligrafía';
                break;

            case 5:
                $nombre = 'Dirección médica toxicológica';
                break;
        }

        return new Area($numero, $nombre);
    }
}