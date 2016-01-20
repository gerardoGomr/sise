<?php
namespace Sise\Archivo;

class ConversorReporteEnProcesoPuntosHighcharts extends  ConversorPuntos
{
	public function convertir($listaDatos)
	{
		$total=0;
		$anio=0;

		foreach ($listaDatos as $indice => $datoActual) {
			$total = (int)$listaDatos[$indice]['entregados_en_proceso'];
			$anio = (int)$listaDatos[$indice]['anio'];

			$listaEnProcesoDetalle = array((int)$listaDatos[$indice]['en_proceso_estatus_uno'],(int)$listaDatos[$indice]['en_proceso_estatus_dos'],(int)$listaDatos[$indice]['en_proceso_estatus_tres'],(int)$listaDatos[$indice]['en_proceso_estatus_cuatro'], (int)$listaDatos[$indice]['en_proceso_estatus_seis'], (int)$listaDatos[$indice]['en_proceso_estatus_siete']);
			
		

		}

		$listaSeries[] = array('name' => 'Expedientes', 'data' => $listaEnProcesoDetalle);
		

		$listaFinal = array('chart' => array('renderTo' => 'dvGraficaEnProceso', 'type'=> 'column'),	
							'title' => array('text' => 'Total  '.$anio.' :<b>'.$total.'</b>'),
							'xAxis' => array('title' => array('text' => '<b>Expedientes</b>'),'categories' => array('En Revision <br/>con Analista', 'En analisis <br/>con Supervisor', 'VoBo de <br/>Supervisor', 'En Analisis de <br/>Direccion de Custodia', 'En Firma de <br/>Direccion General', 'Firmado y Entregado <br/>a Custodia'), 'labels' =>array('margin'=>'2')),
							'legend' => array('enabled' => false),
							'credits' => array('enabled' => false),
							'yAxis' => array('title' => array('text' => '<b>Cantidad de evaluaciones</b>')),
							
							'plotOptions' => array('borderWith'=>0,'column' => array('dataLabels' => array('enabled'=> 'true'))),
							'series' => $listaSeries);
		
		return $listaFinal;
	}
}