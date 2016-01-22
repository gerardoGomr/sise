<?php
namespace Sise\Servicios;

/**
 * Class ConversorHighcharts
 * @package Sise\Servicios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ConversorHighcharts
{
    /**
     * @var TipoConversor
     */
    protected $tipoConversor;

    /**
     * ConversorHighcharts constructor.
     * @param TipoConversor $tipoConversor
     */
    public function __construct(TipoConversor $tipoConversor)
    {
        $this->tipoConversor = $tipoConversor;
    }

    /**
     * @param TipoConversor $tipoConversor
     */
    public function setTipoConversor(TipoConversor $tipoConversor)
    {
        $this->tipoConversor = $tipoConversor;
    }

    /**
     * @param $listaDatos
     * @return mixed
     */
    public function convertir($listaDatos)
    {
        return $this->tipoConversor->convertir($listaDatos);
    }
}