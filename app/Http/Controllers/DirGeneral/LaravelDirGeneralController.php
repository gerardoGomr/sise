<?php

namespace Sise\Http\Controllers\DirGeneral;

use Illuminate\Http\Request;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Graficas\ProgramadosRepositorioInterface;
use Sise\Graficas\EvaluadosRepositorioInterface;
use Sise\Graficas\ConversorProgramadosPuntosHighcharts;
use Sise\Graficas\ConversorEvaluadosPuntosHighcharts;
use View;

class LaravelDirGeneralController extends Controller
{
	protected $programadosRepositorio;
	protected $evaluadosRepositorio;

	public function __construct(ProgramadosRepositorioInterface $programadosRepositorio, EvaluadosRepositorioInterface $evaluadosRepositorio)
	{
		$this->programadosRepositorio = $programadosRepositorio;
		$this->evaluadosRepositorio   = $evaluadosRepositorio;
	}
    /**
     * generar la vista principal de rHumanos
     * la cual es la administración de trabajadores, cargarle la lista de trabajadores registrados
     * @return View
     */
    public function index()
    {
        $totalProgramados         = $this->programadosRepositorio->obtenerTotalProgramados();
        $totalEvaluacionesProceso = $this->evaluadosRepositorio->obtenerTotalEvaluacionesEnProceso();
        $totalEvaluaciones        = $this->evaluadosRepositorio->obtenerTotalEvaluacionesConcluidas();
        $listaResultados          = $this->evaluadosRepositorio->obtenerResultadosIntegrales();
        $colores                  = array('text-muted', 'text-primary', 'text-info');
        $coloresRGB               = array('#cacaca', '#b55151', '#4a8bc2');
    	return View::make('dirGeneral.dashboard', compact('totalProgramados', 'totalEvaluaciones', 'totalEvaluacionesProceso', 'listaResultados', 'colores', 'coloresRGB'));
    }

    /**
     * obtener los datos a graficar de programados
     * @param  Request $request
     * @return array
     */
    public function graficaProgramadosMensual(Request $request)
    {
    	$anio = (int)$request->get('anio');

    	$listaDatos = $this->programadosRepositorio->obtenerDatosProgramacionMensual($anio);
    	$conversor = new ConversorProgramadosPuntosHighcharts();
    	$listaFinal = $conversor->convertir($listaDatos);
    	// var_dump($listaFinal);exit;
    	return response()->json($listaFinal);
    }

    /**
     * obtener datos a graficar de evaluaciones
     * @param  Request $request
     * @return array
     */
    public function graficaEvaluacionesConcluidasMensual(Request $request)
    {
    	$anio = (int)$request->get('anio');

    	$listaDatos = $this->evaluadosRepositorio->obtenerEvaluacionesConcluidasMensual($anio);

    	$conversor = new ConversorEvaluadosPuntosHighcharts();
    	$listaFinal = $conversor->convertir($listaDatos);

    	return response()->json($listaFinal);
    }

    /**
     * buscar el total de programados en el repositorio
     * @param  Request $request
     * @return int
     */
    public function totalProgramados(Request $request)
    {
    	$totalProgramados  = $this->programadosRepositorio->obtenerTotalProgramados();

    	return $totalProgramados;
    }

    /**
     * buscar el total de evaluaciones en el repositorio
     * @param  Request $request
     * @return int
     */
    public function totalEvaluacionesConcluidas(Request $request)
    {
    	$totalEvaluaciones = $this->evaluadosRepositorio->obtenerTotalEvaluacionesConcluidas();

    	return $totalEvaluaciones;
    }

    /**
     * buscar el total de evaluaciones en proceso en el repositorio
     * @param  Request $request
     * @return int
     */
    public function totalEvaluacionesProceso(Request $request)
    {
        $totalEvaluaciones = $this->evaluadosRepositorio->obtenerTotalEvaluacionesEnProceso();

        return $totalEvaluaciones;
    }
}