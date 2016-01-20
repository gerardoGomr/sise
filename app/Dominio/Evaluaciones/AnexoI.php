<?php
namespace Sise\Dominio\Evaluaciones;

use Sise\Dominio\Dependencias\Dependencia;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class AnexoI
{
	/**
	 * lista de elementos a evaluar
	 * @var array
	 */
	private $listaElementos;

	/**
	 * dependencia solicitante
	 * @var Dependencia
	 */
	private $dependencia;

	/**
	 * fecha en la que la dependencia envía el anexo
	 * @var string
	 */
	private $fechaEnvio;

	/**
	 * oficio que soporta a los evaluados aptos
	 * @var Oficio
	 */
	private $oficio;

	/**
	 * indica si se macheó o no a los evaluados
	 * @var bool
	 */
	private $macheado;

	public function __construct(Dependencia $dependencia = null, $fechaEnvio = null)
	{
		$this->dependencia    = $dependencia;
		$this->fechaEnvio     = $fechaEnvio;
	}

	/**
	 * añadir nuevo elemento al anexo
	 * @param  ElementoAnexo $elemento
	 * @return void
	 */
	public function agregarElemento(ElementoAnexo $elemento)
	{
		$this->listaElementos[] = $elemento;
	}

	public function seHaMacheado()
	{
		return $this->macheado;
	}
}