<?php
namespace Sise\Dependencias;

use DB;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class DependenciasRepositorioLaravelSQLServer implements DependenciasRepositorioInterface
{
	/**
	 * obtener la lista de dependencias del repositorio
	 * @param  string $filtro
	 * @return array
	 */
	public function obtenerDependencias($filtro = '')
	{
		$listaDependencias = array();

		try {

			$dependencias = DB::connection('merk_ceccc')
				->table('dependencia')
				->select('dependencia.*', 'estado_municipios.idMunicipio', 'estado_municipios.Municipio')
				->join('estado_municipios', 'estado_municipios.idMunicipio', '=', 'dependencia.idMunicipio')
				->whereNotNull('dependencia.idDependencia');

			// var_dump(strlen($filtro));exit;

			if(strlen($filtro) > 0) {

				$filtro = str_replace(' ', '', $filtro);

				$dependencias->where(function($query) use ($filtro){
					$query->orWhereRaw("REPLACE(dependencia.Clave, ' ', '') LIKE '%" . $filtro. "%'")
					->orWhereRaw("REPLACE(dependencia.Dependencia, ' ', '') LIKE '%" . $filtro . "%'")
					->orWhereRaw("REPLACE(estado_municipios.Municipio, ' ', '') LIKE '%" . $filtro . "%'");
				});
			}

			$dependencias->orderBy('dependencia.Dependencia');
			$dependencias = $dependencias->get();

			$totalDependencias = count($dependencias);//echo $totalDependencias;exit;

			if($totalDependencias > 0) {

				foreach ($dependencias as $dependencias) {

					$listaDependencias[] = $this->cargarDependencia($dependencias);
				}

				return $listaDependencias;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener una única dependencia
	 * @param  int 	 $idDepedencia
	 * @return array
	 */
	public function obtenerDependenciaPorId($idDependencia)
	{
		try {

			$dependencias = DB::connection('merk_ceccc')
				->table('dependencia')
				->select('dependencia.*', 'estado_municipios.idMunicipio', 'estado_municipios.Municipio')
				->join('estado_municipios', 'estado_municipios.idMunicipio', '=', 'dependencia.idMunicipio')
				->where('dependencia.idDependencia', $idDependencia)
				->first();

			$totalDependencias = count($dependencias);//echo $totalDependencias;exit;

			if($totalDependencias > 0) {

				$dependencia = $this->cargarDependencia($dependencias);

				$padron = DB::connection('merk_ceccc')
					->table('padron')
					->join('estado_municipios', 'estado_municipios.idMunicipio', '=', 'padron.idMunicipio')
					->where('padron.idDependencia', $idDependencia)
					->get();

				$totalPadron = count($padron);

				if($totalPadron > 0) {

					foreach ($padron as $padron) {

						$dependencia['Padron'][] = $this->cargarPadronDependencia($padron);
					}
				}


				return $dependencia;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * cargar una depedencia
	 * @param  PDO $dependencias
	 * @return array
	 */
	private function cargarDependencia($dependencias)
	{
		return array(
			'idDependencia' => $dependencias->idDependencia,
			'Clave'			=> $dependencias->Clave,
			'Dependencia'   => $dependencias->Dependencia,
			'idMunicipio'   => $dependencias->idMunicipio,
			'Municipio'	    => $dependencias->Municipio,
			'Correo' 	    => $dependencias->Correo,
			'TelContacto'	=> $dependencias->TelContacto,
			'Calle'			=> $dependencias->Calle,
			'NumExt'		=> $dependencias->NumExt,
			'NumInt'		=> $dependencias->NumInt
		);
	}

	private function cargarPadronDependencia($padron)
	{
		return array(
			'idPadron'         => $padron->idPadron,
			'Nombre'           => $padron->Paterno.' '.$padron->Materno.' '.$padron->Nombre,
			'Sexo'             => $padron->Sexo,
			'FechaNacimiento'  => $padron->FechaNacimiento,
			'idMunicipio'      => $padron->idMunicipio,
			'Municipio'        => $padron->Municipio,
			'CURP'             => $padron->CURP,
			'CUIP'             => $padron->CUIP,
			'idDependencia'    => $padron->idDependencia,
			'UltimaEvaluacion' => $padron->UltimaEvaluacion,
			'idStatus'         => $padron->idStatus
		);
	}
}