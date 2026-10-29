 <?php
include("config.php");
// ajax.send("id="+id+"&nro_serie="+nro_serie+"&serie_camara="+serie_camara+"&serie_mic="+serie_mic+"&serie_cremoto="+serie_cremoto+"&ubicacion="+ubicacion+"&modelo="+modelo+"&cliente="+cliente+"&contratos="+contratos);
$id             = $_POST['id'];
$nro_serie	    = $_POST['nro_serie'];
$serie_camara   = $_POST['serie_camara'];
$serie_mic	    = $_POST['serie_mic'];
$serie_cremoto  = $_POST['serie_cremoto'];
$ubicacion	    = $_POST['ubicacion'];
$modelo		    = $_POST['modelo'];
$cliente	    = $_POST['cliente'];
$contrato	    = $_POST['contratos'];

$qry = "UPDATE dbtmedia.tbterminales SET nserie='$nro_serie', modelo='$modelo', cliente='$cliente', ubicacion='$ubicacion', nserie_camara='$serie_camara', nserie_mic='$serie_mic', nserie_cremoto= '$serie_cremoto', contrato='$contrato' WHERE idtbterminales='$id'";
mysql_query($qry);
$var = mysql_affected_rows();
if ($var==1)
{
	echo 1;
}else{
	echo 0;
}


?>