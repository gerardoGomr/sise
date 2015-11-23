<?php
namespace Sise\Usuarios;

class UsuariosVistasFactory
{
	/**
	 * obtener la vista a mostrar al usuario
	 * @param int $departamento
	 */
	public static function obtenerVista(Area $area)
	{
		$view = '';
		switch ($area->numero()) {
			case 1:
				$view = 'custodia';
				break;

			case 2:
				$view = 'socioeconomicos';
				break;

			case 3:
				$view = 'psicologia';
				break;

			case 4:
				$view = 'poligrafia';
				break;

			case 5:
				$view = 'medicoTox';
				break;

			case 12:
				$view = 'rHumanos';
				break;

			default:
				throw new \Exception('Área no reconocida');
				break;
		}

		return $view;
	}
}