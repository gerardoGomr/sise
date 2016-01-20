<?php
namespace Sise\Graficas;

use DB;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class EvaluadosRepositorioLaravelSQLServer implements EvaluadosRepositorioInterface
{

	/**
	 * obtener el total de evaluaciones del año
	 * @param  int $anio
	 * @return int
	 */
	public function obtenerTotalEvaluacionesConcluidas($anio)
	{
		try {
			$evaluados = DB::connection('Integral')
				->table('tHistorico')
				->join('pCustodia', function($join) {
					$join->on('pCustodia.idevaluacion', '=', 'tHistorico.idevaluacion')
					->on('pCustodia.curp_evaluado', '=', 'tHistorico.curp');
				})
				->select(DB::raw("COUNT(tHistorico.idevaluacion) AS TotalEvaluaciones"))
				->where('pCustodia.StatusCust', 5)
				->where('tHistorico.precarga', 1)
				->whereNotIn('tHistorico.cevaluacion', ['portacion de arma de fuego','OTRAS EVALUACIONES','INVESTIGACIONES ESPECIALES'])
				->where(DB::raw('YEAR(pCustodia.fResultadoIntegral)'), $anio)
				->first();

			$totalEvaluados = count($evaluados);

			if($totalEvaluados > 0) {
				return $evaluados->TotalEvaluaciones;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener el total por resultado integral
	 * @param  int   $anio
	 * @return array
	 */
	public function obtenerResultadosIntegrales($anio)
	{
		$listaResultados = array();
		try {
			$evaluados = DB::connection('Integral')
				->table('tHistorico')
				->join('pCustodia', function($join) {
					$join->on('pCustodia.idevaluacion', '=', 'tHistorico.idevaluacion')
					->on('pCustodia.curp_evaluado', '=', 'tHistorico.curp');
				})
				->select(DB::raw("COUNT(tHistorico.idevaluacion) AS TotalEvaluaciones"), 'pCustodia.cResultadoint')
				->where('pCustodia.StatusCust', 5)
				->where('tHistorico.precarga', 1)
				->whereNotIn('tHistorico.cevaluacion', ['portacion de arma de fuego','OTRAS EVALUACIONES','INVESTIGACIONES ESPECIALES'])
				->where(DB::raw('YEAR(pCustodia.fResultadoIntegral)'), $anio)
				->groupBy('pCustodia.cResultadoint')
				->get();

			$totalEvaluados = count($evaluados);

			if($totalEvaluados > 0) {
				foreach ($evaluados as $evaluados) {

					$listaResultados[] = array(
						'TotalEvaluaciones' => $evaluados->TotalEvaluaciones,
						'cResultadoint'     => $evaluados->cResultadoint
					);
				}

				return $listaResultados;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener el numero de evaluaciones en proceso
	 * @param  int $anio
	 * @return int
	 */
	public function obtenerTotalEvaluacionesEnProceso($anio)
	{
		try {
			$evaluados = DB::connection('Integral')
				->table('tHistorico')
				->leftJoin('pCustodia', function($join) {
					$join->on('pCustodia.idevaluacion', '=', 'tHistorico.idevaluacion')
					->on('pCustodia.curp_evaluado', '=', 'tHistorico.curp');
				})
				->select(DB::raw("COUNT(tHistorico.idevaluacion) AS TotalEnProceso"))
				->where(function($query) {
					$query->where('pCustodia.StatusCust', '!=', 5)
						->orWhereNull('pCustodia.StatusCust');
				})
				->where('tHistorico.precarga', 1)
				->whereNotIn('tHistorico.cevaluacion', ['portacion de arma de fuego','OTRAS EVALUACIONES','INVESTIGACIONES ESPECIALES'])
				->where(DB::raw('YEAR(tHistorico.fecha_alta)'), $anio)
				->where('tHistorico.lnoconcluyo', '!=', 1)
				->first();

			$totalEvaluados = count($evaluados);

			if($totalEvaluados > 0) {
				return $evaluados->TotalEnProceso;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener el numero de evaluaciones completadas por año
	 * @param  int $anio
	 * @return array
	 */
	public function obtenerEvaluacionesConcluidasMensual($anio)
	{
		$resultados = array();
		$resultado  = array();
		try {
			$evaluados = DB::connection('Integral')
				->table('tHistorico')
				->join('pCustodia', function($join) {
					$join->on('pCustodia.idevaluacion', '=', 'tHistorico.idevaluacion')
					->on('pCustodia.curp_evaluado', '=', 'tHistorico.curp');
				})
				->select(DB::raw("COUNT(tHistorico.idevaluacion) AS TotalEvaluaciones, CONCAT(DATENAME(MONTH, pCustodia.fResultadoIntegral), '/', YEAR(pCustodia.fResultadoIntegral)) AS Periodo, DATEPART(MONTH, pCustodia.fResultadoIntegral) AS Mes"))
				->where('pCustodia.StatusCust', 5)
				->where('tHistorico.precarga', 1)
				->whereNotIn('tHistorico.cevaluacion', ['portacion de arma de fuego','OTRAS EVALUACIONES','INVESTIGACIONES ESPECIALES'])
				->where(DB::raw('YEAR(pCustodia.fResultadoIntegral)'), $anio)
				->groupBy(DB::raw('DATENAME(MONTH, pCustodia.fResultadoIntegral), YEAR(pCustodia.fResultadoIntegral), DATEPART(MONTH, pCustodia.fResultadoIntegral)'))
				->orderBy(DB::raw('DATEPART(MONTH, pCustodia.fResultadoIntegral)'))
				->get();

			$totalEvaluados = count($evaluados);

			if($totalEvaluados > 0) {
				foreach ($evaluados as $evaluados) {

					$resultado['Periodo']           = $evaluados->Periodo;
					$resultado['TotalEvaluaciones'] = $evaluados->TotalEvaluaciones;

					$resultados[]                   = $resultado;
				}

				return $resultados;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener anios de evaluaciones
	 * @return array
	 */
	public function obtenerAniosEvaluaciones()
	{
		$listaAnios = array();
		try {

			$anios = DB::connection('Integral')
				->table('tHistorico')
				->select(DB::raw('YEAR(fProbableEVAL) AS Anio'))
				->groupBy(DB::raw('YEAR(fProbableEVAL)'))
				->havingRaw('YEAR(fProbableEVAL) IS NOT NULL AND YEAR(fProbableEVAL) <= YEAR(GETDATE()) AND YEAR(fProbableEVAL) != 1900')
				->orderBy(DB::raw('YEAR(fProbableEVAL)'))
				->get();

			$totalAnios = count($anios);

			if($totalAnios > 0) {

				foreach ($anios as $anios) {

					$listaAnios[] = $anios->Anio;
				}

				return $listaAnios;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * buscar una lista de evaluados dependiendo el parámetro de búsqueda
	 * @param  string $txtDato
	 * @return array
	 */
	public function verEvaluados($txtDato = '')
	{
		$txtDato        = str_replace(' ', '', $txtDato);
		$listaEvaluados = array();

		try {
			$evaluados = DB::connection('merk_ceccc')
				->table('padron')
				->where(DB::raw("CONCAT(REPLACE(Nombre, ' ', ''), REPLACE(Paterno, ' ', ''), REPLACE(Materno, ' ', ''))"), 'LIKE', "%$txtDato%")
				->orWhere(DB::raw("CONCAT(REPLACE(Paterno, ' ', ''), REPLACE(Materno, ' ', ''), REPLACE(Nombre, ' ', ''))"), 'LIKE', "%$txtDato%")
				->orWhere('CURP', 'LIKE', "%$txtDato%")
				->orWhere('RFC', 'LIKE', "%$txtDato%")
				->get();

			$totalEvaluados = count($evaluados);

			if($totalEvaluados > 0) {
				foreach ($evaluados as $evaluados) {
					// obtener la fotografía
					$pdo = DB::connection('merk_ceccc')->getPdo();
					$stmt = $pdo->prepare('SELECT Picture FROM tblImgData WHERE Periodo = (SELECT NumeroEvaluacion FROM evaluaciones WHERE FechaEvaluacion = (SELECT MAX(FechaEvaluacion) FROM evaluaciones WHERE idPadron = ?) and idPadron = ?) AND CURP = (SELECT CURP FROM evaluaciones WHERE FechaEvaluacion = (SELECT MAX(FechaEvaluacion) FROM evaluaciones WHERE idPadron = ?) and idPadron = ?)');
					$stmt->execute(array($evaluados->idPadron, $evaluados->idPadron, $evaluados->idPadron, $evaluados->idPadron));//exit;
					$stmt->bindColumn(1, $image, \PDO::PARAM_LOB, 0, \PDO::SQLSRV_ENCODING_BINARY);//exit;
					$resultado = $stmt->fetch(\PDO::FETCH_BOUND);//exit;

					$listaEvaluados[] = array(
						'Nombre' => $evaluados->Nombre.' '.$evaluados->Paterno.' '.$evaluados->Materno,
						'CURP'   => $evaluados->CURP,
						'RFC'    => $evaluados->RFC,
						'Foto'   => $resultado === true ? $image : '-'
					);
				}

				return $listaEvaluados;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener una instancia de un evaluado buscando por su curp
	 * @param  string $curp
	 * @return array
	 */
	public function obtenerEvaluadoPorCurp($curp)
	{
		$evaluado = null;

		try {
			$evaluados = DB::connection('merk_ceccc')
				->table('padron')
				->join('estado_municipios', 'estado_municipios.idMunicipio', '=', 'padron.idMunicipio')
				->join('escolaridad', 'escolaridad.idEscolaridad', '=', 'padron.idEscolaridad')
				->join('dependencia', 'dependencia.idDependencia', '=', 'padron.idDependencia')
				->where('padron.CURP', $curp)
				->first();

			$totalEvaluados = count($evaluados);

			if($totalEvaluados > 0) {

				$evaluado = $this->cargarEvaluado($evaluados);

				// obtener la lista de evaluaciones
				$evaluaciones = DB::connection('merk_ceccc')
					->table('evaluaciones')
					->join('evaluaciones_tipo', 'evaluaciones_tipo.idTipoEvaluacion', '=', 'evaluaciones.idTipoEvaluacion')
					->join('dependencia', 'dependencia.idDependencia', '=', 'evaluaciones.idDependencia')
					->leftJoin('c_Rprogramar', 'c_Rprogramar.cClaveVigencia', '=', 'evaluaciones.VigenciaEvaluacion')
					->where('idPadron', $evaluado['idPadron'])
					->orderBy('FechaEvaluacion', 'DESC')
					->get();

				$totalEvaluaciones = count($evaluaciones);

				if($totalEvaluaciones > 0) {

					foreach ($evaluaciones as $evaluaciones) {

						$evaluado['evaluaciones'][] = $this->cargarEvaluaciones($evaluaciones);
					}
				}
				//////////////////////////////////////////////////////////////////////////////////////////////

				// obtener la lista de exámenes
				$examenes = DB::connection('merk_ceccc')
					->table('evaluaciones_has_examenes')
					->join('evaluaciones_examenes', 'evaluaciones_examenes.idTipoExamen', '=', 'evaluaciones_has_examenes.idTipoExamen')
					->leftJoin('evaluacion_examen_resultado', 'evaluacion_examen_resultado.idResultadoExamen', '=', 'evaluaciones_has_examenes.idResultadoExamen')
					->join('evaluaciones', 'evaluaciones.idEvaluacion', '=', 'evaluaciones_has_examenes.idEvaluacion')
					->leftJoin('c_Status_Custodia', 'c_Status_Custodia.id_status_Analisis', '=', 'evaluaciones.StatusCust')
					->where("evaluaciones_has_examenes.idEvaluacion" ,'=', DB::raw("(SELECT idEvaluacion FROM evaluaciones WHERE FechaEvaluacion = (SELECT MAX(FechaEvaluacion) FROM evaluaciones WHERE idPadron = ".$evaluado['idPadron'].") AND idPadron = ".$evaluado['idPadron'].")"))
					->get();

				$totalExamenes = count($examenes);

				if($totalExamenes > 0) {

					foreach ($examenes as $examenes) {

						$evaluado['Examenes'][] = $this->cargarExamenes($examenes);
					}
				}
				//////////////////////////////////////////////////////////////////////////////////////////////

				// obtener la fotografía
				$pdo = DB::connection('merk_ceccc')->getPdo();
				$stmt = $pdo->prepare('SELECT Picture FROM tblImgData WHERE Periodo = (SELECT NumeroEvaluacion FROM evaluaciones WHERE FechaEvaluacion = (SELECT MAX(FechaEvaluacion) FROM evaluaciones WHERE idPadron = ?) and idPadron = ?) AND CURP = (SELECT CURP FROM evaluaciones WHERE FechaEvaluacion = (SELECT MAX(FechaEvaluacion) FROM evaluaciones WHERE idPadron = ?) and idPadron = ?)');
				$stmt->execute(array($evaluado['idPadron'], $evaluado['idPadron'], $evaluado['idPadron'], $evaluado['idPadron']));//exit;
				$stmt->bindColumn(1, $image, \PDO::PARAM_LOB, 0, \PDO::SQLSRV_ENCODING_BINARY);//exit;
				$resultado = $stmt->fetch(\PDO::FETCH_BOUND);//exit;

				if($resultado === true) {

					$evaluado['Foto'] = $image;
				}

				return $evaluado;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener una instancia de un evaluado buscando por el idEvaluacion
	 * @param  int $idEvaluacion
	 * @return array
	 */
	public function obtenerEvaluadoPorIdEvaluacion($idEvaluacion)
	{
		$evaluado = null;

		try {

			// echo $idEvaluacion;exit;
			$evaluados = DB::connection('merk_ceccc')
				->table('evaluaciones')
				->join('estado_municipios', 'estado_municipios.idMunicipio', '=', 'evaluaciones.idMunicipio')
				->join('escolaridad', 'escolaridad.idEscolaridad', '=', 'evaluaciones.idEscolaridad')
				->join('dependencia', 'dependencia.idDependencia', '=', 'evaluaciones.idDependencia')
				->leftJoin('c_Status_Custodia', 'c_Status_Custodia.id_status_Analisis', '=', 'evaluaciones.StatusCust')
				->leftJoin('c_Rprogramar', 'c_Rprogramar.cClaveVigencia', '=', 'evaluaciones.VigenciaEvaluacion')
				->where('evaluaciones.idEvaluacion', $idEvaluacion)
				->first();

			$totalEvaluados = count($evaluados);

			if($totalEvaluados > 0) {

				$evaluado = $this->cargarEvaluado($evaluados);
				$evaluado['idEvaluacion']     = $evaluados->idEvaluacion;
				$evaluado['NumeroEvaluacion'] = $evaluados->NumeroEvaluacion;
				$evaluado['FechaEvaluacion']  = $evaluados->FechaEvaluacion;
				$evaluado['descVigencia']	  = $evaluados->descVigencia;
				$evaluado['cResultadoint']	  = $evaluados->cResultadoint;
				$evaluado['fResultadoint']	  = $evaluados->fResultadoint;
				$evaluado['fVigencia']		  = $evaluados->fVigencia;
				$evaluado['Status_Analisis']  = $evaluados->Status_Analisis;

				// obtener la lista de evaluaciones
				$evaluaciones = DB::connection('merk_ceccc')
					->table('evaluaciones')
					->join('evaluaciones_tipo', 'evaluaciones_tipo.idTipoEvaluacion', '=', 'evaluaciones.idTipoEvaluacion')
					->join('dependencia', 'dependencia.idDependencia', '=', 'evaluaciones.idDependencia')
					->leftJoin('c_Rprogramar', 'c_Rprogramar.cClaveVigencia', '=', 'evaluaciones.VigenciaEvaluacion')
					->where('idPadron', $evaluado['idPadron'])
					->orderBy('FechaEvaluacion', 'DESC')
					->get();

				$totalEvaluaciones = count($evaluaciones);

				if($totalEvaluaciones > 0) {

					foreach ($evaluaciones as $evaluaciones) {

						$evaluado['evaluaciones'][] = $this->cargarEvaluaciones($evaluaciones);
					}
				}
				//////////////////////////////////////////////////////////////////////////////////////////////

				// obtener la lista de exámenes
				$examenes = DB::connection('merk_ceccc')
					->table('evaluaciones_has_examenes')
					->join('evaluaciones_examenes', 'evaluaciones_examenes.idTipoExamen', '=', 'evaluaciones_has_examenes.idTipoExamen')
					->leftJoin('evaluacion_examen_resultado', 'evaluacion_examen_resultado.idResultadoExamen', '=', 'evaluaciones_has_examenes.idResultadoExamen')
					->join('evaluaciones', 'evaluaciones.idEvaluacion', '=', 'evaluaciones_has_examenes.idEvaluacion')
					->leftJoin('c_Status_Custodia', 'c_Status_Custodia.id_status_Analisis', '=', 'evaluaciones.StatusCust')
					->where('evaluaciones_has_examenes.idEvaluacion' ,'=', $evaluado['idEvaluacion'])
					->get();

				$totalExamenes = count($examenes);

				if($totalExamenes > 0) {

					foreach ($examenes as $examenes) {

						$evaluado['Examenes'][] = $this->cargarExamenes($examenes);
					}
				}
				//////////////////////////////////////////////////////////////////////////////////////////////
				// obtener la fotografía
				$pdo = DB::connection('merk_ceccc')->getPdo();
				$stmt = $pdo->prepare('SELECT Picture FROM tblImgData WHERE Periodo = ? AND CURP = ?');
				$stmt->execute(array($evaluado['NumeroEvaluacion'], $evaluado['CURP']));//exit;
				$stmt->bindColumn(1, $image, \PDO::PARAM_LOB, 0, \PDO::SQLSRV_ENCODING_BINARY);//exit;
				$resultado = $stmt->fetch(\PDO::FETCH_BOUND);//exit;

				if($resultado === true) {

					$evaluado['Foto'] = $image;
				}

				return $evaluado;
			}

			return null;

		} catch(\Exception $e) {
			return null;
		}
	}

	private function cargarEvaluado($evaluados)
	{
		return array(
			'idPadron'		  => $evaluados->idPadron,
			'Nombre'          => $evaluados->Nombre.' '.$evaluados->Paterno.' '.$evaluados->Materno,
			'CURP'            => $evaluados->CURP,
			'RFC'             => $evaluados->RFC,
			'Sangre'          => $evaluados->TipoSangre,
			'Peso'            => $evaluados->Peso,
			'Altura'          => $evaluados->Altura,
			'CUIP'            => $evaluados->CUIP,
			'FechaNacimiento' => $evaluados->FechaNacimiento,
			'LugarNacimiento' => $evaluados->LugarNacimiento,
			'EstadoCivil'     => $evaluados->idEstadoCivil2,
			'Escolaridad'     => $evaluados->Escolaridad,
			'Municipio'       => $evaluados->Municipio,
			'Dependencia'     => $evaluados->Dependencia,
			'Sexo'			  => $evaluados->Sexo,
			'Puesto'          => $evaluados->Puesto,
			'Mando'           => $evaluados->Mando,
			'Rango'           => $evaluados->Rango,
			'Especialidad'    => $evaluados->Especialidad,
			'TelCasa'         => $evaluados->TelCasa,
			'TelOficina'      => $evaluados->TelOficina,
			'Extension'       => $evaluados->Extension,
			'CodigoEvaluado'  => $evaluados->CodigoEvaluado
		);
	}

	/**
	 * cargar los índices del arreglo principal
	 * @param  pdo $evaluaciones
	 * @return array
	 */
	private function cargarEvaluaciones($evaluaciones)
	{
		return array(
			'idEvaluacion'           => $evaluaciones->idEvaluacion,
			'NumeroEvaluacion'       => $evaluaciones->NumeroEvaluacion,
			'FechaEvaluacion'        => $evaluaciones->FechaEvaluacion,
			'Vigencia'               => $evaluaciones->VigenciaEvaluacion,
			'ResultadoIntegral'      => $evaluaciones->cResultadoint,
			'FechaResultadoIntegral' => $evaluaciones->fResultadoint,
			'FechaVigencia'          => $evaluaciones->fVigencia,
			'TipoEvaluacion'		 => $evaluaciones->TipoEvaluacion,
			'Puesto'				 => $evaluaciones->Puesto,
			'Dependencia'			 => $evaluaciones->Dependencia,
			'descVigencia'			 => $evaluaciones->descVigencia
		);
	}

	/**
	 * cargar los índices del arreglo principal
	 * @param  pdo $examenes
	 * @return array
	 */
	private function cargarExamenes($examenes)
	{
		return array(
			'TipoExamen'        => $examenes->TipoExamen,
			'ResultadoExamen'   => $examenes->ResultadoExamen,
			'FechaEvaluacion'   => $examenes->FechaEvaluacion,
			'ResultadoIntegral' => $examenes->cResultadoint,
			'EstatusCustodia'   => $examenes->Status_Analisis
		);
	}

	/**
	 * obtener total de evaluaciones pendientes por Area y Anio
	 * @param  int   $anio
	 * @return array
	 */
	public function obtenerEvaluacionesPendientesPorAreaAnio($anio)
	{
		$resultado = array();
		$resultados = array();

		try{
			$expedientes = DB::connection('Integral')
				->select("exec DASH_ExpedientesFaltantesPorEntregarEnCustodia ?", array($anio));

			$totalExpedienteCustodia = count($expedientes);

			if($totalExpedienteCustodia > 0) {
				foreach ($expedientes as $expedientes) {
					$resultados[] = array(
						'entregados_en_proceso'                           => $expedientes->entregados_en_proceso,
						'entregados_en_archivo'                           => $expedientes->entregados_en_archivo,
						'concluyo_no_entregados'                          => $expedientes->concluyo_no_entregados,
						'no_entregados_entrego_medico'                    => $expedientes->no_entregados_entrego_medico,
						'no_entregados_falto_medico'                      => $expedientes->no_entregados_falto_medico,
						'no_entregados_entrego_socioeconomico'            => $expedientes->no_entregados_entrego_socioeconomico,
						'no_entregados_falto_socioeconomico'              => $expedientes->no_entregados_falto_socioeconomico,
						'no_entregados_entrego_psicologia'                => $expedientes->no_entregados_entrego_psicologia,
						'no_entregados_falto_psicologia'                  => $expedientes->no_entregados_falto_psicologia,
						'no_entregados_entrego_poligrafia'                => $expedientes->no_entregados_entrego_poligrafia,
						'no_entregados_falto_poligrafia'                  => $expedientes->no_entregados_falto_poligrafia,
						'en_archivo_entrego_un_area'                      => $expedientes->en_archivo_entrego_un_area,
						'en_archivo_completos_sin_analizar'               => $expedientes->en_archivo_completos_sin_analizar,
						'en_archivo_completos_sin_analizar_diferenciados' => $expedientes->en_archivo_completos_sin_analizar_diferenciados,
						'enRevisionAnalista'                              => $expedientes->en_proceso_estatus_uno,
						'analisisSupervisor'                              => $expedientes->en_proceso_estatus_dos,
						'vistoBuenoSupervisor'                            => $expedientes->en_proceso_estatus_tres,
						'analisisDirectorCustodia'                        => $expedientes->en_proceso_estatus_cuatro,
						'firmaDirectorGeneral'                            => $expedientes->en_proceso_estatus_seis,
						'entregadoACustodia'                              => $expedientes->en_proceso_estatus_siete
					);
				}

				return $resultados;
			}
			return null;

		}catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener los datos de evaluaciones dependiendo el rango de fechas
	 * @param string $fecha1
	 * @param string $fecha2
	 * @return array
	 */
	public function obtenerEvaluacionesProductividad($fecha1, $fecha2)
	{
		try{
			$evaluaciones = DB::connection('Integral')
				->select("exec EvaluacionesProductividad '$fecha1', '$fecha2'");

			$totalEvaluaciones = count($evaluaciones);

			if($totalEvaluaciones > 0) {
				$listaEvaluaciones = array(
					'TotalEvaluaciones'                => $evaluaciones[0]->TotalEvaluaciones,
					'TotalEvaluacionesResultado'       => $evaluaciones[0]->TotalEvaluacionesResultado,
					'TotalEvaluacionesMedicos'         => $evaluaciones[0]->TotalEvaluacionesMedicos,
					'TotalEvaluacionesPsicologia'      => $evaluaciones[0]->TotalEvaluacionesPsicologia,
					'TotalEvaluacionesSocioeconomicos' => $evaluaciones[0]->TotalEvaluacionesSocioeconomicos,
					'TotalEvaluacionesPoligrafia'      => $evaluaciones[0]->TotalEvaluacionesPoligrafia,
				);

				return $listaEvaluaciones;
			}
			return null;

		}catch(\PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}
}