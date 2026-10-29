<?php
include("config.php");
require("lib_functions.php"); 

$id_cliente = $_POST['id_cliente'];
echo getCmbContratosByCliente("cmbContratos", $id_cliente);
?>