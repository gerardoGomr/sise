<?php
namespace Sise\Http\Controllers\Custodia\Estadisticas;

use Illuminate\Http\Request;
use Sise\Graficas\EvaluadosRepositorioInterface;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Infraestructura\Observaciones\ObservacionesRepositorioInterface;
use Sise\Infraestructura\Usuarios\UsuariosRepositorioInterface;
use Sise\Reportes\ObservacionesAnalistasReporte;
use Sise\Servicios\ConversorHighcharts;
use Sise\Servicios\Factories\TipoConversoresFactory;
use Sise\Servicios\Fecha;
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

    /**
     * generar la gráfica de desempeño de observaciones de los analistas de custodia a detalle
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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


    /**
     * ver la vista de observaciones detalle de un analista
     * @param $anio
     * @param $analista
     * @param $fecha1
     * @param $fecha2
     * @return View
     */
    public function detalle($anio, $analista, $fecha1 = null, $fecha2 = null)
    {
        // parámetros
        $parametros = [
            'anio'    => base64_decode($anio),
            'analista'=> base64_decode($analista),
            'fecha1'  => !is_null($fecha1) && !empty($fecha1) ? base64_decode($fecha1) : null,
            'fecha2'  => !is_null($fecha2) && !empty($fecha2) ? base64_decode($fecha2) : null,
        ];

        $listaObservaciones = $this->observacionesRepositorio->obtenerTotalDeObservacionesDetallePorAnalistas($parametros);
        $listaObservaciones['Periodo'] = (!is_null($fecha1) && !empty($fecha1)) && (!is_null($fecha2) && !empty($fecha2)) ? 'Del ' . $parametros['fecha1'] . ' al ' . $parametros['fecha2'] : 'Año ' . $parametros['anio'];

        return View::make('custodia.estadisticas.observaciones_analista_detalle', compact('listaObservaciones'));
    }

    /**
     * generar PDF de reporte general
     * @param Request $request
     */
    public function reporteGeneral(Request $request)
    {
        // parámetros
        $parametros = [
            'anio'     => $request->get('anio'),
            'fecha1'   => !is_null($request->get('fecha1')) && !empty($request->get('fecha1')) ? $request->get('fecha1') : null,
            'fecha2'   => !is_null($request->get('fecha2')) && !empty($request->get('fecha2')) ? $request->get('fecha2') : null
        ];

        $listaObservaciones = $this->observacionesRepositorio->obtenerObservacionesConcentrado($parametros);
        if (!is_null($parametros['fecha1']) && !is_null($parametros['fecha2'])) {
            $listaObservaciones['Periodo'] = ' del ' . Fecha::fechaDeHoy($parametros['fecha1']) . ' al ' . Fecha::fechaDeHoy($parametros['fecha2']);
        } else {
            $listaObservaciones['Periodo'] = ' del 01 de enero a la fecha del presente año';
        }
        $reporte            = new ObservacionesAnalistasReporte($listaObservaciones);

        var_dump($reporte->generar());
    }
}