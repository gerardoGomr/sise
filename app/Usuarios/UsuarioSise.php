<?php
namespace Sise\Usuarios;

class UsuarioSise extends Usuario
{
	/**
     * lista de modulos que el usuario puede ver
     * @var array
     */
    protected $modulosAsignados;


    /**
     * Devuelve lista de modulos que el usuario puede ver.
     *
     * @return array
     */
    public function getModulosAsignados()
    {
        return $this->modulosAsignados;
    }

    /**
     * Setea la lista de modulos que el usuario puede ver.
     *
     * @param array $modulosAsignados modulos asignados
     */
    public function setModulosAsignados($modulosAsignados)
    {
        $this->modulosAsignados = $modulosAsignados;
    }

    /**
     * agregar nuevo modulo al usuario
     * @param  Modulo $modulo
     * @return void
     */
    public function agregarModulo(Modulo $modulo)
    {
        $this->modulos[] = $modulo;
    }

    /**
     * quitar los modulos asignados al usuario
     * @return void
     */
    public function quitarModulos()
    {
        $this->modulos[] = null;
    }
}