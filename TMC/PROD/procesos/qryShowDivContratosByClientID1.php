<?php
include("config.php");
require("lib_functions.php"); 

$id_cliente = $_POST['id_cliente'];

	$qry = "SELECT * FROM dbtmedia.tbterminales WHERE idtbterminales = '$id_terminales'";
	$result = mysql_query($qry);
	$Reg = mysql_fetch_array($result);
	
	$id_clientes = $Reg['cliente'];
	
echo getCmbContratosByCliente1("cmbContratos", $id_cliente);
?>