<?php
include("config.php");
require("lib_functions.php"); 

$id_cliente = $_POST['id_cliente'];
echo getCmbterminalesByIdCliente("cmbTerminales", "showTerminalesAndContratosByClientID()", $id_cliente);
?>