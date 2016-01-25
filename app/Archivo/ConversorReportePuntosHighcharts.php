<?php
namespace Sise\Archivo;

use \Ghunti\HighchartsPHP\Highchart;
use \Ghunti\HighchartsPHP\HighchartJsExpr;

class ConversorReportePuntosHighcharts extends  ConversorPuntos
{
	public function convertir($listaDatos)
	{
		$total=0;
		$anio=0;

		foreach ($listaDatos as $indice => $datoActual) {
			$total = (int)$listaDatos[$indice]['concluyo_no_entregados'];
			$anio = (int)$listaDatos[$indice]['anio'];

			$listaNoEntregadosDetalle  = array((int)$listaDatos[$indice]['no_entregados_entrego_medico'],
				(int)$listaDatos[$indice]['no_entregados_entrego_psicologia'],
				(int)$listaDatos[$indice]['no_entregados_entrego_socioeconomico'],
				(int)$listaDatos[$indice]['no_entregados_entrego_poligrafia']
				);
			$listaEntregadosDetalle  = array((int)$listaDatos[$indice]['no_entregados_falto_medico'],
				(int)$listaDatos[$indice]['no_entregados_falto_psicologia'],
				(int)$listaDatos[$indice]['no_entregados_falto_socioeconomico'],
				(int)$listaDatos[$indice]['no_entregados_falto_poligrafia']);			

		}

		$listaSeries[] = array('color'=> '#17F255', 'name' => 'Entrego', 'data' => $listaNoEntregadosDetalle);
		$listaSeries[] = array('color'=> '#F2173F', 'name' => 'No Entrego', 'data' => $listaEntregadosDetalle);			

		$chart = new Highchart();

		$chart->chart->renderTo = "dvGrafica";
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
		$chart->xAxis->categories =  array('Medico', 'Psicologia', 'Socioeconomico', 'Poligrafia');

		$chart->yAxis->title->text = "<b>Cantidad de evaluaciones</b>";
		$chart->yAxis->title->stackLabels->enabled = true;

		$chart->credits->enabled = 0;
		$chart->legend->enabled = 0;

		$chart->plotOptions->borderWith=0;
		$chart->plotOptions->series->dataLabels->enabled=1;

		$chart->series = $listaSeries;
		
		$chart->exporting->enabled = 0;		

		return $chart;
	}
}