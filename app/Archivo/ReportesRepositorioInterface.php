<?php
namespace Sise\Archivo;

interface ReportesRepositorioInterface
{
	public function obtenerDatosIngresos($anio);

	public function obtenerDatosReporteNoEntregados($anio, $medico, $psicologia, $socioeconomico, $poligrafia);
	
	public function  obtenerDatosReporteEnArchivo($anio, $medico, $psicologia, $socioeconomico, $poligrafia, $es_diferenciada, $no_areas_inicial, $no_areas_final);

	public function obtenerDatosReporteEnProceso($anio, $estatus);
}