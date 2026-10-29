<?php
require("config.php");
session_start();

// ajax.send("id_ticket="+id_ticket+"&fecha="+fecha+"&tipo="+tipo);
$id_ticket   = $_POST['id_ticket'];
$fechaReview = $_POST['fecha'];
$tipo        = $_POST['tipo'];
$usuario     = $_SESSION['Usuario'];

if($tipo==1)
{
	$qry = "UPDATE dbtmedia.tbtickets SET ultima_revision ='$fechaReview', estado='1', usuario='$usuario' WHERE id_ticket='$id_ticket'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if($var==1){
		echo "<br>".$var." row updated | ticket actualizado...";
	}else{
		echo "<br>No updated...";
	}
}
if($tipo==2)
{
	$qry = "UPDATE dbtmedia.tbexternaltickets SET ultima_revision ='$fechaReview', estado='1', usuario='$usuario' WHERE id_ticket='$id_ticket'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if($var==1){
		echo "<br>".$var." row updated | ticket actualizado...";
	}else{
		echo "<br>No updated...";
	}
}
?>