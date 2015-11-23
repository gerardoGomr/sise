<?php
namespace Sise\Modulos;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class ModuloSise extends Modulo
{
	public function __construct($nombre, array $privilegios = null)
	{
		parent::__construct($nombre, $privilegios);
	}
}