<?php
namespace Sise\Servicios\Usuarios;

use Sise\Dominio\Usuarios\FotografiaTrabajador;

/**
 * Class FactoryFotografias
 * @package Sise\Servicios\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class FactoryFotografias
{
	public static function crearFotografia(array $files = null, $ruta = '')
	{
		if(!is_null($files)) {

			return new FotografiaTrabajador($files['tmp_name'], true, $files);
		}

		return new FotografiaTrabajador($ruta);
	}
}