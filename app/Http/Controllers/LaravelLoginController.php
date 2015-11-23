<?php

namespace Sise\Http\Controllers;

use Illuminate\Http\Request;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Usuarios\TrabajadoresRepositorioInterface;
use View;

class LaravelLoginController extends Controller
{
    /**
     * agregarle un controller especifico
     * @var LoginController
     */
    protected $trabajadoresRepositorio;

    public function __construct(TrabajadoresRepositorioInterface $trabajadoresRepositorio)
    {
        $this->trabajadoresRepositorio = $trabajadoresRepositorio;
    }

    /**
     * generar la vista para el login
     *
     * @return View
     */
    public function index()
    {
        return View::make('login');
    }

    /**
     * loguear a un usuario
     * @param  Request $request
     * @return Redirect
     */
    public function login(Request $request)
    {
        // echo password_hash('123123x', PASSWORD_DEFAULT);exit;
        $username = $request->get('txtUsername');
        $password = $request->get('txtPassword');

        // comprobar que el usuario existe
        $trabajador = $this->trabajadoresRepositorio->obtenerTrabajadorPorUsername($username);

        // var_dump($trabajador);exit;
        if(!$trabajador->tieneCuenta()) {
            // no existe
            return $this->loginError();
        }

        if(!($trabajador->activo())) {
            // usuario inactivo
            return $this->loginError();
        }

        if(!($trabajador->verificarContrasenia($password))) {

            // password no coincide
            return $this->loginError();
        }

        // guardar en sesion al usuario
        $request->session()->put('trabajador', $trabajador);

        // $view = UsuariosVistasFactory::obtenerVista($trabajador->getArea());
        return redirect('rHumanos/');
    }

    /**
     * cerrar sesion
     * @param  Request $request
     * @return Redirect
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    /**
     * error al loguear y generar la vista
     * @return View
     */
    public function loginError()
    {
        return view('login')->with('error', 'Usuario y/o contraseña incorrectos');
    }
}