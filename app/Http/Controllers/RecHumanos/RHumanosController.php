<?php

namespace Sise\Http\Controllers\RHumanos;

use Sise\Usuarios\UsuariosRepositorioInterface;

class RHumanosController
{
	/**
     * generar la vista principal de recHumanos
     * @param  UsuariosRepositorioInterface $repositorio
     * @param  string                       $parametro
     * @return array                        $listaUsuarios
     */
    public function listaUsuarios(UsuariosRepositorioInterface $repositorio, $parametro = '')
    {
        return $repositorio->obtenerUsuarios($parametro);
    }

    /**
     * cargar los datos del username especificado
     * @param  string                       $username
     * @param  UsuariosRepositorioInterface $repositorio
     * @return UsuarioSise                  $usuario
     */
    public function obtenerUsuarioPorUsername($username, UsuariosRepositorioInterface $repositorio)
    {
        return $repositorio->obtenerUsuarioPorUsername($username);
    }

    public function obtenerAreaPorId($id, AreasRepositorioInterface $repositorio)
    {
        return $repositorio->obtenerAreaPorId($id);
    }

    public function obtenerPuestoPorId($id, PuestosRepositorioInterface $repositorio)
    {
        return $repositorio->obtenerPuestoPorId($id);
    }
}
