 <?php
include("config.php");
// ajax.send("nomb_cliente="+nomb_cliente+"&rut_cliente="+rut_cliente+"&telef_cliente="+telef_cliente+"&giro_cliente="+giro_cliente+"&dir_cliente="+dir_cliente+"&reg_cliente="+region_cliente+"&nomb_contacto="+nomb_contacto+"&cargo_contacto="+cargo_contacto+"&email_contacto="+email_contacto+"&telef_contacto="+telef_contacto+"&movil_contacto="+movil_contacto+"&dir_contacto="+dir_contacto+"&reg_contacto="+region_contacto+"&idtb="+idtb);
$id             = $_POST['idtb'];
$nomb_cliente   = $_POST['nomb_cliente'];
$rut_cliente    = $_POST['rut_cliente'];
$telef_cliente  = $_POST['telef_cliente'];
$giro_cliente   = $_POST['giro_cliente'];
$sigla_cliente  = $_POST['sigla_cliente'];
$dir_cliente    = $_POST['dir_cliente'];
$reg_cliente    = $_POST['reg_cliente'];
$nomb_contacto  = $_POST['nomb_contacto'];
$cargo_contacto = $_POST['cargo_contacto'];
$email_contacto = $_POST['email_contacto'];
$telef_contacto = $_POST['telef_contacto'];
$movil_contacto = $_POST['movil_contacto'];
$dir_contacto   = $_POST['dir_contacto'];
$reg_contacto   = $_POST['reg_contacto'];
$ciudad_cliente  = $_POST['ciudad_cliente'];
$ciudad_contacto = $_POST['ciudad_contacto'];

$qry = "UPDATE dbtmedia.tbclientes SET nombre_cliente='$nomb_cliente', rut_cliente='$rut_cliente', telef_cliente='$telef_cliente', direccion_cliente='$dir_cliente', region_cliente='$reg_cliente', giro_cliente='$giro_cliente', sigla= '$sigla_cliente', nombre_contacto='$nomb_contacto', email_contacto='$email_contacto', telef_contacto='$telef_contacto', movil_contacto='$movil_contacto', direccion_contacto='$dir_contacto', region_contacto='$reg_contacto', cargo_contacto='$cargo_contacto', ciudad_cliente='$ciudad_cliente', ciudad_contacto='$ciudad_contacto' WHERE idtbclientes='$id'";
mysql_query($qry);
$var = mysql_affected_rows();
if ($var==1)
{
	echo 1;
}else{
	echo 0;
}
?>