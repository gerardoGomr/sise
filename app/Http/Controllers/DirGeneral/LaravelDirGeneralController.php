<?php

namespace Sise\Http\Controllers\DirGeneral;

use Illuminate\Http\Request;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Graficas\ProgramadosRepositorioInterface;
use Sise\Graficas\EvaluadosRepositorioInterface;
use Sise\Dependencias\DependenciasRepositorioInterface;
use Sise\Graficas\ConversorProgramadosPuntosHighcharts;
use Sise\Graficas\ConversorEvaluadosPuntosHighcharts;
use Sise\Graficas\ConversorEvaluadosProgramadosPuntosHighcharts;
use Sise\Graficas\ConversorEvaluadosPendientesAreasPuntosHighcharts;
use Sise\Reportes\EvaluadoReporte;
use Sise\Reportes\ReporteCeCCC;
use View;
use Response;
use Image;
use Fpdf;

/**
 * Controlador para las peticiones de Dirección General
 * @author Gerardo Adrián Gómez Ruiz
 */
class LaravelDirGeneralController extends Controller
{
	protected $programadosRepositorio;
	protected $evaluadosRepositorio;
    protected $colores;
    protected $coloresRGB;

	public function __construct(ProgramadosRepositorioInterface $programadosRepositorio, EvaluadosRepositorioInterface $evaluadosRepositorio)
	{
        $this->programadosRepositorio = $programadosRepositorio;
        $this->evaluadosRepositorio   = $evaluadosRepositorio;

        $this->colores                = array('text-muted', 'text-danger', 'text-info', 'text-primary', 'text-success');
        $this->coloresRGB             = array('#cacaca', '#bd362f', '#4193d0', '#f76045', '#8bbf61');
	}
    /**
     * generar la vista principal de rHumanos
     * la cual es la administración de trabajadores, cargarle la lista de trabajadores registrados
     * @return View
     */
    public function index()
    {
        $totalProgramados         = $this->programadosRepositorio->obtenerTotalProgramados(date('Y'));
        $totalEvaluacionesProceso = $this->evaluadosRepositorio->obtenerTotalEvaluacionesEnProceso(date('Y'));
        $totalEvaluaciones        = $this->evaluadosRepositorio->obtenerTotalEvaluacionesConcluidas(date('Y'));
        $listaResultados          = $this->evaluadosRepositorio->obtenerResultadosIntegrales(date('Y'));
        $listaAnios               = $this->evaluadosRepositorio->obtenerAniosEvaluaciones(date('Y'));

    	return View::make('dirGeneral.dashboard', compact('totalProgramados', 'totalEvaluaciones', 'totalEvaluacionesProceso', 'listaResultados', 'listaAnios'))->with([
            'colores'    => $this->colores,
            'coloresRGB' => $this->coloresRGB
        ]);
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

        if(!is_null($listaDatos)) {
            $conversor = new ConversorProgramadosPuntosHighcharts();
            $listaFinal = $conversor->convertir($listaDatos);

            return response()->json($listaFinal);
        }

        return response()->json('');
    }

    /**
     * obtener datos a graficar de evaluaciones
     * @param  Request $request
     * @return array
     */
    public function graficaEvaluacionesConcluidasMensual(Request $request)
    {
        $anio                       = (int)$request->get('anio');

        $listaDatosEvaluaciones     = $this->evaluadosRepositorio->obtenerEvaluacionesConcluidasMensual($anio);
        $listaDatosProgramados      = $this->programadosRepositorio->obtenerDatosProgramacionMensual($anio);

        if(!is_null($listaDatosEvaluaciones) && !is_null($listaDatosProgramados)) {
            $listaDatos['Evaluaciones'] = $listaDatosEvaluaciones;
            $listaDatos['Programados']  = $listaDatosProgramados;

            $conversor                  = new ConversorEvaluadosProgramadosPuntosHighcharts();
            $listaFinal                 = $conversor->convertir($listaDatos);

        	return response()->json($listaFinal);
        }

        return response()->json('');
    }

    /**
     * buscar el total de programados en el repositorio
     * @param  Request $request
     * @return int
     */
    public function totalProgramados(Request $request)
    {
        $anio = (int)$request->get('anio');

    	$totalProgramados  = $this->programadosRepositorio->obtenerTotalProgramados($anio);

    	return $totalProgramados;
    }

    /**
     * buscar el total de evaluaciones en el repositorio
     * @param  Request $request
     * @return int
     */
    public function totalEvaluacionesConcluidas(Request $request)
    {
        $anio = (int)$request->get('anio');

    	$totalEvaluaciones = $this->evaluadosRepositorio->obtenerTotalEvaluacionesConcluidas($anio);

    	return $totalEvaluaciones;
    }

    /**
     * buscar el total de evaluaciones en proceso en el repositorio
     * @param  Request $request
     * @return int
     */
    public function totalEvaluacionesProceso(Request $request)
    {
        $anio = (int)$request->get('anio');

        $totalEvaluaciones = $this->evaluadosRepositorio->obtenerTotalEvaluacionesEnProceso($anio);

        return $totalEvaluaciones;
    }

