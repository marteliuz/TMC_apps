<?php
require("config.php");

// ajax.send("id_ticket="+id_ticket+"&asignado="+asignado+"&observ="+observ+"&tipo="+tipo);
$id_ticket = $_POST['id_ticket'];
$asignado  = $_POST['asignado'];
$observ    = $_POST['observ'];
$tipo      = $_POST['tipo'];

if($tipo==1)
{
	$qry = "UPDATE dbtmedia.tbtickets SET asignado ='$asignado', observaciones='$observ' WHERE id_ticket='$id_ticket'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if($var==1){
		echo "<br>".$var." row updated | cambios guardados...";
	}else{
		echo "<br> No updated...";
	}
}
if($tipo==2)
{
	$qry = "UPDATE dbtmedia.tbexternaltickets SET asignado ='$asignado', observaciones='$observ' WHERE id_ticket='$id_ticket'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if($var==1){
		echo "<br>".$var." row updated | cambios guardados...";
	}else{
		echo "<br> No updated...";
	}
}
?>