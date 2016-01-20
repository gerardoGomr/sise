<?php
namespace Sise\Dominio\Evaluaciones;

use Excel;
use Sise\Infraestructura\Evaluaciones\ElementosRepositorioLaravelSQLServer;

/**
 * Class LectorAnexos
 * @package Sise\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class LectorAnexos extends Excel
{
	/**
	 * AnexoI enviado por una dependencia
	 * @var AnexoI
	 */
	protected $anexoI;

	public function __construct(AnexoI $anexoI)
	{
		$this->anexoI = $anexoI;
	}

	/**
	 * crear un nuevo anexo
	 * @param  string $ruta
	 * @return void
	 */
	public function crear($ruta)
	{
		Excel::load($ruta, function($lector) {

			// total de filas del excel
			$ultimaFila = $lector->getSheet(1)->getHighestRow();

			for($fila = 1; $fila < $ultimaFila; $fila++) {

				// datos de la fila actual
				$datos           = $lector->getSheet(0)->rangeToArray("A$fila:O$fila", null, true, false);
				$celdasVacias    = 0;
				$totalCeldas     = count($datos);

				// recorrer datos de fila actual para verificar que no sea una fila vacía
				foreach ($datos[0] as $indiceColumna => $valor) {

					if(empty($valor)) {
						$celdasVacias++;
					}
				}

				// si no es fila vacía, obtener los datos y construir un nuevo elemento del anexo
				if($celdasVacias = $totalCeldas) {
					break;
				}

				// obtener valores de celdas
				$nombre            = $datos[0][1];
				$puesto            = $datos[0][2];
				$categoriaPuesto   = $datos[0][3];
				$funcionGeneral    = $datos[0][4];
				$funcionEspecifica = $datos[0][5];
				$criticidadPuesto  = $datos[0][6];
				$dependencia       = $datos[0][7];
				$adscripcion       = $datos[0][8];
				$cuip              = $datos[0][9];
				$curp              = $datos[0][10];
				$escolaridad       = $datos[0][11];
				$evaluacionTipo    = $datos[0][12];
				$fechaIngreso      = $datos[0][3];

				$elementoAnexo = new ElementoAnexo($nombre, '', '', $puesto, $categoriaPuesto, $funcionGeneral, $funcionEspecifica, $criticidadPuesto, $dependencia, $adscripcion, $cuip, $curp, $escolaridad, $evaluacionTipo, $fechaIngreso);

				// verificar que el elemento exista
				$elementosRepositorio = new ElementosRepositorioLaravelSQLServer();
				$elementosRepositorio->comprobarElemento($elementoAnexo);

				// comprobar existencia
				if($elementoAnexo->existe() === true) {

					// no es evaluación de nuevo ingreso
					if($elementoAnexo->getEvaluacionAnterior()->getResultadoIntegral() === 'No Aprobado') {

						// no es apto
						$elementoAnexo->setApto(false);
					}

				}

				// agregar al anexo I un nuevo elemento
				$this->anexoI->agregarElemento($elementoAnexo);
			}
		});
	}
}