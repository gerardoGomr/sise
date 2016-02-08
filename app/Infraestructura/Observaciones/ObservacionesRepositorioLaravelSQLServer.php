<?php
namespace Sise\Infraestructura\Observaciones;

use DB;
use Illuminate\Support\Collection;

/**
 * Class ObservacionesRepositorioLaravelSQLServer
 * @package Sise\Infraestructura\Observaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ObservacionesRepositorioLaravelSQLServer implements ObservacionesRepositorioInterface
{
    /**
     * @param int $anio
     * @return array
     */
    public function obtenerTotalDeObservacionesMensuales($anio)
    {
        $listaObservacionesMensuales = [];

        try {
            $observaciones = DB::connection('Integral')
                ->select('exec obtenerObservacionesMensualesGeneral ?', array($anio));

            $totalObservaciones = count($observaciones);

            if ($totalObservaciones > 0) {

                foreach ( $observaciones as $observaciones) {
                    $listaObservacionesMensuales[] = [
                        'Mes'                            => $observaciones->Mes,
                        'Total'                          => $observaciones->Total,
                        'TotalAnalisisDeficiente'        => $observaciones->TotalAnalisisDeficiente,
                        'TotalFaltoAgregarRecomendacion' => $observaciones->TotalFaltoAgregarRecomendacion,
                        'TotalMalaRedaccion'             => $observaciones->TotalMalaRedaccion,
                        'TotalMalaOrtografia'            => $observaciones->TotalMalaOrtografia,
                        'TotalNoRevisoAntecedentes'      => $observaciones->TotalNoRevisoAntecedentes,
                        'TotalNoRevisoReex'              => $observaciones->TotalNoRevisoReex
                    ];
                }

                return $listaObservacionesMensuales;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * @param array $parametos
     * @return array
     */
    public function obtenerTotalDeObservacionesPorAnalistas(array $parametos)
    {
        $listaObservacionesMensuales = [];

        try {
            $observaciones = DB::connection('Integral')
                ->select('exec obtenerObservacionesAnalistasDetalle ?, ?, ?, ?', array($parametos['anio'], $parametos['fecha1'], $parametos['fecha2'], $parametos['analista']));

            $totalObservaciones = count($observaciones);

            if ($totalObservaciones > 0) {

                foreach ( $observaciones as $observaciones) {
                    $listaObservacionesMensuales[] = [
                        'Nombre'                         => $observaciones->Nombre,
                        'Usuario'                        => $observaciones->Usuario,
                        'Total'                          => $observaciones->Total,
                        'TotalAnalisisDeficiente'        => $observaciones->TotalAnalisisDeficiente,
                        'TotalFaltoAgregarRecomendacion' => $observaciones->TotalFaltoAgregarRecomendacion,
                        'TotalMalaRedaccion'             => $observaciones->TotalMalaRedaccion,
                        'TotalMalaOrtografia'            => $observaciones->TotalMalaOrtografia,
                        'TotalNoRevisoAntecedentes'      => $observaciones->TotalNoRevisoAntecedentes,
                        'TotalNoRevisoReex'              => $observaciones->TotalNoRevisoReex
                    ];
                }

                return $listaObservacionesMensuales;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * @param int $anio
     * @return int
     */
    public function obtenerTotalDeObservaciones($anio)
    {
        try {

            $observaciones = DB::connection('Integral')
                ->table('observacion_supervision_usuario')
                ->select(DB::raw("COUNT(id) AS Total"))
                ->where(DB::raw("YEAR(FechaObservacion)"), $anio)
                ->first();

            $totalObservaciones = count($observaciones);

            if ($totalObservaciones > 0) {
                return $observaciones->Total;
            }

            return 0;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    /**
     * @param int $anio
     * @return string
     */
    public function obtenerObservacionMasRecurrente($anio)
    {
        try {

            $observaciones = DB::connection('Integral')
                ->table('observacion_supervision_usuario')
                ->join('observacion_supervision', 'observacion_supervision.idObservacion', '=', 'observacion_supervision_usuario.idObservacion')
                ->select(DB::raw("COUNT(observacion_supervision_usuario.idObservacion) AS Total"), 'observacion_supervision.Observacion')
                ->where(DB::raw("YEAR(observacion_supervision_usuario.FechaObservacion)"), $anio)
                ->groupBy('observacion_supervision.Observacion')
                ->havingRaw(("COUNT(observacion_supervision_usuario.idObservacion) = (SELECT MAX(y.Total) FROM (SELECT COUNT(idObservacion) AS Total FROM observacion_supervision_usuario WHERE YEAR(FechaObservacion) = ".$anio." GROUP BY idObservacion) AS y)"))
                ->first();

            $totalObservaciones = count($observaciones);

            if ($totalObservaciones > 0) {
                return (string)$observaciones->Observacion . ': ' . $observaciones->Total;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * @param array $parametos
     * @return array
     */
    public function obtenerTotalDeObservacionesDetallePorAnalistas(array $parametos)
    {
        $listaObservacionesDetalle = [];

        try {
            $observaciones = DB::connection('Integral')
                ->table('observacion_supervision')
                ->join('observacion_supervision_usuario', 'observacion_supervision.idObservacion', '=', 'observacion_supervision_usuario.idObservacion')
                ->join('observacion_texto_analisis', 'observacion_texto_analisis.idObservacionTexto', '=', 'observacion_supervision_usuario.idObservacionTexto')
                ->join('tUsuarios', 'tUsuarios.usuario', '=', 'observacion_supervision_usuario.Username')
                ->where('observacion_supervision_usuario.Username', $parametos['analista']);

            if (is_null($parametos['fecha1']) && is_null($parametos['fecha2'])) {
                $observaciones->where(DB::raw('YEAR(observacion_supervision_usuario.FechaObservacion)'), $parametos['anio']);
            } else {
                $observaciones->whereBetween('observacion_supervision_usuario.FechaObservacion', [$parametos['fecha1'], $parametos['fecha2']]);
            }

            $observaciones = $observaciones->get();

            $totalObservaciones = count($observaciones);

            if ($totalObservaciones > 0) {
                $listaObservacionesDetalle['Analista'] = $observaciones[0]->nombre;
                foreach ( $observaciones as $observaciones) {
                    $listaObservacionesDetalle['Detalle'][] = [
                        'FechaObservacion' => $observaciones->FechaObservacion,
                        'Observacion'      => $observaciones->Observacion,
                        'Texto'            => $observaciones->Texto
                    ];
                }

                return $listaObservacionesDetalle;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * @param  array $parametros
     * @return array
     */
    public function obtenerObservacionesConcentrado(array $parametros)
    {
        try {
            $observaciones = DB::connection('Integral')
                ->select('exec obtenerObservacionesReporteGeneral ?, ?, ?', array((int)$parametros['anio'], $parametros['fecha1'], $parametros['fecha2']));

            $totalObservaciones = count($observaciones);

            if ($totalObservaciones > 0) {
                foreach ( $observaciones as $observaciones) {
                    $listaObservacionesMensuales = [
                        'Total'                    => $observaciones->Total,
                        'ObservacionMasRecurrente' => $observaciones->ObservacionMasRecurrente,
                        'TotalMasRecurrente'       => $observaciones->TotalMasRecurrente
                    ];
                }

                $parametros['analista'] = '';
                $listaObservacionesMensuales['Analistas'] = $this->obtenerTotalDeObservacionesPorAnalistas($parametros);

                return $listaObservacionesMensuales;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}