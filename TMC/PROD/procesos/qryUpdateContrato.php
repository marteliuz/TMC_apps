<?php
include("config.php");
include("lib_functions.php");

$idtb		   		 = $_POST['idtb'];
$id_contrato   		 = $_POST['id_contrato'];

$cliente       		 = $_POST['cliente'];
$sigla_cliente 		 = $_POST['sigla_cliente'];
$cliente_final 		 = $_POST['cliente_final'];
$sigla_cliente_final = $_POST['sigla_cliente_final'];
$vigente       		 = $_POST['vigente'];
$fecha_inicio  		 = dateConvertSQL($_POST['fecha_inicio']);
$fecha_termino 		 = dateConvertSQL($_POST['fecha_termino']);
$sla           		 = $_POST['sla'];
$tipo_contrato 		 = $_POST['tipo_contrato'];

$qry = "UPDATE dbtmedia.tbcontratos SET cliente='$cliente', sigla_cliente='$sigla_cliente', cliente_final='$cliente_final', sigla_cliente_final='$sigla_cliente_final', vigente='$vigente', fecha_inicio='$fecha_inicio', fecha_termino='$fecha_termino', sla='$sla', tipo_contrato='$tipo_contrato' WHERE idtbcontratos = '$idtb'";
mysql_query($qry);
$var = mysql_affected_rows();
if($var>0)
{
	$id_contrato = getNewIDContrato($idtb);
	echo "OK|".$id_contrato;
}else{
	echo "NO";
}