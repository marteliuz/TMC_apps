<?php
require('config.php');
require("lib_functions.php");

$id_cliente = $_POST['id_cliente'];
if($id_cliente!="")
{
	$qry = "UPDATE dbtmedia.tbclientes SET activo='0' WHERE idtbclientes='$id_cliente'";
	mysql_query($qry);
	$var = mysql_affected_rows();
	if ($var==1)
	{
		echo "OK";
	}else{
		echo "NO";
	}
}else{
	echo "NO";
}
?>