<?php
namespace Sise\Dependencias;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
interface DependenciasRepositorioInterface
{
	/**
	 * obtener la lista de dependencias del repositorio
	 * @param  string $filtro
	 * @return array
	 */
	public function obtenerDependencias($filtro = '');

	/**
	 * obtener una única dependencia
	 * @param  int   $idDependencia
	 * @return array
	 */
	public function obtenerDependenciaPorId($idDependencia);
}