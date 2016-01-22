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
     * @var Elemento
     */
    protected $elemento;

    /**
     * @var int
     */
    protected $numeroEvaluacion;

    /**
     * @var bool
     */
    protected $entregaMedicoToxicologica;

    /**
     * @var bool
     */
    protected $entregaPsicologia;

    /**
     * @var bool
     */
    protected $entregaSocioeconomicos;

    /**
     * @var bool
     */
    protected $entregaPoligrafia;

    /**
     * @var bool
     */
    protected $entregaFichaIngreso;

    /**
     * @var bool
     */
    protected $entregaResultadoIntegral;

    /**
     * @var Serial
     */
    protected $serialMedico;

    /**
     * @var Serial
     */
    protected $serial;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id.
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the Dependencia.
     * @return Dependencia
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Sets the Dependencia.
     * @param Dependencia $dependencia the dependencia
     */
    public function setDependencia(Dependencia $dependencia)
    {
        $this->dependencia = $dependencia;
    }

    /**
     * Gets the Puesto.
     * @return Puesto
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Sets the Puesto.
     * @param Puesto $puesto the puesto
     */
    public function setPuesto(Puesto $puesto)
    {
        $this->puesto = $puesto;
    }

    /**
     * Gets the mando.
     * @return string
     */
    public function getMando()
    {
        return $this->mando;
    }

    /**
     * Sets the mando.
     * @param string $mando the mando
     */
    public function setMando($mando)
    {
        $this->mando = $mando;
    }

    /**
     * Gets the rango.
     * @return string
     */
    public function getRango()
    {
        return $this->rango;
    }

    /**
     * Sets the rango.
     * @param string $rango the rango
     */
    public function setRango($rango)
    {
        $this->rango = $rango;
    }

    /**
     * Gets the especialidad.
     * @return string
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Sets the especialidad.
     * @param string $especialidad the especialidad
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;
    }

    /**
     * Gets the fotografía de evaluado.
     * @return Fotografia
     */
    public function getFotografia()
    {
        return $this->fotografia;
    }

    /**
     * Sets the fotografía de evaluado.
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

    /**
     * @return Elemento
     */
    public function getElemento()
    {
        return $this->elemento;
    }

    /**
     * @param Elemento $elemento
     */
    public function setElemento(Elemento $elemento)
    {
        $this->elemento = $elemento;
    }

    /**
     * @return int
     */
    public function getNumeroEvaluacion()
    {
        return $this->numeroEvaluacion;
    }

    /**
     * @param int $numeroEvaluacion
     */
    public function setNumeroEvaluacion($numeroEvaluacion)
    {
        $this->numeroEvaluacion = $numeroEvaluacion;
    }

    /**
     * @return boolean
     */
    public function entregoMedico()
    {
        return $this->entregaMedicoToxicologica;
    }

    /**
     * @param boolean $entregaMedicoToxicologica
     */
    public function setEntregaMedicoToxicologica($entregaMedicoToxicologica)
    {
        $this->entregaMedicoToxicologica = $entregaMedicoToxicologica;
    }

    /**
     * @return boolean
     */
    public function entregoPsicologia()
    {
        return $this->entregaPsicologia;
    }

    /**
     * @param boolean $entregaPsicologia
     */
    public function setEntregaPsicologia($entregaPsicologia)
    {
        $this->entregaPsicologia = $entregaPsicologia;
    }

    /**
     * @return boolean
     */
    public function entregoSocioeconomicos()
    {
        return $this->entregaSocioeconomicos;
    }

    /**
     * @param boolean $entregaSocioeconomicos
     */
    public function setEntregaSocioeconomicos($entregaSocioeconomicos)
    {
        $this->entregaSocioeconomicos = $entregaSocioeconomicos;
    }

    /**
     * @return boolean
     */
    public function entregoPoligrafia()
    {
        return $this->entregaPoligrafia;
    }

    /**
     * @param boolean $entregaPoligrafia
     */
    public function setEntregaPoligrafia($entregaPoligrafia)
    {
        $this->entregaPoligrafia = $entregaPoligrafia;
    }

    /**
     * @return boolean
     */
    public function entregoFichaIngreso()
    {
        return $this->entregaFichaIngreso;
    }

    /**
     * @param boolean $entregaFichaIngreso
     */
    public function setEntregaFichaIngreso($entregaFichaIngreso)
    {
        $this->entregaFichaIngreso = $entregaFichaIngreso;
    }

    /**
     * @return boolean
     */
    public function entregoResultadoIntegral()
    {
        return $this->entregaResultadoIntegral;
    }

    /**
     * @param boolean $entregaResultadoIntegral
     */
    public function setEntregaResultadoIntegral($entregaResultadoIntegral)
    {
        $this->entregaResultadoIntegral = $entregaResultadoIntegral;
    }

    /**
     * @return Serial
     */
    public function getSerialMedico()
    {
        return $this->serialMedico;
    }

    /**
     * @param Serial $serialMedico
     */
    public function setSerialMedico(Serial $serialMedico)
    {
        $this->serialMedico = $serialMedico;
    }

    /**
     * @return Serial
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * @param Serial $serial
     */
    public function setSerial(Serial $serial)
    {
        $this->serial = $serial;
    }

    /**
     * verifica que tenga todos los elementos
     * @return bool
     */
    public function expedienteCompleto()
    {
        if ( $this->entregoMedico() === false || $this->entregoPsicologia() === false || $this->entregoSocioeconomicos() === false || $this->entregaPoligrafia() === false || $this->entregoFichaIngreso() === false || $this->entregoResultadoIntegral() === false ) {
            return false;
        }

        return true;
    }
}