    /**
     * cargar los resultados integrales
     * @param  Request $request
     * @return View
     */
    public function resultadosIntegrales(Request $request)
    {
        $anio              = (int)$request->get('anio');

        $listaResultados   = $this->evaluadosRepositorio->obtenerResultadosIntegrales($anio);//var_dump($listaResultados);exit;
        $totalEvaluaciones = $this->evaluadosRepositorio->obtenerTotalEvaluacionesConcluidas($anio);

        return View::make('dirGeneral.dashboard_sparklines_resultados', compact('listaResultados', 'totalEvaluaciones'))->with([
            'colores'    => $this->colores,
            'coloresRGB' => $this->coloresRGB
        ]);
    }

    /**
     * generar vista para búsqueda de evaluados
     * si se especifica el parametro curp, se busca la información del evaluado
     * y se genera inmediatamente el perfil
     * @return View
     */
    public function evaluados($curp = null)
    {
        if(!is_null($curp)) {
            $curp     = base64_decode($curp);
            $evaluado = $this->evaluadosRepositorio->obtenerEvaluadoPorCurp($curp);

            return View::make('dirGeneral.evaluados', compact('evaluado'));
        }

        return View::make('dirGeneral.evaluados');
    }

    /**
     * buscar coincidencias de evaluados y devolver la vista
     * @param  Request $request
     * @return View
     */
    public function buscarEvaluado(Request $request)
    {
        $txtEvaluadoDato = $request->get('txtEvaluadoDato');
        $listaEvaluados  = $this->evaluadosRepositorio->verEvaluados($txtEvaluadoDato);

        return View::make('dirGeneral.evaluados_lista', compact('listaEvaluados'));
    }

    /**
     * generar la vista del detalle para el perfil del evaluado
     * @param  Request $request
     * @return View
     */
    public function perfilEvaluado(Request $request)
    {
        $curp             = $request->get('curp');
        $idEvaluacion     = $request->get('idEvaluacion');

        if(!is_null($curp)) {
            $evaluado = $this->evaluadosRepositorio->obtenerEvaluadoPorCurp($curp);
        }

        if(!is_null($idEvaluacion)) {
            $idEvaluacion = (int)base64_decode($idEvaluacion);
            $evaluado     = $this->evaluadosRepositorio->obtenerEvaluadoPorIdEvaluacion($idEvaluacion);
        }

        return View::make('dirGeneral.evaluados_perfil', compact('evaluado'));
    }

    /**
     * generar la vista del detalle para el perfil del evaluado
     * @param  Request $request
     * @return View
     */
    public function perfilEvaluadoPdf($idEvaluacion)
    {
        $idEvaluacion    = (int)base64_decode($idEvaluacion);

        $evaluado        = $this->evaluadosRepositorio->obtenerEvaluadoPorIdEvaluacion($idEvaluacion);

        $evaluadoReporte = new EvaluadoReporte($evaluado);

        var_dump($evaluadoReporte->generar());exit;

    }

    /**
     * construir vista para mostrar lista de dependencias
     * @return View
     */
    public function dependencias(DependenciasRepositorioInterface $dependenciasRepositorio)
    {
        $listaDependencias = $dependenciasRepositorio->obtenerDependencias();
        $dependencia       = $dependenciasRepositorio->obtenerDependenciaPorId(3);

        return View::make('dirGeneral.dependencias', compact('listaDependencias', 'dependencia'));
    }

    /**
     * buscar dependencias mediante el parámetro especificado
     * @param  Request                          $request
     * @param  DependenciasRepositorioInterface $dependenciasRepositorio
     * @return View
     */
    public function buscarDependencia(Request $request, DependenciasRepositorioInterface $dependenciasRepositorio)
    {
        $txtDato           = $request->get('txtDependencia');
        $listaDependencias = $dependenciasRepositorio->obtenerDependencias($txtDato);//var_dump($listaDependencias);exit;

        return View::make('dirGeneral.dependencias_lista', compact('listaDependencias'));
    }

    /**
     * ver el perfil de la dependencia seleccinada
     * @param  Request                          $request
     * @param  DependenciasRepositorioInterface $dependenciasRepositorio
     * @return View
     */
    public function perfilDependencia(Request $request, DependenciasRepositorioInterface $dependenciasRepositorio)
    {
        $idDependencia = (int)base64_decode($request->get('idDependencia'));
        $dependencia   = $dependenciasRepositorio->obtenerDependenciaPorId($idDependencia);

        return View::make('dirGeneral.dependencias_perfil', compact('dependencia'));
    }

    /**
     * graficar las evaluaciones pendientes por área
     * @param  Request $request
     * @return Response
     */
    public function graficaEvaluacionesPendientes(Request $request)
    {
        $anio       = (int)$request->get('anio');
        $listaDatos = $this->evaluadosRepositorio->obtenerEvaluacionesPendientesPorAreaAnio($anio);//var_dump($listaDatos);exit;

        if(!is_null($listaDatos)) {
            $conversor = new ConversorEvaluadosPendientesAreasPuntosHighcharts();
            $listaFinal = $conversor->convertir($listaDatos);

            return response()->json($listaFinal);
        }

        return response()->json('');
    }
}