<?php
namespace Sise\Http\Controllers\Custodia\Estadisticas;

use Illuminate\Http\Request;
use Sise\Graficas\EvaluadosRepositorioInterface;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Infraestructura\Observaciones\ObservacionesRepositorioInterface;
use Sise\Infraestructura\Usuarios\UsuariosRepositorioInterface;
use Sise\Servicios\ConversorHighcharts;
use Sise\Servicios\Factories\TipoConversoresFactory;
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
     * renderizar pantalla principal
     * @param EvaluadosRepositorioInterface $evaluadosRepositorio
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     * @return mixed
     */
    public function index(EvaluadosRepositorioInterface $evaluadosRepositorio, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $listaAnios               = $evaluadosRepositorio->obtenerAniosEvaluaciones(date('Y'));
        $listaAnalistas           = $usuariosRepositorio->obtenerAnalistas();
        $totalObservaciones       = $this->observacionesRepositorio->obtenerTotalDeObservaciones(date('Y'));
        $observacionMasRecurrente = $this->observacionesRepositorio->obtenerObservacionMasRecurrente(date('Y'));
        return View::make('custodia.estadisticas.grafica_observaciones_analistas', compact('listaAnios', 'listaAnalistas', 'totalObservaciones', 'observacionMasRecurrente'));
    }


    /**
     * generar la gráfica de desempeño de observaciones de los analistas de custodia de manera mensual
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function graficaMensual(Request $request)
    {
        $anio                        = $request->get('anio');
        $listaObservacionesMensuales = $this->observacionesRepositorio->obtenerTotalDeObservacionesMensuales($anio);

        if(!is_null($listaObservacionesMensuales)) {
            // convertir a json
            $tipoConversor = TipoConversoresFactory::obtenerConversor('observaciones_general');
            $conversor     = new ConversorHighcharts($tipoConversor);
            $listaFinal    = $conversor->convertir($listaObservacionesMensuales);

            $totalObservaciones       = $this->observacionesRepositorio->obtenerTotalDeObservaciones($anio);
            $observacionMasRecurrente = $this->observacionesRepositorio->obtenerObservacionMasRecurrente($anio);

            $listaFinal['totalObservaciones']       = $totalObservaciones;
            $listaFinal['observacionMasRecurrente'] = $observacionMasRecurrente;

            return response()->json($listaFinal);
        }

        return response()->json('');
    }

    public function graficaAnalistas(Request $request)
    {
        // parámetros
        $parametros = [
            'anio'     => $request->get('anio'),
            'fecha1'   => !is_null($request->get('fecha1')) && !empty($request->get('fecha1')) ? $request->get('fecha1') : null,
            'fecha2'   => !is_null($request->get('fecha2')) && !empty($request->get('fecha2')) ? $request->get('fecha2') : null,
            'analista' => !is_null($request->get('analistas')) ? $request->get('analistas') : ''
        ];

        $listaObservacionesAnalistas = $this->observacionesRepositorio->obtenerTotalDeObservacionesPorAnalistas($parametros);

        if (!is_null($listaObservacionesAnalistas)) {
            $tipoConversor = TipoConversoresFactory::obtenerConversor('observaciones_analistas');
            $conversor     = new ConversorHighcharts($tipoConversor);
            $listaFinal    = $conversor->convertir($listaObservacionesAnalistas);

            return response()->json($listaFinal);
        }

        return response()->json('');
    }
}