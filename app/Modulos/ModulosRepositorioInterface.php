<?php
namespace Sise\Modulos;

use Sise\Usuarios\Puesto;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
interface ModulosRepositorioInterface
{
	/**
	 * obtener la lista de modulos superiores
	 * ParentId = 0
	 * @return array
	 */
	public function obtenerModulosSuperiores();

	/**
	 * obtener la lista de modulos por Id del padre
	 * ParentId != 0
	 * @param  int 	 $id
	 * @return array
	 */
	public function obtenerModulosPorIdPadre($id);

	/**
	 * obtener la lista de modulos disponibles por puesto
	 * @param  Puesto $puesto
	 * @return array
	 */
	public function obtenerModulosPorPuesto(Puesto $puesto);
}