<?php
namespace Sise\Graficas;

/**
 * Class ConversorEvaluadosProductividadPuntosHighcharts
 * @package Sise\Graficas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ConversorEvaluadosProductividadPuntosHighcharts extends ConversorPuntos
{
	/**
	 * convertir un array de datos y darle formato para highcharts
	 * @param array  $listaDatos
	 * @return array
	 */
	public function convertir($listaDatos)
	{
		$listaPuntos = array(
			array(
				'name' => 'Total de ingresos',
				'y'    => (int)$listaDatos['TotalEvaluaciones']
			),
			array(
				'name' => 'Total de evaluaciones con resultado integral',
				'y'    => (int)$listaDatos['TotalEvaluacionesResultado']
			),
			array(
				'name' => 'Expedientes en dirección Médica',
				'y'    => (int)$listaDatos['TotalEvaluacionesMedicos']
			),
			array(
					'name' => 'Expedientes en dirección de Psicología',
					'y'    => (int)$listaDatos['TotalEvaluacionesPsicologia']
			),
			array(
					'name' => 'Expedientes en dirección de Investigación Socioeconómica',
					'y'    => (int)$listaDatos['TotalEvaluacionesSocioeconomicos']
			),
			array(
					'name' => 'Expedientes en dirección de Poligrafía',
					'y'    => (int)$listaDatos['TotalEvaluacionesPoligrafia']
			)
		);

		$listaSeries[] = array('name' => 'Productividad', 'data' => $listaPuntos);

		$listaFinal['series']    = $listaSeries;

		return $listaFinal;
	}
}