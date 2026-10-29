<?php
include("config.php");

$rutCliente = $_POST['rutCliente'];

$qry 		= "SELECT * FROM dbtmedia.tbclientes WHERE rut_cliente = '$rutCliente'";
$result 	= mysql_query($qry);
$Reg   	 	= mysql_fetch_array($result);
$count  	= mysql_num_rows($result);

echo $count;