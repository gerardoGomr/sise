<?php

namespace Sise\Http\Controllers\RecHumanos;

use Illuminate\Http\Request;
use Sise\Dominio\Usuarios\FotografiaTrabajador;
use Sise\Dominio\Usuarios\Trabajador;
use Sise\Dominio\Usuarios\UsuarioSise;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Infraestructura\Usuarios\AreasRepositorioInterface;
use Sise\Infraestructura\Usuarios\PuestosRepositorioInterface;
use Sise\Infraestructura\Usuarios\TrabajadoresRepositorioInterface;
use View;

class LaravelRecHumanosController extends Controller
{
	protected $trabajadoresRepositorio;

    /**
     * recibir dependencias
     * @param TrabajadoresRepositorioInterface $repositorio
     */
	public function __construct(TrabajadoresRepositorioInterface $repositorio)
	{
        $this->trabajadoresRepositorio = $repositorio;
	}

    /**
     * generar la vista principal de recHumanos
     * la cual es la administración de trabajadores, cargarle la lista de trabajadores registrados
     * @return View
     */
    public function index()
    {
    	$listaTrabajadores = $this->trabajadoresRepositorio->obtenerTrabajadores();

        return View::make('recHumanos.trabajadores', compact('listaTrabajadores'));
    }

    /**
     * buscar coincidencias de trabajadores
     * @param  Request $request
     * @return Response $response
     */
    public function buscarTrabajador(Request $request)
    {
    	// parámetro de búsqueda
    	$txtDato = $request->get('txtDato');

    	$listaTrabajadores = $this->trabajadoresRepositorio->obtenerTrabajadores($txtDato);

    	$html = View::make('recHumanos.trabajadores_lista', compact('listaTrabajadores'));

    	return response($html);
    }

    /**
     * obtener la info del usuario seleccionado y construir la vista
     * @param  Request $request
     * @return Response $response
     */
    public function detalleTrabajador(Request $request)
    {
    	$idTrabajador = base64_decode($request->get('idTrabajador'));

    	$trabajador = $this->trabajadoresRepositorio->obtenerTrabajadorPorId($idTrabajador);

    	$html = View::make('recHumanos.trabajadores_detalle', compact('trabajador'));

    	return response($html);
    }

    /**
     * construir la vista para agregar nuevo usuario
     * mandando una lista de puestos y una lista de areas
     * @param  AreasRepositorioInterface    $areasRepositorio
     * @param  PuestosRepositorioInterface  $puestosRepositorio
     * @return                              View
     */
    public function captura(AreasRepositorioInterface $areasRepositorio, PuestosRepositorioInterface $puestosRepositorio)
    {
        $listaAreas   = $areasRepositorio->obtenerAreas();
        $listaPuestos = $puestosRepositorio->obtenerPuestos();

        return View::make('recHumanos.trabajadores_capturar', compact('listaAreas', 'listaPuestos'));
    }

    /**
     * @param string                      $idTrabajador
     * @param AreasRepositorioInterface   $areasRepositorio
     * @param PuestosRepositorioInterface $puestosRepositorio
     * @return mixed
     */
    public function edicion($idTrabajador, AreasRepositorioInterface $areasRepositorio, PuestosRepositorioInterface $puestosRepositorio)
    {
        $listaAreas   = $areasRepositorio->obtenerAreas();
        $listaPuestos = $puestosRepositorio->obtenerPuestos();
        $idTrabajador = base64_decode($idTrabajador);

        $trabajador = $this->trabajadoresRepositorio->obtenerTrabajadorPorId($idTrabajador);
        // var_dump($trabajador);exit;
        return View::make('recHumanos.trabajadores_capturar', compact('listaAreas', 'listaPuestos', 'trabajador'));
    }

