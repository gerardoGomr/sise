<?php
namespace Sise\Infraestructura\Evaluaciones;

use Sise\Dominio\Evaluaciones\Serial;

/**
 * Interface EvaluacionesRepositorioInterface
 * @package Sise\Infraestructura\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface EvaluacionesRepositorioInterface
{
    /**
     * obtener una evaluacion por el numero serial proporcionado
     * @param Serial $serial
     * @return mixed
     */
    public function obtenerEvaluacionPorSerial(Serial $serial);
}