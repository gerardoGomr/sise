<?php
namespace Sise\Usuarios;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
interface PuestosRepositorioInterface
{
	/**
	 * obtener una lista de puestos
	 * @return array
	 */
	public function obtenerPuestos();

	/**
	 * obtener un puesto por su id
	 * @param  int $id
	 * @return Puesto
	 */
	public function obtenerPuestoPorId($id);
}