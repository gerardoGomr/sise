<?php

namespace Sise\Http\Controllers\Custodia\Archivo;

use Illuminate\Http\Request;
use Sise\Dominio\Evaluaciones\EntregaArchivo;
use Sise\Dominio\Evaluaciones\SerialMemo;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Infraestructura\Evaluaciones\EvaluacionesRepositorioInterface;
use Sise\Infraestructura\Evaluaciones\MemosRepositorioInterface;
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
            }

            $respuesta['html']  = view('custodia.archivo.archivo_entregas_lista', compact('memoEntrega'))->render();
            $respuesta['area']  = $serial->getArea();
            $respuesta['total'] = $memoEntrega->totalDeEvaluaciones();
        } else {
            $memoEntrega        = $request->session()->get('memoEntrega');
            $respuesta['html']  = view('custodia.archivo.archivo_entregas_lista', compact('memoEntrega'))->render();
            $respuesta['area']  = $serial->getArea();
            $respuesta['total'] = $memoEntrega->totalDeEvaluaciones();
        }

        $request->session()->put('memoEntrega', $memoEntrega);

        return response()->json($respuesta);
    }

    public function marcarExpediente(Request $request)
    {
        $txtSerial   = $request->get('txtSerial');
        $serial      = new Serial($txtSerial);
        $memoEntrega = $request->session()->get('memoEntrega');
        $respuesta   = [];

        $evaluacion = $this->evaluacionesRepositorio->obtenerEvaluacionPorSerial($serial);

        if (is_null($evaluacion)) {
            $respuesta['html']    = '0';
            $respuesta['mensaje'] = 'Expediente no existe';
        }

        if ($memoEntrega->buscarEvaluacion($evaluacion->getId())) {
            // evaluacion esta en el memo
        }
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
