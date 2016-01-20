<?php
namespace Sise\Infraestructura\Usuarios;

use DB;
use Sise\Dominio\Usuarios\Trabajador;
use Sise\Servicios\Usuarios\TrabajadoresFactory;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class TrabajadoresRepositorioLaravelSQLServer implements TrabajadoresRepositorioInterface
{
	/**
	 * obtener un usuario por su username
	 * @param  string $username
	 * @return Usuario $trabajador
	 */
	public function obtenerTrabajadorPorUsername($username)
	{
		try {

			$trabajadores = DB::table('trabajador')
				->join('area_trabajo', 'area_trabajo.idArea', '=', 'trabajador.idArea')
				->join('puesto', 'puesto.idPuesto', '=', 'trabajador.idPuesto')
				->leftJoin('usuario', 'usuario.idTrabajador', '=', 'trabajador.idTrabajador')
				->select('trabajador.*', 'usuario.Username', 'usuario.Passwd', 'usuario.Activo', 'area_trabajo.*', 'puesto.*')
				->where('usuario.Username', $username)
				->first();

			$totalUsuario = count($trabajadores);

			if($totalUsuario === 0) {
				return null;
			}

			// devolver un trabajador
			return TrabajadoresFactory::crearTrabajador($trabajadores);

		} catch (\PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener un trabajador por su id
	 * @param  int        $idTrabajador
	 * @return Trabajador $trabajador
	 */
	public function obtenerTrabajadorPorId($idTrabajador)
	{
		try {
			$trabajadores = DB::table('trabajador')
				->join('area_trabajo', 'area_trabajo.idArea', '=', 'trabajador.idArea')
				->join('puesto', 'puesto.idPuesto', '=', 'trabajador.idPuesto')
				->leftJoin('usuario', 'usuario.idTrabajador', '=', 'trabajador.idTrabajador')
				->select('trabajador.*', 'usuario.Username', 'usuario.Passwd', 'usuario.Activo', 'area_trabajo.*', 'puesto.*')
				->where('trabajador.idTrabajador', $idTrabajador)
				->first();

			$totalUsuario = count($trabajadores);

			if($totalUsuario === 0) {
				return null;
			}

			// devolver un trabajador
			return TrabajadoresFactory::crearTrabajador($trabajadores);

		} catch (\PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener una lista de usuarios dependiendo un parametro
	 * @param  string $parametro
	 * @return array
	 */
	public function obtenerTrabajadores($parametro = '')
	{
		$listaTrabajadores = array();
		$parametro = str_replace(' ', '', $parametro);

		try {
			$trabajadores = DB::table('trabajador')
				->join('area_trabajo', 'area_trabajo.idArea', '=', 'trabajador.idArea')
				->join('puesto', 'puesto.idPuesto', '=', 'trabajador.idPuesto')
				->leftJoin('usuario', 'usuario.idTrabajador', '=', 'trabajador.idTrabajador')
				->select('trabajador.*', 'usuario.Username', 'usuario.Passwd', 'usuario.Activo', 'area_trabajo.*', 'puesto.*')
				->where(DB::Raw("REPLACE(CONCAT(trabajador.Nombre, trabajador.Paterno, trabajador.Materno), ' ', '')"), 'LIKE', "%$parametro%")
				->orWhere(DB::Raw("REPLACE(CONCAT(trabajador.Paterno, trabajador.Materno, trabajador.Nombre), ' ', '')"), 'LIKE', "%$parametro%")
				->orderBy('trabajador.Nombre')
				->get();

			$totalUsuario = count($trabajadores);

			if($totalUsuario === 0) {

				return null;
			}

			foreach ($trabajadores as $trabajadores) {
				// crear trabajadores
				$listaTrabajadores[] = TrabajadoresFactory::crearTrabajador($trabajadores);
			}

			return $listaTrabajadores;

		} catch (\PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * guardar o editar usuario
	 * @param  Trabajador $trabajador
	 * @return bool
	 */
	public function persistir(Trabajador $trabajador)
	{
		if(!is_null($trabajador->getId())) {
			// editar
			try {

				DB::table('trabajador')
					->where('idTrabajador', $trabajador->getId())
					->update([
						'Nombre'        => $trabajador->getNombre(),
						'Paterno'       => $trabajador->getPaterno(),
						'Materno'       => $trabajador->getMaterno(),
						'Celular'       => $trabajador->getCelular(),
						'Email'         => $trabajador->getEmail(),
						'idArea'        => $trabajador->getArea()->numero(),
						'idPuesto'      => $trabajador->getPuesto()->getId(),
						'FechaModificacion' => DB::raw('GETDATE()')
					]);

					if($trabajador->tieneCuenta()) {
						// generar usuario y contraseña
						$this->persistirUsuario($trabajador);
					}

					return true;

			} catch (\Exception $e) {
				return false;
			}
		}

		// insertar
		try {

			$idTrabajador = DB::table('trabajador')
				->insertGetId([
					'Nombre'        => $trabajador->getNombre(),
					'Paterno'       => $trabajador->getPaterno(),
					'Materno'       => $trabajador->getMaterno(),
					'Celular'       => $trabajador->getCelular(),
					'Email'         => $trabajador->getEmail(),
					'idArea'        => $trabajador->getArea()->numero(),
					'idPuesto'      => $trabajador->getPuesto()->getId(),
					'FechaCreacion' => DB::raw('GETDATE()')
				]);

			// id del trabajador insertado
			$trabajador->setId($idTrabajador);

			if($trabajador->tieneCuenta()) {
				// generar usuario y contraseña
				$this->persistirUsuario($trabajador);
			}

			return true;

		} catch (\PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * guardar username y password del trabajador
	 * @param  Trabajador $trabajador
	 * @return bool
	 */
	private function persistirUsuario(Trabajador $trabajador)
	{
		try {

			// generar usuario y contraseña
			DB::table('usuario')
				->insert([
					'idTrabajador'  => $trabajador->getId(),
					'Username'      => $trabajador->getUsuario()->getUsername(),
					'Passwd'        => $trabajador->getUsuario()->getPasswd(),
					'Activo'        => $trabajador->getUsuario()->activo() === true ? 1 : 0,
					'FechaCreacion' => DB::raw('GETDATE()')
				]);

			return true;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * actualizar la contraseña del trabajador
	 * @param  Trabajador $trabajador
	 * @return bool
	 */
	public function actualizarPassword(Trabajador $trabajador)
	{
		try {

			// generar usuario y contraseña
			DB::table('usuario')
				->where('idTrabajador', $trabajador->getId())
				->update([
					'Passwd'        	=> $trabajador->getUsuario()->getPasswd(),
					'FechaModificacion' => DB::raw('GETDATE()')
				]);

			return true;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function modificarActivo(Trabajador $trabajador)
	{
		try {

			// generar usuario y contraseña
			DB::table('usuario')
				->where('idTrabajador', $trabajador->getId())
				->update([
					'Activo'        	=> $trabajador->getUsuario()->activo() === true ? 1 : 0,
					'FechaModificacion' => DB::raw('GETDATE()')
				]);

			return true;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
}