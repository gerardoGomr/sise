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
	public function obtenerTotalProgramados($anio = 2015)
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
	 * obtener datos programados mensualmente
	 * @param  int   $anio
	 * @return array
	 */
	public function obtenerDatosProgramacionMensual($anio)
	{
		$resultados = array();
		$resultado  = array();

		try {
			$programados = DB::connection('Integral')
				->table('g_estadistica_diaria_programados')
				->select(DB::raw('DATENAME(MONTH, fechacorte) AS Mes, YEAR(fechacorte) AS Anio, SUM(programados) AS Programados, SUM(prioridaduno) AS PrioridadUno, SUM(subsecuentes) AS Subsecuentes, DATEPART(MONTH, fechacorte) AS NombreMes'))
				->where(DB::raw('YEAR(fechacorte)'), $anio)
				->groupBy(DB::raw('DATENAME(MONTH, fechacorte), YEAR(fechacorte), DATEPART(MONTH, fechacorte)'))
				->orderBy(DB::raw('DATEPART(MONTH, fechacorte)'))
				->get();

			$totalProgramados = count($programados);

			if($totalProgramados > 0) {
				foreach ($programados as $programados) {
					$resultado['Fecha']  	   = $programados->Mes . ' - ' . $programados->Anio;
					$resultado['Programados']  = $programados->Programados;
					$resultado['PrioridadUno'] = $programados->PrioridadUno;
					$resultado['Subsecuentes'] = $programados->Subsecuentes;

					$resultados[] = $resultado;
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