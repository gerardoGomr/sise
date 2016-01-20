<?php
namespace Sise\Graficas;

use DB;
/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class ProgramadosRepositorioLaravelSQLServer implements ProgramadosRepositorioInterface
{
	/**
	 * obtener el total de programados del año especificado
	 * @param  int $anio
	 * @return int
	 */
	public function obtenerTotalProgramados($anio)
	{
		try {
			$programados = DB::connection('Integral')
				->table('tHistorico')
				->select(DB::raw('COUNT(idevaluacion) AS TotalProgramados'))
				->where(DB::raw('YEAR(fProbableEVAL)'), $anio)
				->where('precarga', '0')
				->whereRaw('Status_Programacion IN (3,9)')
				->first();

			$totalProgramados = count($programados);

			if($totalProgramados > 0) {
				return $programados->TotalProgramados;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener el total de programados por mes del año especificado
	 * @param  int   $anio
	 * @return array
	 */
	public function obtenerDatosProgramacionMensual($anio)
	{
		$resultados = array();
		$resultado  = array();

		try {
			$programados = DB::connection('Integral')
				->table('estadistica_diaria_programados')
				->select(DB::raw('DATENAME(MONTH, FechaEvaluacion) AS Mes, YEAR(FechaEvaluacion) AS Anio, SUM(Programados) AS Programados, SUM(PrimeraVez) AS PrioridadUno, SUM(Subsecuentes) AS Subsecuentes, SUM(Hombre) AS Hombres, SUM(Mujeres) AS Mujeres, DATEPART(MONTH, FechaEvaluacion) AS NombreMes'))
				->where(DB::raw('YEAR(FechaEvaluacion)'), $anio)
				->groupBy(DB::raw('DATENAME(MONTH, FechaEvaluacion), YEAR(FechaEvaluacion), DATEPART(MONTH, FechaEvaluacion)'))
				->orderBy(DB::raw('DATEPART(MONTH, FechaEvaluacion)'))
				->get();

			$totalProgramados = count($programados);

			if($totalProgramados > 0) {
				foreach ($programados as $programados) {
					$resultado['Periodo']      = $programados->Mes . ' - ' . $programados->Anio;
					$resultado['Programados']  = $programados->Programados;
					$resultado['PrioridadUno'] = $programados->PrioridadUno;
					$resultado['Subsecuentes'] = $programados->Subsecuentes;
					$resultado['Hombres']      = $programados->Hombres;
					$resultado['Mujeres']      = $programados->Mujeres;

					$resultados[]              = $resultado;
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