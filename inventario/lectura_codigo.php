<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");

	$codigo	= trim($_POST['codigo']);


	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("dbmaster",$con);

	$result= mysql_query("SELECT * FROM tbproductos WHERE part_number='$codigo'");
	$Reg = mysql_fetch_array($result);
	echo $Reg['nombre'].";".$Reg['categoria'].";".$Reg['marca'].";".$Reg['moneda'].";".$Reg['precio'];
	



?>