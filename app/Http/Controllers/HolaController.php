<?php

namespace Sise\Http\Controllers;

use Illuminate\Http\Request;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Usuarios\PuestosRepositorioInterface;
use View;

class HolaController extends Controller
{
    protected $puestosRepositorio;

    public function __construct(PuestosRepositorioInterface $puestosRepositorio)
    {
        $this->puestosRepositorio = $puestosRepositorio;
    }
    /**
     * devuelve la vista para la petición hola
     * @return View
     */
    public function hola()
    {
        $listaPuestos = $this->puestosRepositorio->obtenerPuestos();
        return View::make('hola', compact('listaPuestos'));
    }
}
