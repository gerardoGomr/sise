<?php
namespace Sise\Graficas;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
interface ProgramadosRepositorioInterface
{
	/**
	 * obtener el total de programados del año especificado
	 * @param  int $anio
	 * @return int
	 */
	public function obtenerTotalProgramados($anio);

	/**
	 * obtener datos programados mensualmente
	 * @param  int   $anio
	 * @return array
	 */
	public function obtenerDatosProgramacionMensual($anio);
}