<?php
namespace Sise\Infraestructura\Evaluaciones;

use Sise\Dominio\Evaluaciones\Elemento;
use Sise\Dominio\Evaluaciones\Evaluacion;
use Sise\Dominio\Evaluaciones\EvaluacionPoligrafia;
use Sise\Dominio\Evaluaciones\MemoEntrega;
use Sise\Dominio\Evaluaciones\Serial;
use DB;

/**
 * Class MemosRepositorioInterface
 * @package Sise\Infraestructura\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class MemosRepositorioLaravelSQLServer implements MemosRepositorioInterface
{
    public function obtenerMemoPorSerial(Serial $serial)
    {
        try {
            $memos = DB::table('pEntregaexp')
                ->join('tHistorico', function($join){
                    $join->on('tHistorico.curp', '=', 'pEntregaexp.curp')
                        ->on('tHistorico.idevaluacion', '=', 'pEntregaexp.idevaluacion');
                })
                ->join('tElementosint', 'tElementosint.curp', '=', 'tHistorico.curp')
                ->where('pEntregaexp.cmemo', $serial->getSerialBase())
                ->orderBy('pEntregaexp.curp')
                ->get();

            $totalEvaluaciones = count($memos);

            if ($totalEvaluaciones > 0) {
                $memoEntrega = new MemoEntrega($memos[0]->cmemo);
                $memoEntrega->setSerial($serial);

                foreach ($memos as $memos) {

                    is_null($memos->fidtox) ? $entrega = false : $entrega = true;
                    $evaluacion = new Evaluacion($memos->idhistorico);
                    $evaluacion->setElemento(new Elemento($memos->nombre, $memos->paterno, $memos->materno, $memos->curp, $memos->rfc));
                    $evaluacion->setNumeroEvaluacion($memos->idevaluacion);
                    $evaluacion->setSerial($serial);
                    $evaluacion->setEntregaMedicoToxicologica($entrega);

                    $this->obtenerEvaluacionesPoligraficasdeEvaluacion($evaluacion);

                    $memoEntrega->agregarEvaluacion($evaluacion);
                }

                return $memoEntrega;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    private function obtenerEvaluacionesPoligraficasdeEvaluacion(Evaluacion $evaluacion)
    {
        try {
            $evalPoli = DB::table('tHistoricoPol')
                ->where('idevaluacion', $evaluacion->getNumeroEvaluacion())
                ->where('curp', $evaluacion->getElemento()->getCurp())
                ->get();

            $totalPoli = count($evalPoli);

            if ($totalPoli > 0) {

                foreach ($evalPoli as $evalPoli) {
                    $evaluacionPoligrafica = new EvaluacionPoligrafia($evalPoli->idevalpol, $evalPoli->idpol, $evalPoli->fidPolCust);
                    $evaluacion->getListaEvalucionesPoligrafia()->push($evaluacionPoligrafica);
                }
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}