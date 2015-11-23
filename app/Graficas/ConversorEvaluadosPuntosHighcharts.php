<?php
namespace Sise\Graficas;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class ConversorEvaluadosPuntosHighcharts extends ConversorPuntos
{
	public function convertir($listaDatos)
	{
		$listaFinal        = array();
		$listaEvaluaciones = array();
		foreach ($listaDatos as $indice => $datoActual) {
			$listaEvaluaciones[]  = array($listaDatos[$indice]['Periodo'], (int)$listaDatos[$indice]['TotalEvaluaciones']);
		}

		$listaFinal[] = array('name' => 'Evaluaciones', 'data' => $listaEvaluaciones);

		return $listaFinal;
	}
}