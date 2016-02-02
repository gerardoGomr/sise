<?php
namespace Sise\Archivo;

use \Ghunti\HighchartsPHP\Highchart;
use \Ghunti\HighchartsPHP\HighchartJsExpr;

/**
* @author Guillermo Tinoco Ramos
*/
class ConversorIngresosPuntosHighcharts extends ConversorPuntos
{
	public function convertir($listaDatos)
	{
		$chart = new Highchart();

		foreach ($listaDatos as $indice => $datoActual) 
		{
			$listaTotal[] = array('name' => 'Total', 'y' => (int)$listaDatos[$indice]['expedientes_totales'], 'drilldown' => 'detalleTotal');
			
			$listaTotalDetalle[] = array('name' => 'Ingresos', 'y' =>(int)$listaDatos[$indice]['totales_concluyo'], 'drilldown' => 'detalleEvaluacion');
			$listaTotalDetalle[] = array('name' => 'No Concluidos', 'y' =>(int)$listaDatos[$indice]['totales_no_concluyo']);

			$listaEvaluacionDetalle[]  = array('name' => 'Entregados <br/>a Custodia', 'y' =>  (int)$listaDatos[$indice]['concluyo_entregados'], 'drilldown' => 'detalleEntregados');
			$listaEvaluacionDetalle[]  = array('name' =>'No entregados <br/>a Custodia', 'y' => (int)$listaDatos[$indice]['concluyo_no_entregados'], 'drilldown' => 'detalleNoEntregados');
			
			
			$listaNoEntregadosDetalle[]  = array('color'=> '#17F255','name' => 'Entrego <br/>Medico', 'y' =>(int)$listaDatos[$indice]['no_entregados_entrego_medico']);
			$listaNoEntregadosDetalle[]  = array('color'=> '#F2173F','name' => 'No Entrego <br/>Medico', 'y' =>(int)$listaDatos[$indice]['no_entregados_falto_medico']);			
			$listaNoEntregadosDetalle[]  = array('color'=> '#17F255','name' => 'Entrego <br/>Socio <br/>Economico', 'y' =>(int)$listaDatos[$indice]['no_entregados_entrego_socioeconomico']);			
			$listaNoEntregadosDetalle[]  = array('color'=> '#F2173F','name' => 'No Entrego <br/>Socio <br/>Economico', 'y' =>(int)$listaDatos[$indice]['no_entregados_falto_socioeconomico']);			
			$listaNoEntregadosDetalle[]  = array('color'=> '#17F255','name' => 'Entrego <br/>Psicologia', 'y' =>(int)$listaDatos[$indice]['no_entregados_entrego_psicologia']);			
			$listaNoEntregadosDetalle[]  = array('color'=> '#F2173F','name' => 'No Entrego <br/>Psicologia', 'y' =>(int)$listaDatos[$indice]['no_entregados_falto_psicologia']);			
			$listaNoEntregadosDetalle[]  = array('color'=> '#17F255','name' => 'Entrego <br/>Poligrafia', 'y' =>(int)$listaDatos[$indice]['no_entregados_entrego_poligrafia']);
			$listaNoEntregadosDetalle[]  = array('color'=> '#F2173F','name' => 'No Entrego <br/>Poligrafia', 'y' =>(int)$listaDatos[$indice]['no_entregados_falto_poligrafia']);


			$listaEntregadosDetalle[]  = array('name' =>'Evaluaciones Concluidas', 'y' => (int)$listaDatos[$indice]['entregados_concluidos']);
			$listaEntregadosDetalle[]  = array('name' =>'Evaluaciones en Proceso', 'y' => (int)$listaDatos[$indice]['entregados_en_proceso'], 'drilldown' => 'detalleEnProceso');
			$listaEntregadosDetalle[]  = array('name' =>'Evaluaciones en Archivo', 'y' => (int)$listaDatos[$indice]['entregados_en_archivo'], 'drilldown' => 'detalleEnArchivo');

			$listaEnProcesoDetalle[]  = array('name' =>'En Revision <br/>con Analista', 'y' => (int)$listaDatos[$indice]['en_proceso_estatus_uno']);
			$listaEnProcesoDetalle[]  = array('name' =>'En analisis <br/>con Supervisor', 'y' => (int)$listaDatos[$indice]['en_proceso_estatus_dos']);
			$listaEnProcesoDetalle[]  = array('name' =>'VoBo de <br/>Supervisor', 'y' => (int)$listaDatos[$indice]['en_proceso_estatus_tres']);
			$listaEnProcesoDetalle[]  = array('name' =>'En Analisis de <br/>Direccion de Custodia', 'y' => (int)$listaDatos[$indice]['en_proceso_estatus_cuatro']);
			$listaEnProcesoDetalle[]  = array('name' =>'En Firma de <br/>Direccion General', 'y' => (int)$listaDatos[$indice]['en_proceso_estatus_seis']);
			$listaEnProcesoDetalle[]  = array('name' =>'Firmado y Entregado <br/>a Custodia', 'y' => (int)$listaDatos[$indice]['en_proceso_estatus_siete']);
			
			$listaEnArchivoDetalle[]  = array('name' =>'Completos sin analizar', 'y' => (int)$listaDatos[$indice]['en_archivo_completos_sin_analizar']);
			$listaEnArchivoDetalle[]  = array('name' =>'Completos diferenciados sin analizar', 'y' => (int)$listaDatos[$indice]['en_archivo_completos_sin_analizar_diferenciados']);
			$listaEnArchivoDetalle[]  = array('name' =>'Incompletos', 'y' => (int)$listaDatos[$indice]['en_archivo_entrego_un_area']);

		}

		$listaSeries[] = array('name' => 'Expedientes', 'colorByPoint' => 'true', 'data' => $listaTotal);
		
		$listaDrilldown[] = array('id' => 'detalleTotal','name'=>'Expedientes', 'colorByPoint' => 'true', 'data' => $listaTotalDetalle);
		$listaDrilldown[] = array('id' => 'detalleEvaluacion','name'=>'Expedientes', 'colorByPoint' => 'true', 'data' => $listaEvaluacionDetalle);
		/*$listaDrilldown[] = array('id' => 'detalleNoEntregados','name'=>'Expedientes', 'colorByPoint' => 'true', 'data' => $listaNoEntregadosDetalle);*/
		$listaDrilldown[] = array('id' => 'detalleEvaluacion','name'=>'Expedientes', 'colorByPoint' => 'true', 'data' => $listaEntregadosDetalle);
		$listaDrilldown[] = array('id' => 'detalleEnProceso','name'=>'Expedientes', 'colorByPoint' => 'true', 'data' => $listaEnProcesoDetalle);
		$listaDrilldown[] = array('id' => 'detalleEnArchivo','name'=>'Expedientes', 'colorByPoint' => 'true', 'data' => $listaEnArchivoDetalle);
	
		$chart->chart->renderTo = "dvGraficaExpedientes";
		$chart->chart->type = "column";

		/*$chart->chart->backgroundColor->linearGradient = [0, 0, 500, 500];
        $chart->chart->backgroundColor->stops = [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                    ];
        $chart->chart->borderWidth = 2;
        $chart->chart->plotBackgroundColor = 'rgba(255, 255, 255, .9)';
        $chart->chart->plotShadow = true;
        $chart->chart->plotBorderWidth = 1; */       

		$chart->chart->events->drilldown  = new HighchartJsExpr(
		    "function(e) {
		    	tituloDrillUp.push($('.highcharts-title').text());
		    	chart.setTitle({ text: e.point.name });
		    }");

		$chart->chart->events->drillup  = new HighchartJsExpr(
		    "function(e) {		    	
		    	tituloDrillUpText = tituloDrillUp.pop();

		    	chart.setTitle({ text: tituloDrillUpText});
		    }");

		$chart->title->text = "Evaluaciones de Ingreso por año";
		$chart->subtitle->text = "Se omiten Portacion de Arma de Fuego, Otras Evaluaciones e Investigaciones Especiales";

		$chart->lang->drillUpText = "<< Regresar";

		//$chart->xAxis->title->text = '<b>Evaluaciones</b>';
		//$chart->xAxis->categories->text = 'Evaluaciones';
		$chart->xAxis->type = 'category';
		$chart->yAxis->title->text = "<b>Cantidad</b>";

		$chart->credits->enabled = 0;
		$chart->legend->enabled = 0;

		$chart->plotOptions->borderWith=0;
		$chart->plotOptions->series->dataLabels->enabled=1;

		$chart->series = $listaSeries;

		$chart->drilldown->series = $listaDrilldown;

		$chart->drilldown->drillUpButton->relativeTo = 'spacingBox';
		$chart->exporting->enabled = 0;

		return $chart;
	}
}