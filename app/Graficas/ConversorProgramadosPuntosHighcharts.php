<?php
namespace Sise\Graficas;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class ConversorProgramadosPuntosHighcharts extends ConversorPuntos
{
	public function convertir($listaDatos)
	{
		$listaFinal        = array();
		$listaProgramados  = array();
		$listaPrioridadUno = array();
		$listaSubsecuentes = array();
		$listaXAxis		   = array();
		foreach ($listaDatos as $indice => $datoActual) {
			$listaProgramados[]  = array($listaDatos[$indice]['Fecha'], (int)$listaDatos[$indice]['Programados']);
			$listaPrioridadUno[] = array($listaDatos[$indice]['Fecha'], (int)$listaDatos[$indice]['PrioridadUno']);
			$listaSubsecuentes[] = array($listaDatos[$indice]['Fecha'], (int)$listaDatos[$indice]['Subsecuentes']);
		}

		$listaFinal[] = array('type' => 'spline', 'name' => 'Programados', 'data' => $listaProgramados);
		$listaFinal[] = array('type' => 'column', 'name' => 'PrioridadUno', 'data' => $listaPrioridadUno);
		$listaFinal[] = array('type' => 'column', 'name' => 'Subsecuentes', 'data' => $listaSubsecuentes);

		return $listaFinal;
	}
}