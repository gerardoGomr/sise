<?php
namespace Sise\Usuarios;

use DB;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class AreasRepositorioLaravelSQLServer implements AreasRepositorioInterface
{
	/**
	 * obtener una lista de areas
	 * @return array
	 */
	public function obtenerAreas()
	{
		$listaAreas = array();

		try {

			$areas = DB::table('area_trabajo')
				->get();

			$totalAreas = count($areas);

			if($totalAreas === 0) {
				return null;
			}

			foreach ($areas as $areas) {

				$listaAreas[] = new Area($areas->idArea, $areas->NombreArea);
			}

			return $listaAreas;

		} catch(\PDOException $e) {
			return null;
		}
	}

	/**
	 * obtener una área por el id
	 * @param  int    $id
	 * @return Area
	 */
	public function obtenerAreaPorId($id)
	{
		try {

			$areas = DB::table('area_trabajo')
				->where('idArea', $id)
				->first();

			$totalAreas = count($areas);

			if($totalAreas === 0) {
				return null;
			}

			return new Area($areas->idArea, $areas->NombreArea);

		} catch(\PDOException $e) {
			return null;
		}
	}
}