<?php
include("config.php");
require("lib_functions.php");
require("lib_mail.php");
session_start();

$tipo = 1;
$fecha_creacion  = $_POST['fecha_creacion'];
$id_cliente      = $_POST['id_cliente'];
$nomb_cliente    = $_POST['nomb_cliente'];
$nomb_contacto   = $_POST['nomb_contacto'];
$telef_contacto  = $_POST['telef_contacto'];
$movil_contacto  = $_POST['movil_contacto'];
$email_contacto  = $_POST['email_contacto'];
$dir_contacto    = $_POST['dir_contacto'];
$id_terminal     = $_POST['id_terminal'];
$modelo_terminal = $_POST['modelo_terminal'];
$nserie_terminal = $_POST['nserie_terminal'];
$nserie_falla    = $_POST['nserie_falla'];
$detalle_falla   = $_POST['detalle_falla'];

$qry = "INSERT INTO dbtmedia.tbtickets (tipo, fecha_creacion, id_cliente, nombre_cliente, nombre_contacto, telef_contacto, movil_contacto, email_contacto, direccion_contacto, id_terminal, modelo_terminal, nserie_terminal, nserie_falla, detalle_falla) VALUES ('1', '$fecha_creacion', '$id_cliente', '$nomb_cliente', '$nomb_contacto', '$telef_contacto', '$movil_contacto', '$email_contacto', '$dir_contacto', '$id_terminal', '$modelo_terminal', '$nserie_terminal', '$nserie_falla', '$detalle_falla')";
mysql_query($qry);
$var = mysql_affected_rows();
if ($var==1)
{
	$id_ticket = getNewIDTicket(mysql_insert_id());
	echo "OK|".$id_ticket;
	sendEmail($email_contacto, $id_ticket, $nomb_cliente);
}else{
	echo "NO";
}
?>