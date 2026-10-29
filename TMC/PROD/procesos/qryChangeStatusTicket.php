<?php
require('config.php');
require("lib_functions.php");
session_start();

$id_ticket = $_POST['id_ticket'];
$status    = $_POST['status'];
$username  = $_SESSION['Usuario'];

if($status==1){
	$qry = "UPDATE dbtmedia.tbtickets SET estado = '$status', usuario = '$username', fecha_revision = NOW() WHERE idtbtickets = '$id_ticket'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if($var!=0)
	{
		echo "OK";
	}else{
		echo "NO";
	}
}
if($status==2){
	$qry = "UPDATE dbtmedia.tbtickets SET estado = '$status', usuario = '$username', fecha_cierre = NOW() WHERE idtbtickets = '$id_ticket'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if($var!=0)
	{
		echo "OK";
	}else{
		echo "NO";
	}
}
?>