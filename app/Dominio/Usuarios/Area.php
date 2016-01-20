<?php
namespace Sise\Dominio\Usuarios;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class Area
{
	/**
	 * numero de area
	 * @var int
	 */
	private $id;

	/**
	 * nombre del area
	 * @var string
	 */
	private $nombre;

	/**
	 * area padre
	 * @var area
	 */
	private $area;

	public function __construct($id = null, $nombre = null)
	{
		$this->id     = $id;
		$this->nombre = $nombre;
	}



    /**
     * Gets the numero de area.
     *
     * @return int
     */
    public function numero()
    {
        return $this->id;
    }

    /**
     * Sets the numero de area.
     *
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the nombre del area.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the nombre del area.
     *
     * @param string $nombre the nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Gets the area padre.
     *
     * @return area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Sets the area padre.
     *
     * @param Area $area the area padre
     */
    public function setArea(Area $area)
    {
        $this->area = $area;
    }

    /**
     * obtener el nombre de todos los areas
     * @return string
     */
    public function obtenerAreasPadres()
    {
    	if(!is_null($this->area)) {
    		return $this->nombre.$this->area->obtenerAreas();
    	}
    }
}