<?php
// require_once('../Connections/connCeCCC.php');

// $varImg = base64_decode($_GET["q"]);

// if(is_numeric($varImg))
// {
// 	//obtener la imagen
// 	$query_srcImagen = "SELECT Picture, Curp FROM tblImgData WHERE periodo = (SELECT NumeroEvaluacion FROM evaluaciones WHERE FechaEvaluacion = (SELECT MAX(FechaEvaluacion) FROM evaluaciones WHERE idPadron = ".$varImg.") and idPadron = ".$varImg.") AND curp = (SELECT CURP FROM evaluaciones WHERE FechaEvaluacion = (SELECT MAX(FechaEvaluacion) FROM evaluaciones WHERE idPadron = ".$varImg.") and idPadron = ".$varImg.")";

// }
// else
// {
// 	list($numEvaluacion, $curp) = explode("-", $varImg);
// 	//obtener la imagen
// 	$query_srcImagen = "SELECT Picture, Curp FROM tblImgData WHERE periodo = ".$numEvaluacion." AND curp = '".$curp."'";
// }

// $srcImagen = sqlsrv_query($connCeCCC, $query_srcImagen,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));
// $row_srcImagen = sqlsrv_fetch_array($srcImagen);
// $totalRows_srcImagen = sqlsrv_num_rows($srcImagen);

// if($totalRows_srcImagen > 0)
// {
	header("Content-type:  image/jpeg");
	print base64_decode($_GET["foto"]);
