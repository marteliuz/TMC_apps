<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");

	$encargado		= $_POST['encargado1'];
	$fecha			= DateConvertD($_POST['fecha1']);
	$correcto		= $_POST['correcto'];
	$lugar			= $_POST['lugar'];
	
	
	if ($correcto=="1"){ 
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("inventario",$con);

$result= mysql_query("UPDATE inventario SET Encargado_Control='$encargado', Fecha_Control='$fecha' WHERE Lugar='$lugar'",$con);
	
	$var = mysql_affected_rows();
	
	if ($var>0){echo "OK";
	}else{
	echo"NO";
	
mysql_close($con);
	
	}
}