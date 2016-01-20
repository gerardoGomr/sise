<?php
namespace Sise\Dominio\Usuarios;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class Puesto
{
	/**
	 * id del puesto
	 * @var int
	 */
	private $id;

	/**
	 * nombre del puesto
	 * @var string
	 */
	private $nombre;

	public function __construct($id = null, $nombre = null)
	{
		$this->id     = $id;
		$this->nombre = $nombre;
	}



    /**
     * Gets the id del puesto.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id del puesto.
     *
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the nombre del puesto.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the nombre del puesto.
     *
     * @param string $nombre the nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}