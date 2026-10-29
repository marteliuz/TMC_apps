<?php
include("config.php");
session_start();

// ajax.send("cliente="+cmbClientes+"&modelo="+cmbModelos+"&nserie="+nserie+"&nserie_camara="+nserie_camara+"&nserie_mic="+nserie_mic+"&nserie_cremoto="+nserie_cremoto+"&ubicacion="+ubicacion);

$cliente        = $_POST['cliente'];
$modelo         = $_POST['modelo'];
$nserie         = $_POST['nserie'];
$nserie_camara  = $_POST['nserie_camara'];
$nserie_mic     = $_POST['nserie_mic'];
$nserie_cremoto = $_POST['nserie_cremoto'];
$ubicacion      = $_POST['ubicacion'];
$idtb           = $_POST['idtb'];

$qry = "UPDATE dbtmedia.tbterminales SET cliente = '$cliente', modelo = '$modelo', nserie = '$nserie', nserie_camara = '$nserie_camara', nserie_mic = '$nserie_mic', nserie_cremoto = '$nserie_cremoto', ubicacion = '$ubicacion' WHERE idtbterminales = '$idtb'";
mysql_query($qry);
$var = mysql_affected_rows();
if($var==1)
{
	echo "OK";
}else{
	echo "NO";
}
?>