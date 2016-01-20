<?php
namespace Sise\Archivo;

use DB;

class ReportesRepositorioLaravelSQLServer implements ReportesRepositorioInterface{

	public function obtenerDatosIngresos($anio){
		$resultado = array();
		$resultados = array();

		try{
			$results = DB::select("exec DASH_ExpedientesFaltantesPorEntregarEnCustodia ?", array($anio));

			$totalExpedienteCustodia = count($results);


			if($totalExpedienteCustodia > 0) {
				foreach ($results as $results) {
					
					$resultado['expedientes_totales']  = $results->expedientes_totales;
					$resultado['totales_concluyo']  = $results->totales_concluyo;
					$resultado['totales_no_concluyo']  = $results->totales_no_concluyo;
					$resultado['concluyo_entregados']  = $results->concluyo_entregados;					
					$resultado['concluyo_no_entregados'] = $results->concluyo_no_entregados;
					$resultado['entregados_concluidos'] = $results->entregados_concluidos;
					$resultado['entregados_en_proceso'] = $results->entregados_en_proceso;
					$resultado['entregados_en_archivo'] = $results->entregados_en_archivo;

					$resultado['no_entregados_entrego_medico'] = $results->no_entregados_entrego_medico;
					$resultado['no_entregados_falto_medico'] = $results->no_entregados_falto_medico;
					$resultado['no_entregados_entrego_socioeconomico'] = $results->no_entregados_entrego_socioeconomico;
					$resultado['no_entregados_falto_socioeconomico'] = $results->no_entregados_falto_socioeconomico;
					$resultado['no_entregados_entrego_psicologia'] = $results->no_entregados_entrego_psicologia;
					$resultado['no_entregados_falto_psicologia'] = $results->no_entregados_falto_psicologia;
					$resultado['no_entregados_entrego_poligrafia'] = $results->no_entregados_entrego_poligrafia;
					$resultado['no_entregados_falto_poligrafia'] = $results->no_entregados_falto_poligrafia;
					$resultado['en_archivo_entrego_un_area'] = $results->en_archivo_entrego_un_area;
					$resultado['en_archivo_completos_sin_analizar'] = $results->en_archivo_completos_sin_analizar;
					$resultado['en_archivo_completos_sin_analizar_diferenciados'] = $results->en_archivo_completos_sin_analizar_diferenciados;
					$resultado['en_proceso_estatus_uno'] = $results->en_proceso_estatus_uno;
					$resultado['en_proceso_estatus_dos'] = $results->en_proceso_estatus_dos;
					$resultado['en_proceso_estatus_tres'] = $results->en_proceso_estatus_tres;
					$resultado['en_proceso_estatus_cuatro'] = $results->en_proceso_estatus_cuatro;
					$resultado['en_proceso_estatus_seis'] = $results->en_proceso_estatus_seis;
					$resultado['en_proceso_estatus_siete'] = $results->en_proceso_estatus_siete;
					$resultado['anio']=$anio;
					
					$resultados[] = $resultado;
				}

				return $resultados;
			}
			return null;

		}catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}


	public function obtenerDatosReporteNoEntregados($anio, $medico, $psicologia, $socioeconomico, $poligrafia)
	{
		$resultado = array();
		$resultados = array();
		

		try{
			$results = DB::select("exec DASH_ArchivoReporte ?, ?, ?, ?, ? ", array($anio, $medico, $psicologia,  $socioeconomico, $poligrafia));


			

			$totalEvaluados = count($results);

			

			if($totalEvaluados > 0) {
				foreach ($results as $results) {					
					
					$resultado['id_curp'] = $results->id_curp;
					$resultado['curp'] = $results->curp;
					$resultado['id_evaluacion'] = $results->id_evaluacion;
					$resultado['lnoconcluyo'] = $results->lnoconcluyo;
					$resultado['medico'] = $results->medico;
					$resultado['fTox'] = $results->fTox;
					$resultado['psicologia'] = $results->psicologia;
					$resultado['socioeconomico'] = $results->socioeconomico;
					$resultado['custodia'] = $results->custodia;
					
					$resultados[] = $resultado;
				}

				return $resultados;
			}
			return null;

		}catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}


	public function obtenerDatosReporteEnArchivo($anio, $medico, $psicologia, $socioeconomico, $poligrafia, $es_diferenciada, $no_areas_inicial, $no_areas_final){
		$resultado = array();
		$resultados = array();
		

		try{
			$results = DB::select("exec DASH_reporteExpedientesEnArchivo ?, ?, ?, ?, ?, ?, ?, ? ", array($anio, $medico, $psicologia,  $socioeconomico, $poligrafia, $es_diferenciada, $no_areas_inicial, $no_areas_final));

			$totalEvaluados = count($results);

			if($totalEvaluados > 0) {
				foreach ($results as $results) {					
					
					$resultado['id_curp'] = $results->id_curp;
					$resultado['curp'] = $results->curp;
					$resultado['id_evaluacion'] = $results->id_evaluacion;
					$resultado['es_diferenciada'] = $results->es_diferenciada;
					$resultado['no_areas'] = $results->no_areas;
					$resultado['medico'] = $results->medico;					
					$resultado['psicologia'] = $results->psicologia;
					$resultado['socioeconomico'] = $results->socioeconomico;
					$resultado['poligrafia'] = $results->poligrafia;
					
					$resultados[] = $resultado;
				}

				return $resultados;
			}
			return null;

		}catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	public function obtenerDatosReporteEnProceso($anio, $estatus)
	{
		$resultado = array();
		$resultados = array();
		

		try
		{
			$results = DB::select("exec DASH_reporteExpedientesEnProceso ?, ? ", array($anio, $estatus));

			$totalEvaluados = count($results);

			if($totalEvaluados > 0) {
				foreach ($results as $results) {					
					
					$resultado['numero_fila'] = $results->numero_fila;
					$resultado['curp'] = $results->curp;
					$resultado['id_evaluacion'] = $results->idevaluacion;
					$resultado['estatus'] = $results->estatus;					
					
					$resultados[] = $resultado;
				}

				return $resultados;
			}
			return null;

		}catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

}