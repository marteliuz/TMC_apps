<?
require('config.php');
require("lib_functions.php");

$id_cliente = $_POST['id_cliente'];
$id_terminal = $_POST['id_terminal'];
$id_contrato = $_POST['id_contrato'];

$qry = "UPDATE dbtmedia.tbterminales SET contrato='$id_contrato' WHERE idtbterminales='$id_terminal' AND cliente = '$id_cliente'";
mysql_query($qry);
$var = mysql_affected_rows();
if($var==0){echo "NO";}
if($var==1){echo "OK";}
?>