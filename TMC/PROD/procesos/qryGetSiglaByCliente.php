<?php
include("config.php");
include("lib_functions.php");

$id_cliente = $_POST['id_cliente'];

$qry = "SELECT * FROM dbtmedia.tbclientes WHERE idtbclientes = '$id_cliente'";
$result = mysql_query($qry);
$Reg = mysql_fetch_array($result);

echo $Reg['sigla'];







?>