<?php
namespace Sise\Graficas;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
interface EvaluadosRepositorioInterface
{
	/**
	 * obtener el total de evaluaciones del año
	 * @param  int $anio
	 * @return int
	 */
	public function obtenerTotalEvaluacionesConcluidas($anio = 2015);

	/**
	 * obtener el total por resultado integral
	 * @param  int   $anio
	 * @return array
	 */
	public function obtenerResultadosIntegrales($anio = 2015);

	/**
	 * obtener el numero de evaluaciones en proceso
	 * @param  int $anio
	 * @return int
	 */
	public function obtenerTotalEvaluacionesEnProceso($anio = 2015);

	/**
	 * obtener el numero de evaluaciones completadas por año
	 * @param  int $anio
	 * @return array
	 */
	public function obtenerEvaluacionesConcluidasMensual($anio = 2015);
}