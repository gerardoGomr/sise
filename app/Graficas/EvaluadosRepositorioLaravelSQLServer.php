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
	public function obtenerTotalEvaluacionesConcluidas($anio = 2015)
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
	public function obtenerResultadosIntegrales($anio = 2015)
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
	public function obtenerTotalEvaluacionesEnProceso($anio = 2015)
	{
		try {
			$evaluados = DB::connection('Integral')
				->table('tHistorico')
				->join('pCustodia', function($join) {
					$join->on('pCustodia.idevaluacion', '=', 'tHistorico.idevaluacion')
					->on('pCustodia.curp_evaluado', '=', 'tHistorico.curp');
				})
				->select(DB::raw("COUNT(tHistorico.idevaluacion) AS TotalEnProceso"))
				->where(function($query) {
					$query->where('pCustodia.StatusCust', '<', 5)
						->orWhereNull('pCustodia.StatusCust')
						->orWhere('pCustodia.StatusCust', 7);
				})
				->where('tHistorico.precarga', 1)
				->whereNotIn('tHistorico.cevaluacion', ['portacion de arma de fuego','OTRAS EVALUACIONES','INVESTIGACIONES ESPECIALES'])
				->where(DB::raw('YEAR(tHistorico.fProbableEVAL)'), $anio)
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
	public function obtenerEvaluacionesConcluidasMensual($anio = 2015)
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
}