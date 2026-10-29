<?php
include("config.php");
include("lib_functions.php");

$fecha_inicio  = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];
$descripcion   = $_POST['descripcion'];
$id_terminal   = $_POST['id_terminal'];

$qry = "INSERT INTO dbtmedia.tbcontratos_polycom (id_terminal, fecha_inicio, fecha_termino, descripcion) VALUES ('$id_terminal', '$fecha_inicio', '$fecha_termino', '$descripcion')";
mysql_query($qry);
$id_contrato = mysql_insert_id();
$var = mysql_affected_rows();

if ($var==1){$echo = "OK";}else{$echo = "NO";}

if($echo=="OK")
{
	$qry ="UPDATE dbtmedia.tbterminales SET contrato_polycom='$id_contrato' WHERE idtbterminales='$id_terminal'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if ($var==1){echo "OK";}else{echo "NO";}
}else{
	echo "NO";
}
?>