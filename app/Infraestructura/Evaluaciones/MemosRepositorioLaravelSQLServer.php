<?php
namespace Sise\Infraestructura\Evaluaciones;

use Illuminate\Support\Collection;
use Sise\Dominio\Evaluaciones\ArchivoEstatus;
use Sise\Dominio\Evaluaciones\Elemento;
use Sise\Dominio\Evaluaciones\Evaluacion;
use Sise\Dominio\Evaluaciones\EvaluacionPoligrafia;
use Sise\Dominio\Evaluaciones\MemoEntrega;
use Sise\Dominio\Evaluaciones\Serial;
use DB;
use Sise\Dominio\Evaluaciones\SerialExpediente;
use Sise\Dominio\Usuarios\Trabajador;
use Sise\Dominio\Usuarios\UsuarioSise;

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
                ->orderBy('tHistorico.SerialElement')
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
                    $evaluacion->setDiferenciada($memos->evaldiferenciada);
                    $evaluacion->setSerial(new SerialExpediente($memos->SerialElement . $memoEntrega->getSerial()->getArea()->getId()));
                    $evaluacion->setEntregaMedicoToxicologica($entrega);

                    $this->obtenerEvaluacionesPoligraficasdeEvaluacion($evaluacion);

                    $evaluacion->verificarEntregaDePoligrafia();

                    if (is_null($memos->idArchivoEstatus)) {
                        // en integración
                        $evaluacion->setArchivoEstatus(new ArchivoEstatus(1));
                    }

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
                    $usuario = new Trabajador();
                    $usuario->setUsuario(new UsuarioSise());
                    $usuario->getUsuario()->setUsername($evalPoli->idpol);

                    $evaluacionPoligrafica = new EvaluacionPoligrafia($evalPoli->idevalpol, $usuario, $evalPoli->fidPolCust);
                    $evaluacionPoligrafica->setFechaEntregaArchivo($evalPoli->fEntCus);

                    if (is_null($evaluacion->getListaEvalucionesPoligrafia())) {
                        $evaluacion->setListaEvalucionesPoligrafia(new Collection());
                    }

                    $evaluacionPoligrafica->setEntregada(true);
                    if (is_null($evalPoli->fEntCus)) {
                        $evaluacionPoligrafica->setEntregada(false);
                    }

                    $evaluacion->getListaEvalucionesPoligrafia()->push($evaluacionPoligrafica);
                }
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}