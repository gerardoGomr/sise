<?php
namespace Sise\Http\Controllers;

use Sise\Usuarios\UsuariosRepositorioInterface;
use Sise\Usuarios\Usuario;

class LoginController
{

    /**
     * loguear usuarios
     * @param  string $username
     * @param  string $passwd
     * @param  Interface $usuarioRepositorio
     * @return Usuario $usuario // puede ser un Funcionario $usuario // null
     */
    public function login($username, $passwd, UsuariosRepositorioInterface $usuarioRepositorio)
    {
        // comprobar que el usuario existe
        $usuario = $usuarioRepositorio->obtenerUsuarioPorUsername($username);

        // var_dump($usuario);exit;
        // var_dump($usuario->verificarContrasenia($passwd));exit;
        if(!$usuario->registrado()) {
            // no existe
            return null;
        }

        // obtener datos del funcionario
        // $usuarioRepositorio->cargarDatosDeUsuarioPorUsuario($usuario);

        // if(!Hash::check($passwd, $usuario->getPasswd())) {
        if(!($usuario->verificarContrasenia($passwd))) {

            // password no coincide
            return null;
        }

        if(!($usuario->activo())) {
            // funcionario inactivo
            return null;
        }

        return $usuario;
    }
}
