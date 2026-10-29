<?php
include("config.php");
include("lib_functions.php");

$id_contrato = $_POST['id_contrato'];
$f_inicio    = dateConvertSQL($_POST['fecha_inicio']);
$f_termino   = dateConvertSQL($_POST['fecha_termino']);
$descripcion = $_POST['descripcion'];

//echo $id_contrato."\n".$f_inicio."\n".$f_termino."\n".$descripcion;

$qry = "UPDATE dbtmedia.tbcontratos_polycom SET fecha_inicio='$f_inicio', fecha_termino='$f_termino', descripcion='$descripcion' WHERE idtbcontratos_polycom='$id_contrato'";
mysql_query($qry);
$var = mysql_affected_rows();
if($var==1)
{
	echo "OK";
}else{
	echo "NO";
}
?>