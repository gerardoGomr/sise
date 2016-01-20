<?php
namespace Sise\Graficas;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class ConversorProgramadosPuntosHighcharts extends ConversorPuntos
{
	/**
	 * convertir una lista de programados mensualmente, especificando el drilldown de detalle
	 * @param  array $listaDatos
	 * @return array
	 */
	public function convertir($listaDatos)
	{
		$listaFinal        = array();
		$listaSeries       = array();
		$listaProgramados  = array();
		$listaPrioridadUno = array();
		$listaSubsecuentes = array();
		$listaXAxis		   = array();
		$listaDrilldown    = array();
		$totalProgramados  = 0;
		$totalPrioridadUno = 0;
		$totalSubsecuentes = 0;

		foreach ($listaDatos as $indice => $datoActual) {
			// se generan los puntos X e Y: array(x, y)
			$listaProgramados[]  = array(
				'name'      => $listaDatos[$indice]['Periodo'],
				'y'         => (int)$listaDatos[$indice]['Programados'],
				'drilldown' => 'drilldown'.$indice
			);

			// total programados
			$totalProgramados += (int)$listaDatos[$indice]['Programados'];

			$listaPrioridadUno[] = array($listaDatos[$indice]['Periodo'], (int)$listaDatos[$indice]['PrioridadUno']);
			$listaSubsecuentes[] = array($listaDatos[$indice]['Periodo'], (int)$listaDatos[$indice]['Subsecuentes']);

			$totalPrioridadUno += (int)$listaDatos[$indice]['PrioridadUno'];
			$totalSubsecuentes += (int)$listaDatos[$indice]['Subsecuentes'];

			// se genera la lista de drilldown
			$listaDrilldown[]    = array(
				'id'                  => 'drilldown'.$indice,
				'name'				  => $listaDatos[$indice]['Periodo'],
				'type'                => 'column',
				'data'                => array(
					array(
						'name'  => 'Programados',
						'y'     => (int)$listaDatos[$indice]['Programados'],
						'color' => '#17F255'
					),
					array(
						'name'  => 'Prioridad uno',
						'y'     => (int)$listaDatos[$indice]['PrioridadUno'],
						'color' => '#F2173F'
					)
					,
					array(
						'name'  => 'Subsecuentes',
						'y'     => (int)$listaDatos[$indice]['Subsecuentes'],
						'color' => '#F2173F'
					)
				)
			);
		}

		// se generan las series, configurando el tipo de grafica, el nombre y los datos de las series
		$listaSeries[] = array('type' => 'area', 'name' => 'Programados (' .$totalProgramados. ')', 'data' => $listaProgramados);
		$listaSeries[] = array('type' => 'column', 'name' => 'Prioridad uno (' .$totalPrioridadUno. ')', 'data' => $listaPrioridadUno);
		$listaSeries[] = array('type' => 'column', 'name' => 'Subsecuentes (' .$totalSubsecuentes. ')', 'data' => $listaSubsecuentes);

		// se genera el arreglo final de repuesta, generando las series y los drilldown
		$listaFinal['series']    = $listaSeries;
		$listaFinal['drilldown'] = array(
			'drillUpButton' => array(
				'relativeTo'=> 'spacingBox'
			),
			'series'        => $listaDrilldown
		);

		return $listaFinal;
	}

	public function generarDrilldown($value='')
	{
		# code...
	}
}