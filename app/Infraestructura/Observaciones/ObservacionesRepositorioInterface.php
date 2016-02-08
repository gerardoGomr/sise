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

    /**
     * @param int $anio
     * @return int
     */
    public function obtenerTotalDeObservaciones($anio);

    /**
     * @param int $anio
     * @return string
     */
    public function obtenerObservacionMasRecurrente($anio);

    /**
     * @param array $parametos
     * @return array
     */
    public function obtenerTotalDeObservacionesDetallePorAnalistas(array $parametos);

    /**
     * @param  array $parametros
     * @return array
     */
    public function obtenerObservacionesConcentrado(array $parametros);
}