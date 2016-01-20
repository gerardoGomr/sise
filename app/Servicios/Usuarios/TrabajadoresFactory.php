<?php
namespace Sise\Servicios\Usuarios;

use Sise\Dominio\Usuarios\Area;
use Sise\Dominio\Usuarios\FotografiaTrabajador;
use Sise\Dominio\Usuarios\Puesto;
use Sise\Dominio\Usuarios\Trabajador;
use Sise\Dominio\Usuarios\UsuarioSise;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class TrabajadoresFactory
{
	/**
	 * crear un trabajador
	 * @param  SQL 		  $trabajadores
	 * @return Trabajador
	 */
	public static function crearTrabajador($trabajadores)
	{
		$trabajador = new Trabajador($trabajadores->Nombre, $trabajadores->Paterno, $trabajadores->Materno);
		$trabajador->setId($trabajadores->idTrabajador);

		// username
		if(!is_null($trabajadores->Username)) {
			$trabajador->setUsuario(new UsuarioSise($trabajadores->Username, $trabajadores->Passwd));
			$trabajador->getUsuario()->setActivo($trabajadores->Activo);
			$trabajador->getUsuario()->setActivo($trabajadores->Activo);
		}

		// foto
		if(file_exists('public/usuariosFotografias/'.$trabajador->getId().'.jpg')) {
			$trabajador->setFotografia(new FotografiaTrabajador('public/usuariosFotografias/'.$trabajador->getId().'.jpg'));
		}

		$trabajador->setArea(new Area($trabajadores->idArea, $trabajadores->NombreArea));
		$trabajador->setPuesto(new Puesto($trabajadores->idPuesto, $trabajadores->NombrePuesto));
		$trabajador->setCelular($trabajadores->Celular);
		$trabajador->setEmail($trabajadores->Email.'@ceccc.gob.mx');
		$trabajador->tieneCuenta(true);

		return $trabajador;
	}
}