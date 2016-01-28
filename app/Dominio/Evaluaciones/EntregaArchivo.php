<?php
namespace Sise\Dominio\Evaluaciones;
use Illuminate\Support\Collection;

/**
 * Class EntregaArchivo
 * @package Sise\Dominio\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class EntregaArchivo
{
    /**
     * @var string
     */
    private $numeroOficio;

    /**
     * @var Collection
     */
    private $listaEvaluaciones;

    public function __construct()
    {
        $this->listaEvaluaciones = new Collection();
    }

    /**
     * @return string
     */
    public function getNumeroOficio()
    {
        return $this->numeroOficio;
    }

    /**
     * @param string $numeroOficio
     */
    public function setNumeroOficio($numeroOficio)
    {
        $this->numeroOficio = $numeroOficio;
    }

    /**
     * @return Collection
     */
    public function getListaEvaluaciones()
    {
        return $this->listaEvaluaciones;
    }

    /**
     * agregar nueva evaluacion
     * @param Evaluacion $evaluacion
     */
    public function agregarEvaluacion(Evaluacion $evaluacion)
    {
        $this->listaEvaluaciones->put($evaluacion->getId(), $evaluacion);
    }

    /**
     * remover evaluacion
     * @param int $id
     */
    public function quitarEvaluacion($id)
    {
        $this->listaEvaluaciones->forget($id);
    }

    /**
     * obtener el total de evaluaciones
     * @return int
     */
    public function totalDeEvaluaciones()
    {
        return count($this->listaEvaluaciones);
    }
}