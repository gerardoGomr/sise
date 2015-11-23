<?php
namespace Sise\Usuarios;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
abstract class Fotografia
{
	/**
	 * ancho
	 * @var double
	 */
	protected $ancho;

	/**
	 * alto
	 * @var double
	 */
	protected $alto;

	/**
	 * peso en megabytes
	 * @var double
	 */
	protected $peso;

	/**
	 * nombre de la foto
	 * @var string
	 */
	protected $nombre;

	/**
	 * tipo de foto (mime-type)
	 * @var string
	 */
	protected $tipo;

	/**
	 * la ruta de la foto
	 * @var string
	 */
	protected $ruta;

	/**
	 * ruta temporal de la foto
	 * @var string
	 */
	protected $rutaTemporal;

	/**
	 * ruta a guardar la foto
	 * @var string
	 */
	protected $rutaAGuardar;

	/**
	 * indica si se ha subido o no
	 * @var bool
	 */
	protected $seHaSubido;

	/**
	 * indica si se subió con éxito
	 * @var bool
	 */
	protected $subioConExito;

	/**
	 * imagen origen, obtenida con GD
	 * @var resource
	 */
	protected $imgOrigen;

	/**
	 * imagen destino, obtenida con GD
	 * @var resource
	 */
	protected $imgDestino;

	public function __construct($ruta)
	{
		if(!file_exists($ruta)) {
			throw new \Exception("No existe esta imagen.");

		}

		$this->ruta = $ruta;
		$this->setPeso();
	}

    /**
     * Gets the ancho.
     *
     * @return double
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * Sets the ancho.
     *
     * @param double $ancho the ancho
     *
     * @return self
     */
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;

        return $this;
    }

    /**
     * Gets the alto.
     *
     * @return double
     */
    public function getAlto()
    {
        return $this->alto;
    }

    /**
     * Sets the alto.
     *
     * @param double $alto the alto
     *
     * @return self
     */
    public function setAlto($alto)
    {
        $this->alto = $alto;

        return $this;
    }

    /**
     * Gets the peso en megabytes.
     *
     * @return double
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Sets the peso en megabytes.
     *
     * @param double $peso the peso
     *
     * @return self
     */
    public function setPeso()
    {
        $this->peso = filesize($this->ruta);
    }

    /**
     * Gets the nombre de la foto.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the nombre de la foto.
     *
     * @param string $nombre the nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Gets the tipo de foto (mime-type).
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Sets the tipo de foto (mime-type).
     *
     * @param string $tipo the tipo
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * devolver el dato completo del peso
     * @return string
     */
    public function peso()
    {
    	return (string)$this->peso.'MB';
    }

    /**
     * mover foto a carpeta temporal
     * @param  string $nombre
     * @return bool
     */
    abstract public function moverATemporal($nombre);

    /**
     * cambiar el tamaño de la imagen
     * @param  int $posX
     * @param  int $posY
     * @param  int $nuevoAncho
     * @param  int $nuevoAlto
     * @return bool
     */
    abstract public function cambiarTamanio($posX, $posY, $nuevoAncho, $nuevoAlto);

    /**
     * guardar en la carpeta real
     * @param  string $nombre
     * @return bool
     */
    abstract public function guardar($nombre);

    /**
     * Gets the la ruta de la foto.
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Sets the la ruta de la foto.
     *
     * @param string $ruta the ruta
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    }
}