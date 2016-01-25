<?php
namespace Sise\Archivo;

use \Ghunti\HighchartsPHP\Highchart;
use \Ghunti\HighchartsPHP\HighchartJsExpr;

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
	
		$chart = new Highchart();

		$chart->chart->renderTo = "dvGraficaEnArchivo";
		$chart->chart->type = "column";

		$chart->chart->backgroundColor->linearGradient = [0, 0, 500, 500];
        $chart->chart->backgroundColor->stops = [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                    ];
        $chart->chart->borderWidth = 2;
        $chart->chart->plotBackgroundColor = 'rgba(255, 255, 255, .9)';
        $chart->chart->plotShadow = true;
        $chart->chart->plotBorderWidth = 1;        
		
		$chart->title->text = 'Total  '.$anio.' :<b>'.$total.'</b>';
		$chart->xAxis->title->text = '<b>Expedientes</b>';
		$chart->xAxis->categories = array('Completos sin analizar', 'Completos diferenciados sin analizar', 'Incompletos');

		$chart->yAxis->title->text = "<b>Cantidad de evaluaciones</b>";

		$chart->credits->enabled = 0;
		$chart->legend->enabled = 0;

		$chart->plotOptions->borderWith=0;
		$chart->plotOptions->series->dataLabels->enabled=1;

		$chart->series = $listaSeries;
		
		$chart->exporting->enabled = 0;		

		return $chart;
	}
}