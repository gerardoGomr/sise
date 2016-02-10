<?php

namespace Sise\Http\Controllers\Custodia\Archivo;

use Illuminate\Http\Request;
use Sise\Dominio\Evaluaciones\SerialExpediente;
use Sise\Dominio\Evaluaciones\SerialMemo;
use Sise\Dominio\Evaluaciones\TipoSerial;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Infraestructura\Evaluaciones\EvaluacionesRepositorioInterface;
use Sise\Infraestructura\Evaluaciones\MemosRepositorioInterface;
use Sise\Servicios\Factories\ArchivoEntregaListasViewsFactory;
use Sise\Servicios\Factories\SerialesFactory;
use View;

/**
 * Class LaravelArchivoController
 * @package Sise\Http\Controllers\Custodia\Archivo
 * @author  Gerardo Adrián Gómez Ruiz
 */
class LaravelArchivoController extends Controller
{
    /**
     * @var EvaluacionesRepositorio
     */
    protected $evaluacionesRepositorio;

    protected $memosRepositorio;

    /**
     * LaravelArchivoController constructor.
     * @param EvaluacionesRepositorioInterface $evaluacionesRepositorio
     * @param MemosRepositorioInterface $memosRepositorio
     */
    public function __construct(EvaluacionesRepositorioInterface $evaluacionesRepositorio, MemosRepositorioInterface $memosRepositorio)
    {
        $this->evaluacionesRepositorio = $evaluacionesRepositorio;
        $this->memosRepositorio        = $memosRepositorio;
    }

    /**
     * mostrar vista principal
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if(!is_null($request->session()->get('memoEntrega'))) {
            $request->session()->forget('memoEntrega');
        }
        return View::make('custodia.archivo.archivo_entregas');
    }

    /**
     * agregar nuevo expediente a la entrega
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscarMemo(Request $request)
    {
        $txtSerial  = $request->get('txtSerialMemo');
        $txtSerial  = str_replace('-', '/', $txtSerial);
        $serial     = new SerialMemo($txtSerial);
        $respuesta  = [];

        if (is_null($request->session()->get('memoEntrega'))) {
            $memoEntrega = $this->memosRepositorio->obtenerMemoPorSerial($serial);
            if (is_null($memoEntrega)) {
                $respuesta['html']    = '0';
                $respuesta['mensaje'] = 'Memorandum no existe';
            } else {
                $respuesta['html']  = ArchivoEntregaListasViewsFactory::crear($memoEntrega);
                $respuesta['area']  = $serial->getArea()->getNombre();
                $respuesta['total'] = $memoEntrega->totalDeEvaluaciones();
            }
        } else {
            $memoEntrega        = $request->session()->get('memoEntrega');
            $respuesta['html']  = ArchivoEntregaListasViewsFactory::crear($memoEntrega);
            $respuesta['area']  = $serial->getArea()->getNombre();
            $respuesta['total'] = $memoEntrega->totalDeEvaluaciones();
        }

        $request->session()->put('memoEntrega', $memoEntrega);

        return response()->json($respuesta);
    }

    /**
     * marcar un expediente como entregado
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function marcarExpediente(Request $request)
    {
        $txtSerial   = $request->get('txtSerialExp');
        $serial      = SerialesFactory::crear($txtSerial);
        $memoEntrega = $request->session()->get('memoEntrega');
        $respuesta   = [];

        $evaluacion = $this->evaluacionesRepositorio->obtenerEvaluacionPorSerial($serial);

        if (is_null($evaluacion)) {
            $respuesta['html']    = '0';
            $respuesta['mensaje'] = 'Expediente no existe';
        }

        if (!is_null($memoEntrega->evaluacion($evaluacion->getId()))) {
            // evaluacion esta en el memo
            if (!is_null($serial->getNumeroEvaluacionPoligrafica())) {
                $memoEntrega->evaluacion($evaluacion->getId())->marcarEntregaDeExpediente($serial->getNumeroEvaluacionPoligrafica());
            } else {
                $memoEntrega->evaluacion($evaluacion->getId())->marcarEntregaDeExpediente();
            }
        }

        $request->session()->put('memoEntrega', $memoEntrega);

        $respuesta['html']  = ArchivoEntregaListasViewsFactory::crear($memoEntrega);
        //$respuesta['area']  = $serial->getArea()->getNombre();
        $respuesta['total'] = $memoEntrega->totalDeEvaluaciones();

        return response()->json($respuesta);
    }

    public function marcarEntrega(Request $request)
    {
        $memoEntrega = $request->session()->get('memoEntrega');

        $this->evaluacionesRepositorio->marcarEntrega($memoEntrega->getListaEvaluaciones());

        //$request->session()->forget('memoEntrega');

        return response(1);
    }
}
