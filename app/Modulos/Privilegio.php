<?php
namespace Sise;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class Privilegio
{
	/**
	 * el valor del privilegio
	 * @var int
	 */
	private $valor;

	const VER      = 1;
	const AGREGAR  = 2;
	const EDITAR   = 3;
	const ELIMINAR = 4;
	const IMPRIMIR = 5;

	public function __construct($valor)
	{
		$this->valor = $valor;
	}

	/**
	 * setear el valor del privilegio
	 * @param int $valor
	 */
	public function setValor($valor)
	{
		$this->valor = $valor;
	}

	/**
	 * ver el valor del privilegio actual
	 * @return int
	 */
	public function verPrivilegio()
	{
		return $this->valor;
	}
}