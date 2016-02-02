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
			$results = DB::select("exec DASH_reporteExpedientesNoEntregados ?, ?, ?, ?, ? ", array($anio, $medico, $psicologia,  $socioeconomico, $poligrafia));

			$totalEvaluados = count($results);		

			if($totalEvaluados > 0) {
				foreach ($results as $results) {					
					
					$resultado[0] = $results->clave_archivo;		
					$resultado[1] = $results->codigo_evaluado;					
					$resultado[2] = $results->nombre_completo;	
					//$resultado[2] = $results->sexo;
					//$resultado[3] = $results->fecha_alta;
					$resultado[3] = $results->dependencia;
					$resultado[4] = $results->puesto;
					$resultado[5] = $results->curp;						
					$resultado[6] = $results->medico;					
					$resultado[7] = $results->psicologia;
					$resultado[8] = $results->socioeconomico;
					$resultado[9] = $results->custodia;

					
					$resultados[] = $resultado;
				}

				return $resultados;
				//return json_decode(json_encode($results), true);			
			}
			return null;

		}catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}


	public function obtenerDatosReporteEnArchivo($anio, $medico, $psicologia, $socioeconomico, $poligrafia, $es_diferenciada, $no_areas_inicial, $no_areas_final, $estatus_expediente){
		$resultado = array();
		$resultados = array();
		

		/*$test = array($anio, $medico, $psicologia,  $socioeconomico, $poligrafia, $es_diferenciada, $no_areas_inicial, $no_areas_final, $estatus_expediente);
		
		print_r($test);exit();*/

		try{
			$results = DB::select("exec DASH_reporteExpedientesEnArchivo ?, ?, ?, ?, ?, ?, ?, ?, ? ", array($anio, $medico, $psicologia,  $socioeconomico, $poligrafia, $es_diferenciada, $no_areas_inicial, $no_areas_final, $estatus_expediente));

			//print_r($results);
			$totalEvaluados = count($results);

			if($totalEvaluados > 0) {
				foreach ($results as $results) {					
									
					$resultado[0] = $results->clave_archivo;		
					$resultado[1] = $results->codigo_evaluado;					
					$resultado[2] = $results->nombre_completo;	
					//$resultado[2] = $results->sexo;
					//$resultado[3] = $results->fecha_alta;
					$resultado[3] = $results->dependencia;
					$resultado[4] = $results->puesto;
					$resultado[5] = $results->curp;	
					$resultado[6] = $results->tipo;						
					$resultado[7] = $results->medico;					
					$resultado[8] = $results->psicologia;
					$resultado[9] = $results->socioeconomico;
					$resultado[10] = $results->custodia;

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
					$resultado[0] = $results->clave_archivo;
					$resultado[1] = $results->codigo_evaluado;					
					$resultado[2] = $results->nombre_completo;	
					$resultado[3] = $results->supervisor;
					$resultado[4] = $results->analista;
					$resultado[5] = $results->dependencia;
					$resultado[6] = $results->puesto;
					$resultado[7] = $results->curp;		
					$resultado[8] = $results->estatus;					
					
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

	public function obtenerDatosTotales($anio,$estatus, $concluyo, $diferenciadas, $tipo, $medico, $psicologia, $socioeconomico, $poligrafia, $resultado_evaluacion, $procedencia, $supervisor, $analista)
	{
		$resultado = array();
		$resultados = array();
		
		try
		{
			$results = DB::select("exec DASH_reporteExpedientesTotales ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ", array($anio,$estatus, $concluyo, $diferenciadas, $tipo, $medico, $poligrafia, $psicologia, $socioeconomico, $resultado_evaluacion, $procedencia, $supervisor, $analista));


			$totalEvaluados = count($results);

			if($totalEvaluados > 0) {
				foreach ($results as $results) {					
					$resultado[0] = $results->clave_archivo;
					$resultado[1] = $results->codigo_evaluado;	
					$resultado[2] = $results->dependencia;				
					$resultado[3] = $results->nombre_completo;	
					$resultado[4] = $results->curp;	
					
					$resultado[5] = $results->medico;	
					$resultado[6] = $results->poligrafia;				
					$resultado[7] = $results->psicologia;
					$resultado[8] = $results->socioeconomico;
					
						
					$resultado[9] = $results->fecha_alta;
					$resultado[10] = $results->tipo;
					$resultado[11] = $results->resultado;				

					$resultado[12] = $results->supervisor;	
					$resultado[13] = $results->analista;	
					$resultado[14] = $results->estatus;	

					$resultado[15] = $results->diferenciada;	
					$resultado[16] = $results->concluyo;	
					
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