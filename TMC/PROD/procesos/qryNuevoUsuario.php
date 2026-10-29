<?php
include("config.php");
session_start();
// ajax.send("nombre="+nomb_usuario+"&username="+username+"&password="+password+"&email="+email+"&cliente="+cliente+"&tipo="+tipo);
$nomb_usuario = $_POST['nombre'];
$username     = $_POST['username'];
$password     = $_POST['password'];
$email        = $_POST['email'];
$cliente      = $_POST['cliente'];
$tipo	      = $_POST['tipo'];

$qry      = "SELECT * FROM dbtmedia.tbusuarios WHERE username = '$username' AND estatus=1";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows == 0)
{
	$qry = "INSERT INTO dbtmedia.tbusuarios (username, password, nombre, estatus, cliente, tipo, email) VALUES ('$username', '$password', '$nomb_usuario', '1', '$cliente', '$tipo', '$email')";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if ($var==1)
	{
		echo "OK";
	}else{
		echo "NO";
	}
}else{
	echo "ERROR USUARIO";
}
?>