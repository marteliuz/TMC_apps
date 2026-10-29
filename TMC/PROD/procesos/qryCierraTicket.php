<?php
require("config.php");
session_start();

// ajax.send("id_ticket="+id_ticket+"&asignado="+asignado+"&observ="+observ+"&fecha="+fecha);
$id_ticket   = $_POST['id_ticket'];
$fechaReview = $_POST['fecha'];
$usuario     = $_SESSION['Usuario'];
$asignado    = $_POST['asignado'];
$observ      = $_POST['observ'];
$tipo        = $_POST['tipo'];

if($tipo==1)
{
	$qry = "UPDATE dbtmedia.tbtickets SET ultima_revision='$fechaReview', fecha_cierre='$fechaReview', estado='2', asignado='$asignado', observaciones='$observ', usuario='$usuario' WHERE id_ticket='$id_ticket'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if($var==1){
		echo "<br>".$var." row updated | ticket cerrado...";
	}else{
		echo "<br> No updated...";
	}
}
if($tipo==2)
{
	$qry = "UPDATE dbtmedia.tbexternaltickets SET ultima_revision='$fechaReview', fecha_cierre='$fechaReview', estado='2', asignado='$asignado', observaciones='$observ', usuario='$usuario' WHERE id_ticket='$id_ticket'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if($var==1){
		echo "<br>".$var." row updated | ticket cerrado...";
	}else{
		echo "<br> No updated...";
	}
}
?>