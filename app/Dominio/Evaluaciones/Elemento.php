<?php
namespace Sise\Dominio\Evaluaciones;

use Sise\Dominio\Personas\Persona;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class Elemento extends Persona
{
	/**
	 * idElemento
	 * @var int
	 */
	protected $idElemento;

	/**
	 * CURP
	 * @var string
	 */
	protected $curp;

	/**
	 * CUIP
	 * @var string
	 */
	protected $cuip;

	/**
	 * fecha de nacimiento
	 * @var string
	 */
	protected $fechaNacimiento;

	/**
	 * escolaridad
	 * @var Escolaridad
	 */
	protected $escolaridad;

	/**
	 * RFC
	 * @var string
	 */
	protected $rfc;

	/**
	 * homoclave
	 * @var string
	 */
	protected $homoclave;

	/**
	 * está o no validada la curp
	 * @var bool
	 */
	protected $curpValida;

    /**
     * indica si el elemento existe en los registros del C3
     * @var bool
     */
    protected $existe;

	/**
	 * constructor
	 * @param string $nombre
	 * @param string $paterno
	 * @param string $materno
	 * @param string $curp
	 * @param string $rfc
	 */
	public function __construct($nombre = '', $paterno = '', $materno = '', $curp = '', $rfc = '')
	{
		$this->curp = $curp;
		$this->rfc  = $rfc;

		parent::__construct($nombre, $paterno, $materno);
	}

    /**
     * Gets the CURP.
     *
     * @return string
     */
    public function getCurp()
    {
        return $this->curp;
    }

    /**
     * @param $curp
     * @throws \Exception
     */
    public function setCurp($curp)
    {
    	$longitud = strlen($curp);

    	if($longitud !== 18) {
    		throw new \Exception('La longitud de la CURP no es la adecuada');
    	}

    	// convertir a mayúsculas
    	$curp = strtoupper($curp);

        $this->curp = $curp;
    }

    /**
     * Gets the CUIP.
     *
     * @return string
     */
    public function getCuip()
    {
        return $this->cuip;
    }

    /**
     * Sets the CUIP.
     *
     * @param string $cuip the cuip
     */
    public function setCuip($cuip)
    {
        $this->cuip = $cuip;
    }

    /**
     * Gets the fecha de nacimiento.
     *
     * @return string
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Sets the fecha de nacimiento.
     *
     * @param string $fechaNacimiento the fecha nacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * Gets the escolaridad.
     *
     * @return Escolaridad
     */
    public function getEscolaridad()
    {
        return $this->escolaridad;
    }

    /**
     * Sets the escolaridad.
     *
     * @param Escolaridad $escolaridad the escolaridad
     */
    public function setEscolaridad(Escolaridad $escolaridad)
    {
        $this->escolaridad = $escolaridad;
    }

    /**
     * Gets the RFC.
     *
     * @return string
     */
    public function getRfc()
    {
        return $this->rfc;
    }

    /**
     * Sets the RFC.
     *
     * @param string $rfc the rfc
     */
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;
    }

    /**
     * Gets the homoclave.
     *
     * @return string
     */
    public function getHomoclave()
    {
        return $this->homoclave;
    }

    /**
     * Sets the homoclave.
     *
     * @param string $homoclave the homoclave
     */
    public function setHomoclave($homoclave)
    {
        $this->homoclave = $homoclave;
    }

    /**
     * verificar si tiene curp valida
     * @return bool
     */
 	public function tieneCurpValida()
 	{
 		return $this->curpValida;
 	}

    /**
     * Gets the idElemento.
     *
     * @return int
     */
    public function getIdElemento()
    {
        return $this->idElemento;
    }

    /**
     * Sets the idElemento.
     *
     * @param int $idElemento the id elemento
     *
     * @return self
     */
    public function setIdElemento($idElemento)
    {
        $this->idElemento = $idElemento;

        return $this;
    }

    /**
     * Sets the está o no validada la curp.
     *
     * @param bool $curpValida the curp valida
     */
    public function setCurpValida($curpValida)
    {
        $this->curpValida = $curpValida;
    }

    /**
     * Devuelve el valor de la bandera existe
     * @return bool
     */
    public function existe()
    {
        return $this->existe;
    }

    /**
     * setear bandera
     * @param bool $existe
     */
    public function setExiste($existe)
    {
        $this->existe = $existe;
    }

    /**
     * retorna el nombre completo del elemento
     * @return string
     */
    public function getNombreCompleto()
    {
        $nombre = $this->nombre;
        if(strlen($this->paterno) > 0) {
            $nombre .= ' '.$this->paterno;
        }

        if(strlen($this->materno) > 0) {
            $nombre .= ' '.$this->materno;
        }

        return $nombre;
    }
}