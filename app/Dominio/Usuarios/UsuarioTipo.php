<?php
namespace Sise\Dominio\Usuarios;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class UsuarioTipo
{
	/**
	 * el Id
	 * @var int
	 */
	private $id;

	/**
	 * tipo de usuario
	 * @var string
	 */
	private $usuarioTipo;

	public function __construct($id = 1)
	{
		$this->id = $id;
	}

    /**
     * Gets the el Id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the el Id.
     *
     * @param int $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the tipo de usuario.
     *
     * @return string
     */
    public function getUsuarioTipo()
    {
        return $this->usuarioTipo;
    }

    /**
     * Sets the tipo de usuario.
     *
     * @param string $usuarioTipo the usuario tipo
     */
    public function setUsuarioTipo($usuarioTipo)
    {
        $this->usuarioTipo = $usuarioTipo;
    }
}