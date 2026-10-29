<?php
include("config.php");
session_start();

$id_terminal = $_POST['id_terminal'];
$id_cliente  = $_POST['id_cliente'];
$id_contrato = $_POST['id_contrato'];

$qry ="UPDATE dbtmedia.tbterminales SET cliente='$id_cliente', contrato='$id_contrato' WHERE idtbterminales='$id_terminal'";
// echo $qry;
mysql_query($qry);
$var = mysql_affected_rows();
if($var==0){echo "NO";}
if($var==1){echo "OK";}
?>