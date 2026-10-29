<?php
include("config.php");
session_start();

$nomb_cliente    = $_POST['nomb_cliente'];
$rut_cliente     = $_POST['rut_cliente'];
$telef_cliente   = $_POST['telef_cliente'];
$giro_cliente    = $_POST['giro_cliente'];
$sigla_cliente   = $_POST['sigla_cliente'];
$dir_cliente     = $_POST['dir_cliente'];
$reg_cliente     = $_POST['reg_cliente'];
$nomb_contacto   = $_POST['nomb_contacto'];
$cargo_contacto  = $_POST['cargo_contacto'];
$email_contacto  = $_POST['email_contacto'];
$telef_contacto  = $_POST['telef_contacto'];
$movil_contacto  = $_POST['movil_contacto'];
$dir_contacto    = $_POST['dir_contacto'];
$reg_contacto    = $_POST['reg_contacto'];
$ciudad_cliente  = $_POST['ciudad_cliente'];
$ciudad_contacto = $_POST['ciudad_contacto'];

// echo "<br>".$nomb_cliente;echo "<br>".$rut_cliente;echo "<br>".$telef_cliente;echo "<br>".$giro_cliente;echo "<br>".$sigla_cliente;echo "<br>".$dir_cliente;echo "<br>".$reg_cliente;echo "<br>".$nomb_contacto;echo "<br>".$cargo_contacto;echo "<br>".$email_contacto;echo "<br>".$telef_contacto;echo "<br>".$movil_contacto;echo "<br>".$dir_contacto;echo "<br>".$reg_contacto;echo "<br>".$ciudad_cliente;echo "<br>".$ciudad_contacto."<br>";
$qry = "SELECT idtbclientes FROM dbtmedia.tbclientes WHERE rut_cliente = '$rut_cliente'";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows == 0)
{
	$qry = "INSERT INTO dbtmedia.tbclientes (nombre_cliente, rut_cliente, telef_cliente, sigla, direccion_cliente, region_cliente, giro_cliente, nombre_contacto, email_contacto, telef_contacto, movil_contacto, direccion_contacto, region_contacto, cargo_contacto, ciudad_cliente, ciudad_contacto) VALUES ('$nomb_cliente', '$rut_cliente', '$telef_cliente', '$sigla_cliente', '$dir_cliente', '$reg_cliente', '$giro_cliente', '$nomb_contacto', '$email_contacto', '$telef_contacto', '$movil_contacto', '$dir_contacto', '$reg_contacto', '$cargo_contacto', '$ciudad_cliente', '$ciudad_contacto')";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if ($var==1)
	{
		echo "OK";
	}else{
		echo "NO";
	}
}else{
	echo "ERROR RUT";
}
?>
