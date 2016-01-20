<?php
namespace Sise\Servicios\Reportes\Evaluaciones;

use URL;
use Anouar\Fpdf\Fpdf;

/**
* @author Gerardo Adrián Gómez Ruiz
* clase que genera un reporte para el C3
*/
abstract class ReporteCeCCC extends Fpdf
{
	/**
	 * nombre del reporte
	 * @var string
	 */
	protected $nombre;

	public function Header()
	{
		//encabezado
		$this->SetFont("Arial", "B", 12);
		$this->Cell(0,4,"CENTRO ESTATAL DE CONTROL DE CONFIANZA CERTIFICADO",0,1,"C");
		$this->SetFont("Arial", "", 10);
		$this->Ln(6);
		$this->Cell(0,4,utf8_decode("DIRECCIÓN DE INFORMACIÓN REGISTRO Y CADENA DE CUSTODIA"),0,1,"C");
		$this->Ln(2);
		$this->SetFont("Arial", "B", 12);
		$this->Cell(0,4,utf8_decode("SEGUIMIENTO DE EVALUACIONES"),0,1,"C");

		// imagenes del poder ejecutivo y de gobierno del estado
		$this->Image(URL::asset("public/img/logo.jpg"), 5, 5, 20);
		$this->Image(URL::asset("public/img/gobiernoEstado.jpg"), 172, 5, 35);

		//imagen evaluado

		//línea
		$this->Line(5, 30, 205, 30);
		$this->Line(5, 30.2, 205, 30.2);
		$this->Line(5, 30.4, 205, 30.4);

		$this->Ln(15);
	}

	public function Footer()
	{
		$this->SetY(-15);
    	// Arial italic 8
    	$this->SetFont('Arial','I',8);
    	// Número de página
    	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}

	/**
	 * generar reporte
	 * @return Pdf
	 */
	public abstract function generar();
}