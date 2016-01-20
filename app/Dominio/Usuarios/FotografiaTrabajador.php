<?php
namespace Sise\Dominio\Usuarios;

use Sise\Dominio\Fotografia;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * se espera que sea JPG
 */
class FotografiaTrabajador extends Fotografia
{
	/**
	 * indica si la foto ha sido o no recortada
	 * @var bool
	 */
	private $haSidoRecortada;

	public function __construct($ruta)
	{
		$this->rutaTemporal = 'public/usuariosFotografiasTemp/';
		$this->rutaAGuardar = 'public/usuariosFotografias/';

		parent::__construct($ruta);

		list($ancho, $alto, $tipo) = getimagesize($this->ruta);

		if($tipo !== IMAGETYPE_JPEG) {
			throw new \Exception("No es imagen JPG");
		}

		// inicializar
		$this->imgOrigen       = imagecreatefromjpeg($this->ruta);
		$this->ancho           = $ancho;
		$this->alto            = $alto;
		$this->tipo            = $tipo;
		$this->haSidoRecortada = false;
	}

	/**
	 * mover un archivo subido a la carpeta temporal
	 * @param  string $nombre
	 * @return bool
	 */
	public function moverATemporal($nombre)
	{
		// en pixeles
		try {
			$anchoNuevo = 200;
			$altoNuevo  = 300;

			// img destino
			$this->imgDestino = imagecreatetruecolor($anchoNuevo, $altoNuevo);

			// achicar a 300 x 200
			imagecopyresampled($this->imgDestino, $this->imgOrigen, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $this->ancho, $this->alto);

			// guardar
			imagejpeg($this->imgDestino, $this->rutaTemporal.$nombre.'.jpg', 100);

			$this->ancho = $anchoNuevo;
			$this->alto  = $altoNuevo;
			$this->ruta  = $this->rutaTemporal.$nombre.'.jpg';

			$this->imgOrigen = imagecreatefromjpeg($this->ruta);

			return true;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * verificar si ha sido recortada
	 * @return int
	 */
	public function recortada()
	{
		if($this->haSidoRecortada === true) {
			return 1;
		}

		return 0;
	}

	/**
     * cambiar el tamaño de la imagen
     * @param  int $posX
     * @param  int $posY
     * @param  int $nuevoAncho
     * @param  int $nuevoAlto
     * @return bool
     */
    public function cambiarTamanio($posX, $posY, $nuevoAncho, $nuevoAlto)
    {
    	try {
	    	$this->imgDestino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

	    	imagecopyresampled($this->imgDestino, $this->imgOrigen, 0, 0, $posX, $posY, $nuevoAncho, $nuevoAlto, $nuevoAncho, $nuevoAlto);

	    	$this->ancho = $nuevoAncho;
	    	$this->alto  = $nuevoAlto;

	    	$this->setPeso();

	    	imagejpeg($this->imgDestino, $this->ruta, 100);

	    	return true;

	    } catch(\Exception $e) {
			echo $e->getMessage();
			return false;
		}
    }

    /**
     * guardar en la carpeta real
     * @param  string $nombre
     * @return bool
     */
    public function guardar($nombre)
	{
        $nombre = (string)$nombre;

		if(!rename($this->ruta, $this->rutaAGuardar.$nombre.'.jpg')) {
			return false;
		}

		$this->ruta = $this->rutaAGuardar.$nombre.'.jpg';

		return true;
	}
}