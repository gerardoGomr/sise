<?php
namespace Sise\Usuarios;

/**
* 
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