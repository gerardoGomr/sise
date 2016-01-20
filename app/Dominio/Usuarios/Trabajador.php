<?php
namespace Sise\Dominio\Usuarios;

use Sise\Dominio\Personas\Persona;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class Trabajador extends Persona
{
	/**
	 * id de usuario
	 * @var int
	 */
	protected $id;

	/**
	 * usuario para acceso a un sistema
	 * @var Usuario
	 */
	protected $usuario;

	/**
     * el Area al que pertenece
     * @var Area
     */
    protected $area;

    /**
     * puesto que tiene
     * @var Puesto
     */
    protected $puesto;

    /**
     * fotografia del usuario
     * @var Fotografia
     */
    protected $fotografia;

	public function __construct($nombre = '', $paterno = '', $materno = '')
	{
		$this->nombre  = $nombre;
		$this->paterno = $paterno;
		$this->materno = $materno;
	}

    /**
     * Gets the usuario para acceso a un sistema.
     *
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Sets the usuario para acceso a un sistema.
     *
     * @param Usuario $usuario the usuario
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * obtener el nombre completo del funcionario
     * @return string
     */
    public function getNombreCompleto()
    {
        $nombreCompleto = $this->nombre;

        if(!empty($this->paterno)) {
            $nombreCompleto .= ' '.$this->paterno;
        }

        if(!empty($this->materno)) {
            $nombreCompleto .= ' '.$this->materno;
        }
        return $nombreCompleto;
    }

    /**
     * verificar si el trabajador tiene o no una cuenta de usuario
     * @return bool
     */
    public function tieneCuenta()
    {
    	if(is_null($this->usuario)) {
    		return false;
    	}

    	return true;
    }

    public function tieneFoto()
    {
        if(is_null($this->fotografia)) {
            return false;
        }

        return true;
    }

    /**
     * devuelve el Area al que pertenece.
     *
     * @return Area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Sets el Area al que pertenece.
     *
     * @param Area $area
     */
    public function setArea(Area $area)
    {
        $this->area = $area;
    }

    public function verAreaDondeLabora()
    {
        $this->area->obtenerAreas();
    }

    /**
     * Gets the puesto que tiene.
     *
     * @return Puesto
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Sets the puesto que tiene.
     *
     * @param Puesto $puesto the puesto
     */
    public function setPuesto(Puesto $puesto)
    {
        $this->puesto = $puesto;
    }

    /**
     * verificar si el area especificada está asignada al usuario
     * @param  Area   $area
     * @return bool
     */
    public function estaAsignadaElArea(Area $area)
    {
        if($this->area->numero() !== $area->numero()) {
            return false;
        }

        return true;
    }

    /**
     * verificar si el puesto está asignado al usuario
     * @param  Puesto $puesto
     * @return bool
     */
    public function estaAsignadoElPuesto(Puesto $puesto)
    {
        if($this->puesto->getId() !== $puesto->getId()) {
            return false;
        }

        return true;
    }

    /**
     * verificar si es un usuario activo
     * @return bool
     */
    public function activo()
    {
    	return $this->usuario->activo();
    }

    /**
     * verificar si coincide la contraseña
     * @param  string $passwd
     * @return bool
     */
    public function verificarContrasenia($passwd)
    {
    	return $this->usuario->verificarContrasenia($passwd);
    }

    /**
     * Gets the id de usuario.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id de usuario.
     *
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the fotografia del usuario.
     *
     * @return FotografiaTrabajador
     */
    public function getFotografia()
    {
        return $this->fotografia;
    }

    /**
     * Sets the fotografia del usuario.
     *
     * @param Fotografia $fotografia the fotografia
     */
    public function setFotografia(Fotografia $fotografia)
    {
        $this->fotografia = $fotografia;
    }

    /**
     * @param string $email
     * @throws \InvalidMailException
     */
    public function setEmail($email)
    {
        list($mail, $dominio) = explode('@', $email);

        if($dominio !== 'ceccc.gob.mx') {
            throw new \InvalidMailException('El dominio no corresponde al del CECCC');
        }

        $this->email = $email;
    }

    /**
     * retornar el mail de la persona
     * @return array
     */
    public function getEmail()
    {
        list($mail, $dominio) = explode('@', $this->email);
        return $mail;
    }
}