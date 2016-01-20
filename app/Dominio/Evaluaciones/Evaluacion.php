<?php
namespace Sise\Dominio\Evaluaciones;

use Sise\Dominio\Dependencias\Dependencia;
use Sise\Dominio\Usuarios\Puesto;

/**
 * Class Evaluacion
 * @package Sise\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Evaluacion
{
	/**
	 * id
	 * @var int
	 */
	protected $id;

	/**
	 * Dependencia
	 * @var Dependencia
	 */
	protected $dependencia;

	/**
	 * Puesto
	 * @var Puesto
	 */
	protected $puesto;

	/**
	 * mando
	 * @var string
	 */
	protected $mando;

	/**
	 * rango
	 * @var string
	 */
	protected $rango;

	/**
	 * especialidad
	 * @var string
	 */
	protected $especialidad;

	/**
	 * fotografía de evaluado
	 * @var Fotografia
	 */
	protected $fotografia;

    /**
     * resultado integral de evaluación
     * @var ResultadoIntegral
     */
    protected $resultadoIntegral;

    /**
     * Evaluacion constructor.
     * @param null $id
     */
	public function __construct($id = null)
	{
        $this->id = $id;
	}

    /**
     * Gets the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id.
     *
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the Dependencia.
     *
     * @return Dependencia
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Sets the Dependencia.
     *
     * @param Dependencia $dependencia the dependencia
     */
    public function setDependencia(Dependencia $dependencia)
    {
        $this->dependencia = $dependencia;
    }

    /**
     * Gets the Puesto.
     *
     * @return Puesto
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Sets the Puesto.
     *
     * @param Puesto $puesto the puesto
     */
    public function setPuesto(Puesto $puesto)
    {
        $this->puesto = $puesto;
    }

    /**
     * Gets the mando.
     *
     * @return string
     */
    public function getMando()
    {
        return $this->mando;
    }

    /**
     * Sets the mando.
     *
     * @param string $mando the mando
     */
    public function setMando($mando)
    {
        $this->mando = $mando;
    }

    /**
     * Gets the rango.
     *
     * @return string
     */
    public function getRango()
    {
        return $this->rango;
    }

    /**
     * Sets the rango.
     *
     * @param string $rango the rango
     */
    public function setRango($rango)
    {
        $this->rango = $rango;
    }

    /**
     * Gets the especialidad.
     *
     * @return string
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Sets the especialidad.
     *
     * @param string $especialidad the especialidad
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;
    }

    /**
     * Gets the fotografía de evaluado.
     *
     * @return Fotografia
     */
    public function getFotografia()
    {
        return $this->fotografia;
    }

    /**
     * Sets the fotografía de evaluado.
     *
     * @param Fotografia $fotografia the fotografia
     */
    public function setFotografia(Fotografia $fotografia)
    {
        $this->fotografia = $fotografia;
    }

    /**
     * @return ResultadoIntegral
     */
    public function getResultadoIntegral()
    {
        return $this->resultadoIntegral;
    }

    /**
     * @param ResultadoIntegral $resultadoIntegral
     */
    public function setResultadoIntegral(ResultadoIntegral $resultadoIntegral)
    {
        $this->resultadoIntegral = $resultadoIntegral;
    }
}