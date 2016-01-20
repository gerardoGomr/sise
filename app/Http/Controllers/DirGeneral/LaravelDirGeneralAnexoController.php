<?php

namespace Sise\Http\Controllers\DirGeneral;

use Illuminate\Http\Request;
use Sise\Graficas\ConversorEvaluadosProductividadPuntosHighcharts;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Graficas\EvaluadosRepositorioInterface;
use View;
use Response;
use Image;
use Fpdf;

/**
 * Controlador para las peticiones de Dirección General
 * @author Gerardo Adrián Gómez Ruiz
 */
class LaravelDirGeneralAnexoController extends Controller
{
    protected $evaluadosRepositorio;

	public function __construct(EvaluadosRepositorioInterface $evaluadosRepositorio)
	{
        $this->evaluadosRepositorio   = $evaluadosRepositorio;
	}

    /**
     * generar la vista principal
     * la cual es la administración de trabajadores, cargarle la lista de trabajadores registrados
     * @return View
     */
    public function index()
    {
        return View::make('dirGeneral.dashboard1');
    }

    /**
     * buscar datos de productividad dependiendo un rango de fechas
     * @param Request $request
     * @return Response
     */
    public function graficaProductividad(Request $request)
    {
        $fecha1 = $request->get('fecha1');
        $fecha2 = $request->get('fecha2');

        //var_dump($this->evaluadosRepositorio->obtenerEvaluacionesProductividad($fecha1, $fecha2));exit;

        $listaResultados = $this->evaluadosRepositorio->obtenerEvaluacionesProductividad($fecha1, $fecha2);
        if(!is_null($listaResultados)) {
            $conversor  = new ConversorEvaluadosProductividadPuntosHighcharts();
            $listaFinal = $conversor->convertir($listaResultados);

            return response()->json($listaFinal);
        }

        return response()->json('Sin resultados');
    }
}