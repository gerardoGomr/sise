<?php
namespace Sise\Archivo;


class ConversorReporteEnArchivoPuntosHighcharts extends  ConversorPuntos
{
	public function convertir($listaDatos)
	{
		$total=0;
		$anio=0;

		foreach ($listaDatos as $indice => $datoActual) {
			$total = (int)$listaDatos[$indice]['entregados_en_archivo'];
			$anio = (int)$listaDatos[$indice]['anio'];

			$listaEnArchivoDetalle  = array((int)$listaDatos[$indice]['en_archivo_completos_sin_analizar'],
				(int)$listaDatos[$indice]['en_archivo_completos_sin_analizar_diferenciados'],
				(int)$listaDatos[$indice]['en_archivo_entrego_un_area']);
		

		}

		$listaSeries[] = array('name' => 'Expedientes', 'data' => $listaEnArchivoDetalle);
		

		$listaFinal = array('chart' => array('renderTo' => 'dvGraficaEnArchivo', 'type'=> 'column'),	
							'title' => array('text' => 'Total  '.$anio.' :<b>'.$total.'</b>'),
							'xAxis' => array('title' => array('text' => '<b>Expedientes</b>'),'categories' => array('Completos sin analizar', 'Completos diferenciados sin analizar', 'Incompletos'), 'labels' =>array('margin'=>'2')),
							'legend' => array('enabled' => false),
							'credits' => array('enabled' => false),
							'yAxis' => array('title' => array('text' => '<b>Cantidad de evaluaciones</b>')),
							
							'plotOptions' => array('borderWith'=>0,'column' => array('dataLabels' => array('enabled'=> 'true'))),
							'series' => $listaSeries);
		
		return $listaFinal;
	}
}