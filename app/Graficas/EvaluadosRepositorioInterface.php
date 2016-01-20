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
	public function obtenerTotalEvaluacionesConcluidas($anio);

	/**
	 * obtener el total por resultado integral
	 * @param  int   $anio
	 * @return array
	 */
	public function obtenerResultadosIntegrales($anio);

	/**
	 * obtener el numero de evaluaciones en proceso
	 * @param  int $anio
	 * @return int
	 */
	public function obtenerTotalEvaluacionesEnProceso($anio);

	/**
	 * obtener el numero de evaluaciones completadas por año
	 * @param  int $anio
	 * @return array
	 */
	public function obtenerEvaluacionesConcluidasMensual($anio);

	/**
	 * obtener anios de evaluaciones
	 * @return array
	 */
	public function obtenerAniosEvaluaciones();

	/**
	 * buscar una lista de evaluados dependiendo el parámetro de búsqueda
	 * @param  string $txtDato
	 * @return array
	 */
	public function verEvaluados($txtDato = '');

	/**
	 * obtener una instancia de un evaluado buscando por su curp
	 * @param  string $curp
	 * @return array
	 */
	public function obtenerEvaluadoPorCurp($curp);

	/**
	 * obtener una instancia de un evaluado buscando por el idEvaluacion
	 * @param  int $idEvaluacion
	 * @return array
	 */
	public function obtenerEvaluadoPorIdEvaluacion($idEvaluacion);

	/**
	 * obtener total de evaluaciones pendientes por Area y Anio
	 * @param  int   $anio
	 * @return array
	 */
	public function obtenerEvaluacionesPendientesPorAreaAnio($anio);

	/**
	 * obtener los datos de evaluaciones dependiendo el rango de fechas
	 * @param string $fecha1
	 * @param string $fecha2
	 * @return array
	 */
	public function obtenerEvaluacionesProductividad($fecha1, $fecha2);
}