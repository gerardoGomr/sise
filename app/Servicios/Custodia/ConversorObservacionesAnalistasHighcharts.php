<?php
namespace Sise\Servicios\Custodia;
use Sise\Servicios\TipoConversor;

/**
 * Class ConversorObservacionesAnalistasHighcharts
 * @package Sise\Servicios\Custodia
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ConversorObservacionesAnalistasHighcharts implements TipoConversor
{
    /**
     * convertir un arreglo en otro con cierto formato
     * @param array $lista
     * @return mixed
     */
    public function convertir($lista)
    {
        $listaPuntos = $listaDrilldown = $listaFinal = array();

        foreach ($lista as $indice => $datoActual) {

            $listaPuntos[] = array(
                'name'      => $lista[$indice]['Nombre'],
                'y'         => (int) $lista[$indice]['Total'],
                'drilldown' => 'drilldown' . (string)$indice
            );

            $listaDrilldown[] = array(
                'id'                  => 'drilldown'.$indice,
                'name'				  => $lista[$indice]['Nombre'],
                'type'                => 'column',
                'data'                => array(
                    array(
                        'name'  => 'Análisis deficiente',
                        'y'     => (int) $lista[$indice]['TotalAnalisisDeficiente'],
                        'color' => '#7CFFA1'
                    ),
                    array(
                        'name'  => 'Faltó agregar recomendación',
                        'y'     => (int) $lista[$indice]['TotalFaltoAgregarRecomendacion'],
                        'color' => '#FF6682'
                    ),
                    array(
                        'name'  => 'Mala redacción',
                        'y'     => (int) $lista[$indice]['TotalMalaRedaccion'],
                        'color' => '#D396A1'
                    ),
                    array(
                        'name' => 'Mala ortografía',
                        'y'    => (int) $lista[$indice]['TotalMalaOrtografia'],
                        'color' => '#4D74E9'
                    ),
                    array(
                        'name' => 'No revisó antecedentes',
                        'y'    => (int) $lista[$indice]['TotalNoRevisoAntecedentes'],
                        'color' => '#7EF0EB'
                    ),
                    array(
                        'name' => 'No revisó reexaminación poligráfica',
                        'y'    => (int) $lista[$indice]['TotalNoRevisoReex'],
                        'color' => '#E3F07E'
                    )
                )
            );

            // se generan las series, configurando el tipo de grafica, el nombre y los datos de las series
            //$listaSeries[] = array('name' => '', 'data' => $listaPuntos);
        }

        // se genera el arreglo final de repuesta, generando las series y los drilldown
        $listaFinal['series']    = array(array('name' => 'Analistas', 'data' => $listaPuntos));
        $listaFinal['drilldown'] = array(
            'drillUpButton' => array(
                'relativeTo'=> 'spacingBox'
            ),
            'series'        => $listaDrilldown
        );

        return $listaFinal;
    }
}