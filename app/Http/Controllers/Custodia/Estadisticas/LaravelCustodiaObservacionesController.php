<?php
namespace Sise\Http\Controllers\Custodia\Estadisticas;

use Illuminate\Http\Request;
use Sise\Graficas\EvaluadosRepositorioInterface;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Infraestructura\Observaciones\ObservacionesRepositorioInterface;
use Sise\Servicios\Custodia\ConversorObservacionesHighcharts;
use View;

/**
 * Class LaravelCustodiaController
 * @package Sise\Http\Controllers\Estadisticas\Custodia
 * @author  Gerardo Adrián Gómez Ruiz
 */
class LaravelCustodiaObservacionesController extends Controller
{
    /**
     * @var ObservacionesRepositorioInterface
     */
    private $observacionesRepositorio;

    public function __construct(ObservacionesRepositorioInterface $observacionesRepositorio)
    {
        $this->observacionesRepositorio = $observacionesRepositorio;
    }

    /**
     * generar grafica de desempeño en cuestión de observaciones de analistas de custodia
     * @param EvaluadosRepositorioInterface $evaluadosRepositorio
     * @return mixed
     */
    public function index(EvaluadosRepositorioInterface $evaluadosRepositorio)
    {
        $listaAnios = $evaluadosRepositorio->obtenerAniosEvaluaciones(date('Y'));
        return View::make('custodia.estadisticas.grafica_observaciones_analistas', compact('listaAnios'));
    }


    public function graficaMensual(Request $request)
    {
        $anio                        = $request->get('anio');
        $listaObservacionesMensuales = $this->observacionesRepositorio->obtenerTotalDeObservacionesMensuales($anio);

        if(!is_null($listaObservacionesMensuales)) {
            // convertir a json
            $conversor  = new ConversorObservacionesHighcharts();
            $listaFinal = $conversor->convertir($listaObservacionesMensuales);

            return response()->json($listaFinal);
        }

        return response()->json('');
    }
}
