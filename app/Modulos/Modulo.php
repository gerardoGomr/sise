<?php
namespace Sise\Modulos;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class Modulo
{
	/**
	 * id de modulo
	 * @var int
	 */
	protected $id;

	/**
	 * el nombre del módulo
	 * @var string
	 */
	protected $nombre;

	/**
	 * lista de módulos asignados
	 * @var array
	 */
	protected $listaModulos;

	/**
	 * lista de privilegios disponibles
	 * @var array
	 */
	protected $privilegios;

	public function __construct($nombre, array $privilegios = null)
	{
		$this->nombre      = $nombre;
		$this->privilegios = $privilegios;
	}

	/**
	 * agregar nuevo privilegio al módulo
	 * @param  Privilegio $privilegio
	 * @return void
	 */
	public function agregarPrivilegio(Privilegio $privilegio)
	{
		$this->privilegios[] = $privilegio;
	}

	/**
	 * quitar un privilegio al módulo seleccionado
	 * @param  Privilegio $privilegioAQuitar
	 * @return void
	 */
	public function quitarPrivilegio(Privilegio $privilegioAQuitar)
	{
		foreach ($privilegios as $indice => $privilegio) {

			if($privilegio->gerValor() === $privilegioAQuitar->getValor()) {
				// unset
				$this->privilegios[$indice] = null;
			}
		}
	}

    /**
     * Gets the el nombre del módulo.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the el nombre del módulo.
     *
     * @param string $nombre the nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Gets the lista de módulos asignados.
     *
     * @return array
     */
    public function getListaModulos()
    {
        return $this->listaModulos;
    }

    /**
     * Sets the lista de módulos asignados.
     *
     * @param array $listaModulos the lista modulos
     */
    public function setListaModulos(array $listaModulos)
    {
        $this->listaModulos = $listaModulos;
    }

    /**
     * Gets the lista de privilegios disponibles.
     *
     * @return array
     */
    public function getPrivilegios()
    {
        return $this->privilegios;
    }

    /**
     * Sets the lista de privilegios disponibles.
     *
     * @param array $privilegios the privilegios
     */
    public function setPrivilegios(array $privilegios)
    {
        $this->privilegios = $privilegios;
    }

    /**
     * Gets the id de modulo.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id de modulo.
     *
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}