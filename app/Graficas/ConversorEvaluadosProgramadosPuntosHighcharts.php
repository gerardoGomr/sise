<?php
namespace Sise\Graficas;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class ConversorEvaluadosProgramadosPuntosHighcharts extends ConversorPuntos
{
	public function convertir($listaDatos)
	{
		$listaFinal        = array();
		$listaEvaluaciones = array();
		$totalProgramados  = 0;
		$totalEvaluaciones = 0;

		foreach ($listaDatos['Evaluaciones'] as $indice => $datoActual) {
			$listaEvaluaciones[]  = array($listaDatos['Evaluaciones'][$indice]['Periodo'], (int)$listaDatos['Evaluaciones'][$indice]['TotalEvaluaciones']);

			$totalEvaluaciones += (int)$listaDatos['Evaluaciones'][$indice]['TotalEvaluaciones'];
		}

		foreach ($listaDatos['Programados'] as $indice => $valor) {
			// se generan los puntos X e Y: array(x, y)
			$listaProgramados[]  = array(
				'name'      => $listaDatos['Programados'][$indice]['Periodo'],
				'y'         => (int)$listaDatos['Programados'][$indice]['Programados']
			);

			$totalProgramados += (int)$listaDatos['Programados'][$indice]['Programados'];
		}

		$listaFinal[] = array('name' => 'Evaluaciones (' . $totalEvaluaciones . ')', 'data' => $listaEvaluaciones);
		$listaFinal[] = array('name' => 'Programados ('. $totalProgramados .')', 'data' => $listaProgramados);

		return $listaFinal;
	}
}