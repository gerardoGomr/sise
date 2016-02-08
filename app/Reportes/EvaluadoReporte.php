<?php
namespace Sise\Reportes;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class EvaluadoReporte extends ReporteCeCCC
{
	/**
	 * posición x1 para rectangulos
	 * @var int
	 */
	public $x1;

	/**
	 * posición y1 para rectángulos
	 * @var int
	 */
	public $y1;

	/**
	 * posición x2 para rectángulos
	 * @var int
	 */
	public $x2;

	/**
	 * posición y2 para rectángulos
	 * @var int
	 */
	public $y2;

	/**
	 * evaluado a mostrar
	 * @var array
	 */
	protected $evaluado;

	public function __construct($evaluado)
	{
		$this->evaluado = $evaluado;
		$this->nombre   = 'Reporte '.$this->evaluado['NumeroEvaluacion'].'a evaluación '.$this->evaluado['Nombre'];
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
		//parte datos de la persona
		$this->x1 = 7;
		$this->y1 = $this->GetY();
		$this->SetWidths(array(40,60,40,60));
		$this->Row_SinLine(array("Clave de Evaluado:",$this->evaluado["CodigoEvaluado"],utf8_decode("Fecha de Evaluación:"),$this->evaluado["FechaEvaluacion"]), "");
		$this->Ln(3);
		$this->Row_SinLine(array("Nombre de Evaluado:",utf8_decode($this->evaluado["Nombre"]),"",""), "");
		$this->Ln(3);
		$this->Row_SinLine(array("Puesto:",utf8_decode($this->evaluado["Puesto"]),"No. de Oficio:",'-'), "");
		$this->Ln(3);
		$this->SetWidths(array(40,200));
		$this->Row_SinLine(array("Dependencia:",utf8_decode($this->evaluado["Dependencia"])), "");
		$this->Ln(3);
		$this->Row_SinLine(array("Subdependencia:","-"), "");

		$this->x2 = 205;
		$this->y2 = $this->GetY();

		//dibujar rectangulo, ancho y alto, diferencia entre x e y actual con x e y iniciales
		$this->Rect($this->x1, $this->y1, $this->x2-$this->x1, $this->y2-$this->y1);

		$this->Ln(3);
		//parte datos evaluacion actual

		$this->SetFont("Arial", "B", 10);
		$this->Cell(0,5,"RESULTADOS",0,1,"C");

		$this->x1 = 7;
		$this->y1 = $this->GetY();

		//escribir la imagen en una carpeta
		// $imagen = file_get_contents("http://localhost:8080/ceccc/app/perfil_evaluado_imagen.php?q=".base64_encode($varImg));

		// if($imagen != "0")
		// {
		// 	file_put_contents("tmp_foto/".$this->evaluado["CURP"]."-".$this->evaluado["NumeroEvaluacion"].".jpg",$imagen);
		// 	$this->Image("tmp_foto/".$this->evaluado["CURP"]."-".$this->evaluado["NumeroEvaluacion"].".jpg", 165, $this->y1 + 5, 30);
		// }
		// else
		// {
		// 	$this->Image("img/50x50.jpg", 165, $this->y1 + 5, 30);
		// }
		//
		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array(60,60,90));
		$vigenciaEvaluacion = $this->evaluado["descVigencia"];

		foreach($this->evaluado['Examenes'] as $examen) {
			$this->Row_SinLine(array("RESULTADO ".utf8_decode($examen["TipoExamen"]).":",$examen["ResultadoExamen"],""), "");
		}

		$this->Ln(3);
		$this->SetFont("Arial", "B", 10);
		$this->SetWidths(array(50,150));
		$this->Row_SinLine(array("RESULTADO INTEGRAL",$this->evaluado["cResultadoint"]), "");
		$this->Ln(3);
		$this->Row_SinLine(array("Fecha Resultado Integral",$this->evaluado["fResultadoint"]), "");
		$this->Ln(3);
		$this->Row_SinLine(array("Vigencia",$vigenciaEvaluacion." meses"), "");
		$this->Ln(3);
		$this->SetWidths(array(50,40,50,50));
		$this->Row_SinLine(array("FechaVigencia",$this->evaluado["fVigencia"],"Status de Expediente",utf8_decode($this->evaluado["Status_Analisis"])), "");
		$this->x2 = 205;
		$this->y2 = $this->GetY();

		//dibujar rectangulo, ancho y alto, diferencia entre x e y actual con x e y iniciales
		$this->Rect($this->x1, $this->y1, $this->x2-$this->x1, $this->y2-$this->y1);
		$this->Ln(5);
		//parte datos historico de evaluaciones
		$this->SetFont("Arial", "B", 10);
		$this->Cell(0,5,"HISTORICO DE EVALUACIONES",0,1,"C");
		$this->SetFont("Arial", "B", 7);
		$this->SetWidths(array(20,25,25,25,25,25,20,25));

		if(count($this->evaluado['evaluaciones']) > 0) {
			$this->Row(array("Alta","Motivo","Puesto","Dependencia","Resultado","Fecha Resultado","Vigencia","Fecha Vigencia"), "");
			$this->SetFont("Arial", "", 7);

			foreach($this->evaluado['evaluaciones'] as $evaluacion) {
				list($anio, $mes, $dia) = explode("-",$evaluacion["FechaEvaluacion"]);
				$fechaVigencia = mktime(0,0,0,$mes + $evaluacion["Vigencia"], $dia, $anio);
				$fechaVigencia = date("Y", $fechaVigencia)."-".date("m",$fechaVigencia)."-".date("d", $fechaVigencia);

				$this->Row(array($evaluacion["FechaEvaluacion"],utf8_decode($evaluacion["TipoEvaluacion"]),utf8_decode($evaluacion["Puesto"]),utf8_decode($evaluacion["Dependencia"]),$evaluacion["ResultadoIntegral"],$evaluacion["FechaResultadoIntegral"],$evaluacion["descVigencia"],$evaluacion["FechaVigencia"]), "");
			}
		}
		else
		{
			$this->Cell(0,5,utf8_decode("NO TIENE EVALUACIONES PREVIAS A LA EVALUACIÓN ACTUAL"),0,1);
		}

		$this->Output($this->nombre, 'I');
	}
}