<?php
require('config.php');
require("lib_functions.php");

$id_ticket       = $_POST['id_ticket'];
$detalle_interno = $_POST['detalle_interno'];

$qry = "UPDATE dbtmedia.tbtickets SET detalle_interno = '$detalle_interno' WHERE idtbtickets = '$id_ticket'";
mysql_query($qry);
$var = mysql_affected_rows();
if($var!=0)
{
	echo "OK";
}else{
	echo "NO";
}
?>