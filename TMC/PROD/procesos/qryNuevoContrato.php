<?php
include("config.php");
include("lib_functions.php");

$cliente       = $_POST['cliente'];
$cliente_final = $_POST['cliente_final'];
$vigente       = $_POST['vigente'];
$fecha_inicio  = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];
$sla           = $_POST['sla'];
$tipo_contrato = $_POST['tipo_contrato'];
$sigla_cliente = $_POST['sigla_cliente'];
$sigla_cliente_final = $_POST['sigla_cliente_final'];

$qry = "INSERT INTO dbtmedia.tbcontratos (cliente, cliente_final, vigente, fecha_inicio, fecha_termino, SLA, tipo_contrato, sigla_cliente, sigla_cliente_final) VALUES ('$cliente', '$cliente_final', '$vigente', '$fecha_inicio', '$fecha_termino', '$sla', '$tipo_contrato', '$sigla_cliente', '$sigla_cliente_final')";
// echo $qry;
mysql_query($qry);
$last_insert = mysql_insert_id();

$var = mysql_affected_rows();
if ($var==1)
{
	$id_contrato = getNewIDContrato($last_insert);
	echo "OK|".$id_contrato;
}else{
	echo "NO";
}
?>