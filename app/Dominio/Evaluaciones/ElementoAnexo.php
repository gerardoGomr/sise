<?php
namespace Sise\Dominio\Evaluaciones;

/**
 * Class ElementoAnexo
 * @package Sise\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ElementoAnexo extends Elemento
{
	/**
	 * evaluación que se solicita realizar
	 * @var EvaluacionTipo
	 */
	protected $evaluacionTipoSolicitada;

	/**
	 * evaluación anterior realizada
	 * @var Evaluación
	 */
	protected $evaluacionAnterior;

	/**
	 * puesto de elemento
	 * @var string
	 */
	protected $puesto;

	/**
	 * categoria del puesto
	 * @var string
	 */
	protected $categoriaPuesto;

	/**
	 * función general
	 * @var string
	 */
	protected $funcionGeneral;

	/**
	 * función específica
	 * @var string
	 */
	protected $funcionEspecifica;

	/**
	 * grado de criticidad del puesto
	 * @var string
	 */
	protected $criticidadPuesto;

	/**
	 * dependencia del elemento
	 * @var Dependencia
	 */
	protected $dependencia;

	/**
	 * adscripción del elemento
	 * @var string
	 */
	protected $adscripcion;

	/**
	 * fecha de ingreso a la dependencia
	 * @var string
	 */
	protected $fechaIngreso;

	/**
	 * @param string $nombre
	 * @param string $paterno
	 * @param string $materno
	 * @param string $puesto
	 * @param string $categoriaPuesto
	 * @param string $funcionGeneral
	 * @param string $funcionEspecifica
	 * @param string $criticidadPuesto
	 * @param string $dependencia
	 * @param string $adscripcion
	 * @param string $cuip
	 * @param string $curp
	 * @param string $escolaridad
	 * @param string $evaluacionTipoSolicitada
	 * @param string $fechaIngreso
	 */
	public function __construct($nombre = '', $paterno = '', $materno = '', $puesto = '', $categoriaPuesto = '', $funcionGeneral = '', $funcionEspecifica, $criticidadPuesto = '', $dependencia = null, $adscripcion = '', $cuip = '', $curp = '', $escolaridad = null, $evaluacionTipoSolicitada = null, $fechaIngreso = '')
	{
		parent::__construct($nombre, $paterno, $materno, $curp, '');

		$this->puesto                   = $puesto;
		$this->categoriaPuesto          = $categoriaPuesto;
		$this->funcionGeneral           = $funcionGeneral;
		$this->funcionEspecifica        = $funcionEspecifica;
		$this->criticidadPuesto         = $criticidadPuesto;
		$this->dependencia              = $dependencia;
		$this->adscripcion              = $adscripcion;
		$this->cuip                     = $cuip;
		$this->escolaridad              = $escolaridad;
		$this->evaluacionTipoSolicitada = $evaluacionTipoSolicitada;
		$this->fechaIngreso             = $fechaIngreso;
		$this->apto 					= true;
	}

    /**
     * Gets the evaluación que se solicita realizar.
     * @return EvaluacionTipo
     */
    public function getEvaluacionTipoSolicitada()
    {
        return $this->evaluacionTipoSolicitada;
    }

    /**
     * Sets the evaluación que se solicita realizar
     * @param EvaluacionTipo $evaluacionTipoSolicitada the evaluacion tipo solicitada
     */
    public function setEvaluacionTipoSolicitada(EvaluacionTipo $evaluacionTipoSolicitada)
    {
        $this->evaluacionTipoSolicitada = $evaluacionTipoSolicitada;
    }

	/**
	 * obtener evaluacion anterior
	 * @return Evaluación
	 */
    public function getEvaluacionAnterior()
    {
    	return $this->evaluacionAnterior;
    }

	/**
	 * setear evaluacion anterior
	 * @param Evaluacion $evaluacionAnterior
	 */
	public function setEvaluacionAnterior(Evaluacion $evaluacionAnterior)
	{
		$this->evaluacionAnterior = $evaluacionAnterior;
	}

    public function setApto($apto)
    {
    	$this->apto = $apto;
    }

    /**
     * indica si el elemento es apto para la evaluación solicitada si la evaluación anterior no tiene un resultado integral NA
     * @return bool
     */
    public function apto()
    {
    	if($this->evaluacionAnterior->resultadoIntegral() !== 'NA') {
    		return true;
    	}

    	return false;
    }
}