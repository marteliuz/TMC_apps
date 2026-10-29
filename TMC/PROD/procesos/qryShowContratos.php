<?php
require('config.php');
require("lib_functions.php");

$id_cliente = $_POST['id_cliente'];

$qry      = "SELECT * FROM dbtmedia.tbcontratos WHERE cliente = '$id_cliente'";
$result   = mysql_query($qry,$conexion);
$num_rows = mysql_num_rows($result);

if($num_rows==0)
{
	echo "<IMG src='../resources/error.png'><strong>No existe un contrato asociado al cliente.</strong>";
	echo "<br><a href='../procesos/nuevoContrato.php'>Agregar Contrato</a>";
}else{
	echo getCmbContratosByCliente("cmbContratos", "$id_cliente");
}
?>