<?php
namespace Sise\Archivo;
use \Ghunti\HighchartsPHP\Highchart;
use \Ghunti\HighchartsPHP\HighchartJsExpr;

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
				
		$chart = new Highchart();

		$chart->chart->renderTo = "chart_horizontal_bars";
		$chart->chart->type = "bar";

		/*$chart->chart->backgroundColor->linearGradient = [0, 0, 500, 500];
        $chart->chart->backgroundColor->stops = [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                    ];
        $chart->chart->borderWidth = 2;
        $chart->chart->plotBackgroundColor = 'rgba(255, 255, 255, .9)';
        $chart->chart->plotShadow = true;
        $chart->chart->plotBorderWidth = 1;    */    
		
		$chart->title->text = '<b>'.$total.'</b> Ingresos en proceso de dictaminación correspondientes al año '.$anio;
		$chart->xAxis->title->text = '';
		$chart->xAxis->categories = array('En Revision con Analista', 'En analisis con Supervisor', 'VoBo de Supervisor', 'En Analisis de Direccion de Custodia', 'En Firma de Direccion General', 'Firmado y Entregado a Custodia');

		$chart->yAxis->title->text = "";

		$chart->credits->enabled = 0;
		$chart->legend->enabled = 0;

		$chart->plotOptions->borderWith=0;
		$chart->plotOptions->series->dataLabels->enabled=1;

		$chart->series = $listaSeries;
		
		$chart->exporting->enabled = 0;		

		return $chart;
	}
}