<?php
namespace Sise\Infraestructura\Evaluaciones;

use Illuminate\Support\Collection;
use Sise\Dominio\Evaluaciones\Elemento;
use Sise\Dominio\Evaluaciones\Evaluacion;
use Sise\Dominio\Evaluaciones\EvaluacionPoligrafia;
use Sise\Dominio\Evaluaciones\Serial;
use DB;
use Sise\Dominio\Usuarios\Trabajador;
use Sise\Dominio\Usuarios\UsuarioSise;

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
                $evaluacion->setSerial($serial);

                $this->obtenerEvaluacionesPoligraficasdeEvaluacion($evaluacion);

                return $evaluacion;
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

                    if (is_null($evaluacion->getListaEvalucionesPoligrafia())) {
                        $evaluacion->setListaEvalucionesPoligrafia(new Collection());
                    }
                    $evaluacion->getListaEvalucionesPoligrafia()->push($evaluacionPoligrafica);
                }
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * marcar entrega de una lista de evaluaciones
     * @param Collection $listaEvaluaciones
     * @return mixed
     */
    public function marcarEntrega(Collection $listaEvaluaciones)
    {
        try {

            foreach ( $listaEvaluaciones as $evaluacion ) {
                //$operacion = DB::select('exec EntregaCustodia_final ?, ?, ?', [$evaluacion->getNumeroEvaluacion(), $evaluacion->getElemento()->getCurp(), $evaluacion->getSerial()->getArea()->getId()]);
                switch ($evaluacion->getSerial()->getArea()->getId()) {
                    case 5:
                        $operacion = DB::table('tHistorico')
                            ->where('idhistorico', $evaluacion->getId())
                            ->update([
                                'fidtox' => date('Y-m-d H:m:i')
                            ]);
                        break;
                }
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}