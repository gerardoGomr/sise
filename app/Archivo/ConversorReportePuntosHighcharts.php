<?php
namespace Sise\Archivo;

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
				

		$listaFinal = array('chart' => array('renderTo' => 'dvGrafica', 'type'=> 'column'),	
							'title' => array('text' => 'Total del año '.$anio.' :<b>'.$total.'</b>'),
							'xAxis' => array('categories' => array('Medico', 'Psicologia', 'Socioeconomico', 'Poligrafia'), 'labels' =>array('margin'=>'2')),
							'legend' => array('enabled' => true),
							'credits' => array('enabled' => false),
							'yAxis' => array('title' => array('text' => '<b>Cantidad de evaluaciones</b>', 'stackLabels'=>array('enabled'=>true))),
							
							'plotOptions' => array('borderWith'=>0,'column' => array('stacking'=>'normal','dataLabels' => array('enabled'=> 'true'))),
							'series' => $listaSeries);
		
		return $listaFinal;
	}
}