    /**
     * @param Request                     $request
     * @param AreasRepositorioInterface   $areasRepositorio
     * @param PuestosRepositorioInterface $puestosRepositorio
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \InvalidMailException
     */
    public function guardarTrabajador(Request $request, AreasRepositorioInterface $areasRepositorio, PuestosRepositorioInterface $puestosRepositorio)
    {
        // obtener datos capturados
        $txtUsername   = $request->get('txtUsername');
        $txtPassword   = $request->get('txtPassword');
        $area          = $request->get('area');
        $txtNombre     = $request->get('txtNombre');
        $txtPaterno    = $request->get('txtPaterno');
        $txtMaterno    = $request->get('txtMaterno');
        $puesto        = $request->get('puesto');
        $txtCelular    = $request->get('txtCelular');
        $txtEmail      = $request->get('txtEmail').$request->get('txtDominio');
        $modo          = $request->get('modo');
        $idTrabajador  = base64_decode($request->get('idTrabajador'));
        $fotoCapturada = $request->get('capturada');
        $tieneCuenta   = $request->get('usuarioSise') === 'on' ? true : false;

        // obtener area
        $area   = $areasRepositorio->obtenerAreaPorId($area);

        // obtener puesto
        $puesto = $puestosRepositorio->obtenerPuestoPorId($puesto);

        // crear usuario a guardar o editar
        $trabajador = new Trabajador($txtNombre, $txtPaterno, $txtMaterno);

        if($modo === '2') {
            $trabajador->setId($idTrabajador);
        }

        $trabajador->setCelular($txtCelular);
        $trabajador->setEmail($txtEmail);
        $trabajador->setArea($area);
        $trabajador->setPuesto($puesto);

        // ver si es activado como usuario o no
        if($tieneCuenta) {
            $trabajador->setUsuario(new UsuarioSise($txtUsername, UsuarioSise::encryptaPassword($txtPassword)));
            $trabajador->getUsuario()->setActivo(true);
        }

        if(!$this->trabajadoresRepositorio->persistir($trabajador)) {
            return response(0);
        }

        // var_dump($fotoCapturada);exit;
        // asignar fotografia
        if($fotoCapturada === '1') {
            // var_dump($fotografia);exit;
            $url   = $request->get('foto');
            // foto temporal
            $fotografia = new FotografiaTrabajador($url);

            // renombrar foto y adjuntar a la carpeta de fotos
            if(!$fotografia->guardar($trabajador->getId())) {
                return response(0);
            }
        }

        return response(1);
    }

    /**
     * subir una foto adjuntada a la carpeta temporal
     * @param  Request $request
     * @return View
     */
    public function subirFoto(Request $request)
    {
        // obtener la foto adjuntada
        if($_FILES['fotoAdjuntada']['error'] !== UPLOAD_ERR_OK) {
            return response(0);
        }

        $fotografia = new FotografiaTrabajador($_FILES['fotoAdjuntada']['tmp_name']);

        if(!$fotografia->moverATemporal($request->session()->getId())) {
            return response(0);
        }

        $trabajador = new Trabajador();
        $trabajador->setFotografia($fotografia);

        return View::make('recHumanos.trabajadores_foto', compact('trabajador'));
    }

    /**
     * recortar foto subida o capturada
     * @param  Request $request
     * @return View
     */
    public function recortarFoto(Request $request)
    {
        // obtener parámetros
        $x     = $request->get('x');
        $y     = $request->get('y');
        $ancho = $request->get('w');
        $alto  = $request->get('h');
        $url   = $request->get('urlFoto');

        $fotografia = new FotografiaTrabajador($url);

        if(!$fotografia->cambiarTamanio($x, $y, $ancho, $alto)) {
            return response(0);
        }

        $trabajador = new Trabajador();
        $trabajador->setFotografia($fotografia);

        return View::make('recHumanos.trabajadores_foto', compact('trabajador'));
    }

    /**
     * @param string $idTrabajador
     * @return View
     */
    public function password($idTrabajador)
    {
        $idTrabajador = base64_decode($idTrabajador);

        $trabajador = $this->trabajadoresRepositorio->obtenerTrabajadorPorId($idTrabajador);

        return View::make('recHumanos.trabajadores_cambiar_password', compact('trabajador'));
    }

    /**
     * cambiar la contraseña del trabajador especificado
     * @param  Request $request
     * @return Response
     */
    public function cambiarPassword(Request $request)
    {
        $idTrabajador = base64_decode($request->get('idTrabajador'));
        $txtPassword  = $request->get('txtPassword');

        // obtener al trabajador
        $trabajador   = $this->trabajadoresRepositorio->obtenerTrabajadorPorId($idTrabajador);
        // setear la nueva contraseña
        $trabajador->getUsuario()->setPasswd(UsuarioSise::encryptaPassword($txtPassword));
        // guardar password
        if(!$this->trabajadoresRepositorio->actualizarPassword($trabajador)) {
            return response(0);
        }

        return response(1);
    }

    /**
     * desactivar usuario del trabajador
     * @param  Request $request
     * @return Response
     */
    public function desactivar(Request $request)
    {
        $idTrabajador = base64_decode($request->get('idTrabajador'));

        // obtener al trabajador
        $trabajador   = $this->trabajadoresRepositorio->obtenerTrabajadorPorId($idTrabajador);
        $trabajador->getUsuario()->setActivo(false);

        if(!$this->trabajadoresRepositorio->modificarActivo($trabajador)) {
            return response(0);
        }

        return response(1);
    }

    /**
     * activar usuario del trabajador
     * @param  Request $request
     * @return Response
     */
    public function activar(Request $request)
    {
        $idTrabajador = base64_decode($request->get('idTrabajador'));

        // obtener al trabajador
        $trabajador   = $this->trabajadoresRepositorio->obtenerTrabajadorPorId($idTrabajador);
        $trabajador->getUsuario()->setActivo(true);

        if(!$this->trabajadoresRepositorio->modificarActivo($trabajador)) {
            return response(0);
        }

        return response(1);
    }
}