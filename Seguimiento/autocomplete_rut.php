<?php
$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);
	
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT Rut_Clientes from clientes where Rut_Clientes LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['Rut_Clientes'];
	echo "$cname\n";
}
?>