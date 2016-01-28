<?php
namespace Sise\Infraestructura\Evaluaciones;

use Sise\Dominio\Evaluaciones\Elemento;
use Sise\Dominio\Evaluaciones\Evaluacion;
use Sise\Dominio\Evaluaciones\Serial;
use DB;

/**
 * Interface EvaluacionesRepositorioInterface
 * @package Sise\Infraestructura\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class EvaluacionesRepositorioLaravelSQLServer implements EvaluacionesRepositorioInterface
{
    /**
     * obtener una evaluacion por el numero serial proporcionado
     * @param Serial $serial
     * @return mixed
     */
    public function obtenerEvaluacionPorSerial(Serial $serial)
    {
        try {
            $evaluaciones = DB::table('tElementosint')
                ->join('tHistorico', 'tHistorico.curp', '=', 'tElementosint.curp')
                ->where('tHistorico.SerialElement', $serial->getSerialBase())
                ->first();

            $totalEvaluaciones = count($evaluaciones);

            if ($totalEvaluaciones > 0) {
                $evaluacion = new Evaluacion($evaluaciones->idhistorico);
                $evaluacion->setElemento(new Elemento($evaluaciones->nombre, $evaluaciones->paterno, $evaluaciones->materno, $evaluaciones->curp, $evaluaciones->rfc));
                $evaluacion->setNumeroEvaluacion($evaluaciones->idevaluacion);

                return $evaluacion;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}