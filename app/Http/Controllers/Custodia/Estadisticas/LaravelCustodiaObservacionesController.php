<?php
namespace Sise\Http\Controllers\Custodia\Estadisticas;

use Illuminate\Http\Request;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use \View;

/**
 * Class LaravelCustodiaController
 * @package Sise\Http\Controllers\Estadisticas\Custodia
 * @author  Gerardo Adrián Gómez Ruiz
 */
class LaravelCustodiaObservacionesController extends Controller
{
    /**
     * generar grafica de desempeño en cuestión de observaciones de analistas
     * de custodia
     * @return View
     */
    public function index()
    {
        return View::make('estadisticas.grafica_observaciones_analistas');
    }
}
