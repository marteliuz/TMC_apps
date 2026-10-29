<?php
include("config.php");
require("lib_functions.php"); 

$id_terminales = $_POST['id_terminales'];

	$qry = "SELECT * FROM dbtmedia.tbterminales WHERE idtbterminales = '$id_terminales'";
	$result = mysql_query($qry);
	$Reg = mysql_fetch_array($result);
	
	$id_clientes = $Reg['cliente'];

echo getCmbterminalesWithoutIdCliente("cmbClientes", "showTerminalesAndContratosByClientID1()", $id_clientes);
?>