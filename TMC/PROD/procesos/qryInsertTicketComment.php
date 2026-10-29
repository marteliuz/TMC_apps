<?php
require('config.php');
require("lib_functions.php");

// ajax.send("id_ticket="+id_ticket+"&origen="+origen+"&comment="+comment+"&fecha="+fecha);

$id_ticket = $_POST['id_ticket'];
$origen    = $_POST['origen'];
$comment   = $_POST['comment'];
$fecha     = $_POST['fecha'];

// echo "<br>".$id_ticket;echo "<br>".$origen;echo "<br>".$comment;echo "<br>".$fecha;

$qry = "INSERT INTO dbtmedia.tbcomments (id_ticket, origen, comment, fecha) VALUES ('$id_ticket', '$origen', '$comment', '$fecha')";
mysql_query($qry);
$var = mysql_affected_rows();
if ($var==1)
{
	echo "<IMG src='../resources/ok.png'><strong> OK</strong>";
	echo "<br>".$var." row(s) inserted";
}else{
	echo "<IMG src='../resources/error.png'><strong> No se completo la transacci&oacute;n. Verifique la informaci&oacute;n e int&eacute;ntelo nuevamente.</strong>";
}
?>