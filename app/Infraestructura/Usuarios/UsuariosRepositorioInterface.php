<?php
namespace Sise\Infraestructura\Usuarios;

/**
 * Interface UsuariosRepositorioInterface
 * @package Sise\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface UsuariosRepositorioInterface
{
    /**
     * @return array
     */
    public function obtenerAnalistas();
}