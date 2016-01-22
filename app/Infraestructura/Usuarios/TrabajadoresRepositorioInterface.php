<?php
namespace Sise\Infraestructura\Usuarios;

use Sise\Dominio\Usuarios\Trabajador;

/**
 * interface que define comportamiento para repositorios
 * de trabajadores
 * @author Gerardo Adrián Gómez Ruiz
 */
interface TrabajadoresRepositorioInterface
{
	/**
	 * obtener un trabajador por su username
	 * @param  string     $username
	 * @return Trabajador $trabajador
	 */
	public function obtenerTrabajadorPorUsername($username);

	/**
	 * obtener un trabajador por su id
	 * @param  int        $idTrabajador
	 * @return Trabajador $trabajador
	 */
	public function obtenerTrabajadorPorId($idTrabajador);

	/**
	 * obtener una lista de usuarios dependiendo un parametro
	 * @param  string $parametro
	 * @return array
	 */
	public function obtenerTrabajadores($parametro = '');

	/**
	 * guardar o editar trabajador
	 * @param  Trabajador $trabajador
	 * @return bool
	 */
	public function persistir(Trabajador $trabajador);

	/**
	 * actualizar la contraseña del trabajador
	 * @param  Trabajador $trabajador
	 * @return bool
	 */
	public function actualizarPassword(Trabajador $trabajador);

	/**
	 * @param Trabajador $trabajador
	 * @return bool
	 */
	public function modificarActivo(Trabajador $trabajador);
}