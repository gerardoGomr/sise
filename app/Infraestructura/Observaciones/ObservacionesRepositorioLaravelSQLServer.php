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
        
    }
}