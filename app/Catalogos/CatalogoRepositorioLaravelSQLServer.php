<?php
namespace Sise\Catalogos;

use DB;

class CatalogoRepositorioLaravelSQLServer implements CatalogoRepositorioInterface{

	public function obtenerCatalogo($catalogo)
	{
		$resultado = array();
		
		if($catalogo=='anio')
		{
			try
			{			
				$results = DB::select("SELECT YEAR(fecha_alta) as anio FROM tHistorico WHERE precarga=1 GROUP BY  YEAR(fecha_alta) ORDER BY YEAR(fecha_alta) ASC ");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->anio] = $results->anio;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='estatus_custodia')
		{
			try
			{			
				$results = DB::select("SELECT id_status_Analisis AS id, Status_Analisis AS estatus FROM c_Status_Custodia
								WHERE (id_status_Analisis <> 0 AND id_status_Analisis <> 5 AND id_status_Analisis IS NOT NULL)
								ORDER BY id_status_Analisis ASC");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->id] = $results->estatus;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='estatus_custodia_completo')
		{
			try
			{			
				$results = DB::select("SELECT distinct id_status_Analisis AS id, Status_Analisis AS estatus FROM c_Status_Custodia
								
								ORDER BY id_status_Analisis ASC");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->id] = $results->estatus;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='columnas_vista_planeacion')
		{
			try
			{			
				$results = DB::select("SELECT ORDINAL_POSITION,COLUMN_NAME, DATA_TYPE 
								FROM INFORMATION_SCHEMA.COLUMNS
								WHERE TABLE_NAME='Vta_DinamicaReporteCNCA' and TABLE_CATALOG='Integral'
								AND ORDINAL_POSITION <> 2 AND ORDINAL_POSITION <> 3 AND ORDINAL_POSITION <> 4 
								AND ORDINAL_POSITION <> 5 AND ORDINAL_POSITION <> 6 AND ORDINAL_POSITION <> 7 
								AND ORDINAL_POSITION <> 9 AND ORDINAL_POSITION <> 10 AND ORDINAL_POSITION <> 11 
								AND ORDINAL_POSITION <> 12 AND ORDINAL_POSITION <> 13 AND ORDINAL_POSITION <> 14 
								AND ORDINAL_POSITION <> 18
								AND ORDINAL_POSITION <> 22 AND ORDINAL_POSITION <> 24 AND ORDINAL_POSITION <> 25 
								AND ORDINAL_POSITION <> 26 AND ORDINAL_POSITION <> 27 AND ORDINAL_POSITION <> 28 
								AND ORDINAL_POSITION <> 29 AND ORDINAL_POSITION <> 30 AND ORDINAL_POSITION <> 31 ");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[] = $results->COLUMN_NAME;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}


		if($catalogo=='centro_evaluacion')
		{
			try
			{			
				$results = DB::select("SELECT idceccc, centroeval FROM c_centroeval");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->centroeval] = $results->centroeval;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='evaluacion')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT cevaluacion FROM tHistorico");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->cevaluacion] = $results->cevaluacion;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='tipo_evaluacion')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT [TIPO EVALUACION] AS tipo_evaluacion FROM Vta_DinamicaReporteCNCA");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->tipo_evaluacion] = $results->tipo_evaluacion;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='institucion_adscripcion')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT [INSTITUCION DE ADSCRIPCION] AS institucion_adscripcion FROM Vta_DinamicaReporteCNCA");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->institucion_adscripcion] = $results->institucion_adscripcion;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='grupo_especial')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT [GRUPO ESPECIAL] AS grupo_especial FROM Vta_DinamicaReporteCNCA");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->grupo_especial] = $results->grupo_especial;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='categoria_puesto')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT [CATEGORIA DEL PUESTO] AS categoria_puesto FROM Vta_DinamicaReporteCNCA
");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[ $results->categoria_puesto] = $results->categoria_puesto;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='puesto')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT puesto FROM tHistorico
										ORDER BY puesto ASC");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->puesto] = $results->puesto;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='resultado_unico')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT [RESULTADO ÚNICO] AS resultado_unico FROM Vta_DinamicaReporteCNCA");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->resultado_unico] = $results->resultado_unico;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='fuentedefinanciamiento')
		{
			try
			{			
				$results = DB::select("SELECT idfuente, fuentedefinanciamiento  FROM c_ffinanciamiento
										ORDER BY idfuente ASC");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->fuentedefinanciamiento] = $results->fuentedefinanciamiento;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='resultado_integral')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT cResultadoint FROM pCustodia WHERE cResultadoint <> '' ");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->cResultadoint] = $results->cResultadoint;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='dependencia')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT cve_dependencia, desc_dependencia FROM CATALOGO_DEPENDENCIAS ORDER BY desc_dependencia ASC");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->cve_dependencia] = $results->desc_dependencia;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		if($catalogo=='usuarios')
		{
			try
			{			
				$results = DB::select("SELECT DISTINCT usuario, ISNULL(nombre,'') AS nombre FROM tUsuarios ORDER BY nombre ASC");			

				$total = count($results);			

				if($total > 0) {
					foreach ($results as $results) {					
						
						$resultado[$results->nombre] = $results->nombre;					
					}

					return $resultado;
				}
				return null;

			}catch(\Exception $e) 
			{
				echo $e->getMessage();
				return null;
			}
		}

		

	}

}