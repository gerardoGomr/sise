<?php
namespace Sise\Dominio\Evaluaciones;
use Illuminate\Support\Collection;

/**
 * Class MemoEntrega
 * @package Sise\Dominio\Evaluaciones
 * @author  Gerardo Adrián Gómez Ruiz
 */
class MemoEntrega
{
    /**
     * @var string
     */
    private $folio;

    /**
     * @var Collection
     */
    private $listaEvaluaciones;

    /**
     * @var bool
     */
    private $entregado;

    /**
     * @var Serial
     */
    private $serial;

    public function __construct($folio, $entregado = false)
    {
        $this->folio             = $folio;
        $this->entregado         = $entregado;
        $this->listaEvaluaciones = new Collection();
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
     * buscar una evaluacion dentro de la lista del memorandum
     * @param int $id
     * @return boolean
     */
    private function buscarEvaluacion($id)
    {
        return $this->listaEvaluaciones->search($id);
    }

    /**
     * obtener una evaluacion en específico
     * @param int $id
     * @return mixed|null
     */
    public function evaluacion($id)
    {
        if ($this->buscarEvaluacion($id) === false) {
            return null;
        }

        return $this->listaEvaluaciones->get($id);
    }

    /**
     * obtener el total de evaluaciones
     * @return int
     */
    public function totalDeEvaluaciones()
    {
        return count($this->listaEvaluaciones);
    }

    /**
     * @return string
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * @param string $folio
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;
    }

    /**
     * @return boolean
     */
    public function entregado()
    {
        return $this->entregado;
    }

    /**
     * @param boolean $entregado
     */
    public function setEntregado($entregado)
    {
        $this->entregado = $entregado;
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
}