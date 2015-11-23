<?php
namespace Sise\Usuarios;

use DB;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class PuestosRepositorioLaravelSQLServer implements PuestosRepositorioInterface
{
	/**
	 * devuelve una lista de puestos
	 * @return array
	 */
	public function obtenerPuestos()
	{
		$listaPuestos = array();

		try {

			$puestos = DB::table('puesto')
				->get();

			$totalPuestos = count($puestos);

			if($totalPuestos === 0) {
				return null;
			}

			foreach ($puestos as $puestos) {
				$listaPuestos[] = new Puesto($puestos->idPuesto, $puestos->NombrePuesto);
			}

			return $listaPuestos;

		} catch(\PDOException $e) {

			return null;
		}
	}

	/**
	 * obtener un puesto por su id
	 * @param  int $id
	 * @return Puesto
	 */
	public function obtenerPuestoPorId($id)
	{
		try {

			$puestos = DB::table('puesto')
				->where('idPuesto', $id)
				->first();

			$totalPuestos = count($puestos);

			if($totalPuestos === 0) {
				return null;
			}

			return new Puesto($puestos->idPuesto, $puestos->NombrePuesto);

		} catch(\PDOException $e) {

			return null;
		}
	}
}