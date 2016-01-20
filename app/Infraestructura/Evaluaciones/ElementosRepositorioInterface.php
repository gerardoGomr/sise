<?php
namespace Sise\Infraestructura\Evaluaciones;

use Sise\Dominio\Evaluaciones\Elemento;

interface ElementosRepositorioInterface
{
	/**
	 * comprobar la existencia del elemento en la base de datos
	 * @param  Elemento $elemento
	 * @return bool
	 */
	public function comprobarExistenciaElemento(Elemento $elemento);
}