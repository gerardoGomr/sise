<?php
namespace Sise\Infraestructura\Evaluaciones;

use DB;
use Sise\Dominio\Evaluaciones\Elemento;

/**
 * Class ElementosRepositorioLaravelSQLServer
 * @package Sise\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ElementosRepositorioLaravelSQLServer implements ElementosRepositorioInterface
{
	/**
	 * comprobar la existencia de un elemento en la base de datos
	 * @param  Elemento $elemento
	 * @return bool
	 */
	public function comprobarExistenciaElemento(Elemento $elemento)
	{
		try {

			$elementos = DB::connection('Integral')
					->table('elemento')
					->leftJoin('evaluacion', 'evaluacion.idElemento', '=', 'elemento.idElemento')
					->leftJoin('resultado_integral', 'resultado_integral.idResultadoIntegral', '=', 'evaluacion.idResultadoIntegral')
					->where('evaluacion.idElemento', $elemento->getIdElemento())
					->where('evaluacion.FechaEvaluacion', DB::raw('(SELECT MAX(FechaEvaluacion) FROM evaluacion WHERE idElemento = ' . $elemento->getIdElemento() . ')'))
					->first();

			$totalResultados = count($elementos);

			if($totalResultados > 0) {
				// Setear bandera de existencia
				$elemento->existe(true);
				$elemento->setId($elementos->idElemento);

				// setear evaluación anterior
				if(!is_null($elementos->idEvaluacion)){
					$elemento->setEvaluacionAnterior(new Evaluacion($elementos->idEvaluacion));
					$elemento->getEvaluacionAnterior()->setResultadoIntegral(new ResultadoIntegral($elementos->idResultadoIntegral, $elementos->ResultadoIntegral));
				}

				return true;
			}

			return false;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
}