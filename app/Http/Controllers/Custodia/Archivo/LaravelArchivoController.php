<?php

namespace Sise\Http\Controllers\Custodia\Archivo;

use Illuminate\Http\Request;
use Sise\Dominio\Evaluaciones\EntregaArchivo;
use Sise\Dominio\Evaluaciones\Serial;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Infraestructura\Evaluaciones\EvaluacionesRepositorioInterface;
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

    /**
     * LaravelArchivoController constructor.
     * @param EvaluacionesRepositorioInterface $evaluacionesRepositorio
     */
    public function __construct(EvaluacionesRepositorioInterface $evaluacionesRepositorio)
    {
        $this->evaluacionesRepositorio = $evaluacionesRepositorio;
    }

    /**
     * mostrar vista principal
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if(!is_null($request->session()->get('entregaArchivo'))) {
            $request->session()->forget('entregaArchivo');
        }
        return View::make('custodia.archivo.archivo_entregas');
    }

    /**
     * agregar nuevo expediente a la entrega
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function agregarExpediente(Request $request)
    {
        $txtSerial  = $request->get('txtSerial');
        $serial     = new Serial($txtSerial);
        $evaluacion = $this->evaluacionesRepositorio->obtenerEvaluacionPorSerial($serial);
        $respuesta  = [];

        if (is_null($evaluacion)) {
            $respuesta['html']    = '0';
            $respuesta['mensaje'] = 'Expediente no existe';
            return response()->json($respuesta);
        }

        !is_null($request->session()->get('entregaArchivo')) ? $entregaArchivo = $request->session()->get('entregaArchivo') : $entregaArchivo = new EntregaArchivo();
        $entregaArchivo->agregarEvaluacion($evaluacion);
        $request->session()->put('entregaArchivo', $entregaArchivo);

        $respuesta['html']  = view('custodia.archivo.archivo_entregas_lista', compact('entregaArchivo'))->render();
        $respuesta['area']  = $serial->getArea();
        $respuesta['total'] = $entregaArchivo->totalDeEvaluaciones();
        return response()->json($respuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
