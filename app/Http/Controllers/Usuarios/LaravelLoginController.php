<?php
namespace Sise\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use Sise\Http\Requests;
use Sise\Http\Controllers\Controller;
use Sise\Infraestructura\Usuarios\TrabajadoresRepositorioInterface;
use View;

class LaravelLoginController extends Controller
{
    /**
     * @var TrabajadoresRepositorioInterface
     */
    protected $trabajadoresRepositorio;

    public function __construct(TrabajadoresRepositorioInterface $trabajadoresRepositorio)
    {
        $this->trabajadoresRepositorio = $trabajadoresRepositorio;
    }

    /**
     * generar la vista para el login
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
        $username = $request->get('txtUsername');
        $password = $request->get('txtPassword');

        // comprobar que el usuario existe
        $trabajador = $this->trabajadoresRepositorio->obtenerTrabajadorPorUsername($username);

        if(is_null($trabajador)) {
            // no existe
            return $this->loginError();
        }

//        if(!$trabajador->tieneCuenta()) {
//            // no existe
//            return $this->loginError();
//        }

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
        return redirect('recHumanos/');
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