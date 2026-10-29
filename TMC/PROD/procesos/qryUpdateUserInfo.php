<?php
include("config.php");
session_start();
$idtb     = $_POST['idtb'];
$nombre   = $_POST['nombre'];
$username = $_POST['username'];
$password = $_POST['password'];
$email    = $_POST['email'];
$estado   = $_POST['estado'];
$tipo	  = $_POST['tipo'];
$cliente  = $_POST['cliente'];

$qry = "SELECT * FROM dbtmedia.tbusuarios WHERE username = '$username' AND idtbusuarios <> '$idtb' AND estatus = 1";
mysql_query($qry);
$var = mysql_affected_rows();
if($var!=0)
{
	echo "ERROR USERNAME";
}else{
	$qry = "UPDATE dbtmedia.tbusuarios SET username='$username', password='$password', nombre='$nombre', estatus='$estado', cliente='$cliente', tipo='$tipo', email='$email' WHERE idtbusuarios = '$idtb'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if($var==1)
	{
		echo "OK";
	}else{
		echo "NO";
	}
}
?>