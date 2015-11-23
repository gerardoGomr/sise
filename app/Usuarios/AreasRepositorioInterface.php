<?php
namespace Sise\Usuarios;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
interface AreasRepositorioInterface
{
	/**
	 * obtener una lista de areas
	 * @return array
	 */
	public function obtenerAreas();

	/**
	 * obtener una área por el id
	 * @param  int    $id
	 * @return Area
	 */
	public function obtenerAreaPorId($id);
}