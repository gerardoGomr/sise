<?php
namespace Sise\Reportes;

/**
 * Class ObservacionesAnalistaReporte
 * @package Sise\Reportes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ObservacionesAnalistaReporte extends ReporteCeCCC
{
	/**
	 * @var array
	 */
	private $observaciones;

	public function __construct(array $observaciones)
	{
		$this->observaciones = $observaciones;
		$this->nombre        = 'Reporte de observaciones de analistas';
		parent::__construct();
	}

	/**
	 * generar reporte
	 * @return Pdf
	 */
	public function generar()
	{
		// configurar autor y nombre del reporte
		$this->SetTitle(utf8_decode($this->nombre));
		$this->SetAuthor('C3');

		$this->AliasNbPages();
		$this->AddPage();
		$this->SetFont("Arial", "", 6);
		$this->Cell(0,3,utf8_decode("Fecha de Impresión:").date('Y-m-d  H:m:i'),0,1,"R");
		$this->SetFont("Arial", "", 10);

		// cuerpo
		$this->Cell(0, 5, 'C. Manuel Burgos García', 0, 1);
		$this->SetFont("Arial", "B", 10);
		$this->Cell(0, 5, 'Director General', 0, 1);
		$this->Cell(0, 5, 'P R E S E N T E', 0, 1);
		$this->Ln(8);

		$this->SetFont("Arial", "", 10);
		$texto = 'En el periodo comprendido ' . $this->observaciones['Periodo'] . ' se han registrado un total de ' . string($this->observaciones['TotalObservaciones']) . ', siendo la más recurrente la de "' . $this->observaciones['ObservacionMasRecurrente'] . '" con un total de ' . $this->observaciones['TotalMasRecurrente']. '. Así mismo le informo que, por analista, se tuvieron los siguiente resultados:\n\n\n';

		foreach ($this->observaciones['analistas'] as $analista) {
			$texto .= '* ' . $analista['Nombre'] . ': ' . $analista['Total'] . ' observaciones';
		}

		$texto .= '\n\n\nSin más por el momento, le envío un cordial saludo.';
		$this->MultiCell(0, 5, $texto, 0, 'J');

		$this->Ln(5);
		$this->SetFont("Arial", "B", 10);
		$this->Cell(0, 5, 'A T E N T A M E N T E', 0, 1, 'C');
		$this->SetFont("Arial", "", 10);
		$this->Cell(0, 5, 'C. Yeni Molina Castellanos', 0, 1, 'C');

		$this->Output($this->nombre, 'I');
	}
}