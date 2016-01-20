<?php
require_once('../Connections/connCeCCC.php');
require_once '../fpdf/fpdf.php';

$idEvaluacion = base64_decode($_GET["idEvaluacion"]);

if(!is_numeric($idEvaluacion))
{
	header("Location: index.php");
	exit;
}

//buscar los datos de la persona solicitada en la tabla de evaluaciones
$query_srcEvaluado = "SELECT ev.idEvaluacion, ev.FechaEvaluacion, ev.NumeroEvaluacion, ev.idPadron , ev.FechaEvaluacion, ev.CodigoEvaluado, ev.Nombre , ev.Paterno , ev.Materno , ev.Puesto , em.idMunicipio , em.Municipio , ev.CUIP , ev.CURP , ev.RFC , ev.FechaNacimiento , ev.LugarNacimiento , iIF(ev.Sexo = 'HOMBRE', 'MASCULINO', 'FEMENINO') AS Sexo, ec.idEstadoCivil , ec.EstadoCivil , e.idEscolaridad , e.Escolaridad , d.idDependencia , d.Dependencia , ev.Mando , ev.Rango , ev.Especialidad ,IIF(ev.TipoSangre = 'SIN','--',CONCAT(ev.TipoSangre,IIF(ev.TipoSangreFactor='RH+','+','-'))) TipoSangre , ev.Peso , ev.Altura , ev.Celular , ev.TelCasa , ev.TelOficina , ev.Extension, ev.cOficio, ev.cResultadoint, convert(date,ev.fResultadoint) AS fResultadoint, cRep.descVigencia, cSA.Status_Analisis, convert(date,ev.fVigencia) AS FechaVigencia FROM evaluaciones AS ev INNER JOIN estado_municipios AS em ON (ev.idMunicipio = em.idMunicipio) INNER JOIN estado_civil AS ec ON (ev.idEstadoCivil = ec.idEstadoCivil) INNER JOIN escolaridad AS e ON (ev.idEscolaridad = e.idEscolaridad) INNER JOIN dependencia AS d ON (ev.idDependencia = d.idDependencia) LEFT JOIN c_Rprogramar AS cRep ON (cRep.cClaveVigencia = ev.VigenciaEvaluacion) LEFT JOIN c_Status_Custodia AS cSA ON (cSA.id_status_Analisis = ev.StatusCust) WHERE ev.idEvaluacion = ".$idEvaluacion;//echo $query_srcEvaluado;exit;
$srcEvaluado = sqlsrv_query($connCeCCC, $query_srcEvaluado,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
$row_srcEvaluado = sqlsrv_fetch_array($srcEvaluado);
$totalRows_srcEvaluado = sqlsrv_num_rows($srcEvaluado);

$idPadron = $row_srcEvaluado["idPadron"];

//obtener los examenes de la evaluación más reciente del evaluado
$query_srcEvalExamenes = "SELECT
    ee.TipoExamen
    , eer.ResultadoExamen
    , e.FechaEvaluacion
    , e.VigenciaEvaluacion
FROM
    evaluaciones_has_examenes AS ehe
    INNER JOIN evaluaciones_examenes AS ee
        ON (ehe.idTipoExamen = ee.idTipoExamen)
    INNER JOIN evaluacion_examen_resultado AS eer
        ON (ehe.idResultadoExamen = eer.idResultadoExamen)
    INNER JOIN evaluaciones AS e
	ON (e.idEvaluacion = ehe.idEvaluacion)
WHERE ehe.idEvaluacion = ".$row_srcEvaluado["idEvaluacion"];
$srcEvalExamenes = sqlsrv_query($connCeCCC, $query_srcEvalExamenes,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
$row_srcEvalExamenes = sqlsrv_fetch_array($srcEvalExamenes);
$totalRows_srcEvalExamenes = sqlsrv_num_rows($srcEvalExamenes);

//evaluaciones pasadas de la persona
$query_srcEvalPasadas = "SELECT ev.idEvaluacion, ev.idPadron , ev.FechaEvaluacion, d.Dependencia , ev.Puesto, ev.VigenciaEvaluacion, et.TipoEvaluacion, ev.cResultadoint, convert(date, fResultadoint) AS fResultadoint, convert(date, fVigencia) AS fVigencia, cRep.descVigencia FROM evaluaciones AS ev INNER JOIN evaluaciones_tipo AS et ON (ev.idTipoEvaluacion = et.idTipoEvaluacion) INNER JOIN dependencia AS d ON (d.idDependencia = ev.idDependencia) LEFT JOIN c_Rprogramar AS cRep ON (cRep.cClaveVigencia = ev.VigenciaEvaluacion) WHERE ev.idPadron = ".$row_srcEvaluado["idPadron"]." AND ev.FechaEvaluacion < '".$row_srcEvaluado["FechaEvaluacion"]."'";//echo $query_srcEvalPasadas;exit;
$srcEvalPasadas = sqlsrv_query($connCeCCC, $query_srcEvalPasadas,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
$row_srcEvalPasadas = sqlsrv_fetch_array($srcEvalPasadas);
$totalRows_srcEvalPasadas = sqlsrv_num_rows($srcEvalPasadas);

$varImg = $row_srcEvaluado["NumeroEvaluacion"]."-".$row_srcEvaluado["CURP"];

//seguimiento del usuario
$query_insrtUsuarioFootprint = "INSERT INTO usuarios_footprints (Username, SERVERData, GETData, POSTData, IPAddress, RealIPAddress, Accion,FechaHora) VALUES ('".$_SESSION["MM_Username"]."', '".serialize($_SERVER)."', '".serialize($_GET)."', '".serialize($_POST)."', '".$_SERVER["REMOTE_ADDR"]."', '".getenv("HTTP_X_FORWARDED_FOR")."', 'VISUALIZÓ EL PDF \"SEGUIMIENTO DE EVALUACIONES\", DEL EVALUADO ".$row_srcEvaluado["Nombre"]." ".$row_srcEvaluado["Paterno"]." ".$row_srcEvaluado["Materno"].", CUYA FECHA DE EVALUACIÓN ES: ".$row_srcEvaluado["FechaEvaluacion"]."', GETDATE())";
$insrtUsuarioFootprint = sqlsrv_query($connCeCCC, $query_insrtUsuarioFootprint);

class MYPDF extends FPDF
{
	public $x1, $y1, $x2, $y2;

	public function Header()
	{
		//encabezado
		/*$this->SetFont("Arial", "B", 12);
		$this->Cell(0,4,"CENTRO ESTATAL DE CONTROL DE CONFIANZA CERTIFICADO",0,1,"C");
		$this->SetFont("Arial", "", 10);*/
		$this->Ln(6);
		//$this->Cell(0,4,utf8_decode("DIRECCIÓN DE INFORMACIÓN REGISTRO Y CADENA DE CUSTODIA"),0,1,"C");
		//$this->Ln(2);
		///$this->SetFont("Arial", "B", 12);
		//$this->Cell(0,4,utf8_decode("SEGUIMIENTO DE EVALUACIONES"),0,1,"C");

		//imagenes del poder ejecutivo y de gobierno del estado
		//$this->Image("../img/poderEjecutivo.jpg", 5, 5,30,23);
		//$this->Image("../img/gobiernoEstado.jpg", 172, 5,35);

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
}

$pdf = new MYPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial", "", 6);
$pdf->Cell(0,3,utf8_decode("Fecha de Impresión:").date('Y-m-d  H:m:i'),0,1,"R");
$pdf->SetFont("Arial", "", 10);
//parte datos de la persona
$pdf->x1 = 7;
$pdf->y1 = $pdf->GetY();
$pdf->SetWidths(array(40,60,40,60));
$pdf->Row_SinLine(array("Clave de Evaluado:",$row_srcEvaluado["CodigoEvaluado"],utf8_decode("Fecha de Evaluación:"),$row_srcEvalExamenes["FechaEvaluacion"]), "");
$pdf->Ln(3);
$pdf->Row_SinLine(array("Nombre de Evaluado:",utf8_decode($row_srcEvaluado["Nombre"]." ".$row_srcEvaluado["Paterno"]." ".$row_srcEvaluado["Materno"]),"",""), "");
$pdf->Ln(3);
$pdf->Row_SinLine(array("Puesto:",utf8_decode($row_srcEvaluado["Puesto"]),"No. de Oficio:",$row_srcEvaluado["cOficio"]), "");
$pdf->Ln(3);
$pdf->SetWidths(array(40,200));
$pdf->Row_SinLine(array("Dependencia:",utf8_decode($row_srcEvaluado["Dependencia"])), "");
$pdf->Ln(3);
$pdf->Row_SinLine(array("Subdependencia:","-"), "");

$pdf->x2 = 205;
$pdf->y2 = $pdf->GetY();

//dibujar rectangulo, ancho y alto, diferencia entre x e y actual con x e y iniciales
$pdf->Rect($pdf->x1, $pdf->y1, $pdf->x2-$pdf->x1, $pdf->y2-$pdf->y1);

$pdf->Ln(3);
//parte datos evaluacion actual

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(0,5,"RESULTADOS",0,1,"C");

$pdf->x1 = 7;
$pdf->y1 = $pdf->GetY();

//escribir la imagen en una carpeta
$imagen = file_get_contents("http://localhost:8080/ceccc/app/perfil_evaluado_imagen.php?q=".base64_encode($varImg));

if($imagen != "0")
{
	file_put_contents("tmp_foto/".$row_srcEvaluado["CURP"]."-".$row_srcEvaluado["NumeroEvaluacion"].".jpg",$imagen);
	$pdf->Image("tmp_foto/".$row_srcEvaluado["CURP"]."-".$row_srcEvaluado["NumeroEvaluacion"].".jpg", 165, $pdf->y1 + 5, 30);
}
else
{
	$pdf->Image("img/50x50.jpg", 165, $pdf->y1 + 5, 30);
}


$pdf->SetFont("Arial", "", 8);
$pdf->SetWidths(array(60,60,90));
$vigenciaEvaluacion = $row_srcEvaluado["descVigencia"];
do
{
	$pdf->Row_SinLine(array("RESULTADO ".utf8_decode($row_srcEvalExamenes["TipoExamen"]).":",$row_srcEvalExamenes["ResultadoExamen"],""), "");
}while($row_srcEvalExamenes = sqlsrv_fetch_array($srcEvalExamenes));
$pdf->Ln(3);
$pdf->SetFont("Arial", "B", 10);
$pdf->SetWidths(array(50,150));
$pdf->Row_SinLine(array("RESULTADO INTEGRAL",$row_srcEvaluado["cResultadoint"]), "");
$pdf->Ln(3);
$pdf->Row_SinLine(array("Fecha Resultado Integral",$row_srcEvaluado["fResultadoint"]), "");
$pdf->Ln(3);
$pdf->Row_SinLine(array("Vigencia",$vigenciaEvaluacion." meses"), "");
$pdf->Ln(3);
$pdf->SetWidths(array(50,40,50,50));
$pdf->Row_SinLine(array("FechaVigencia",$row_srcEvaluado["FechaVigencia"],"Status de Expediente",utf8_decode($row_srcEvaluado["Status_Analisis"])), "");
$pdf->x2 = 205;
$pdf->y2 = $pdf->GetY();

//dibujar rectangulo, ancho y alto, diferencia entre x e y actual con x e y iniciales
$pdf->Rect($pdf->x1, $pdf->y1, $pdf->x2-$pdf->x1, $pdf->y2-$pdf->y1);
$pdf->Ln(5);
//parte datos historico de evaluaciones
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(0,5,"HISTORICO DE EVALUACIONES",0,1,"C");
$pdf->SetFont("Arial", "B", 7);
$pdf->SetWidths(array(20,25,25,25,25,25,20,25));
if($totalRows_srcEvalPasadas > 0)
{
	$pdf->Row(array("Alta","Motivo","Puesto","Dependencia","Resultado","Fecha Resultado","Vigencia","Fecha Vigencia"), "");
	$pdf->SetFont("Arial", "", 7);
	do
	{
		list($anio, $mes, $dia) = explode("-",$row_srcEvalPasadas["FechaEvaluacion"]);
		$fechaVigencia = mktime(0,0,0,$mes + $row_srcEvalPasadas["VigenciaEvaluacion"], $dia, $anio);
		$fechaVigencia = date("Y", $fechaVigencia)."-".date("m",$fechaVigencia)."-".date("d", $fechaVigencia);

		$pdf->Row(array($row_srcEvalPasadas["FechaEvaluacion"],utf8_decode($row_srcEvalPasadas["TipoEvaluacion"]),utf8_decode($row_srcEvalPasadas["Puesto"]),utf8_decode($row_srcEvalPasadas["Dependencia"]),$row_srcEvalPasadas["cResultadoint"],$row_srcEvalPasadas["fResultadoint"],$row_srcEvalPasadas["descVigencia"],$row_srcEvalPasadas["fVigencia"]), "");
	}while($row_srcEvalPasadas = sqlsrv_fetch_array($srcEvalPasadas));
}
else
{
	$pdf->Cell(0,5,utf8_decode("NO TIENE EVALUACIONES PREVIAS A LA EVALUACIÓN ACTUAL"),0,1);
}
$pdf->Output("Seguimiento Evaluaciones","I");

sqlsrv_free_stmt($srcEvalExamenes);
sqlsrv_free_stmt($srcEvalPasadas);
sqlsrv_free_stmt($srcEvaluado);