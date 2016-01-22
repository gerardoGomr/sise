<?php
namespace Sise\Infraestructura\Observaciones;

/**
 * Interface ObservacionesRepositorioInterface
 * @package Sise\Infraestructura\Observaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface ObservacionesRepositorioInterface
{
    /**
     * @param int $anio
     * @return array
     */
    public function obtenerTotalDeObservacionesMensuales($anio);

    /**
     * @param array $parametos
     * @return array
     */
    public function obtenerTotalDeObservacionesPorAnalistas(array $parametos);
}