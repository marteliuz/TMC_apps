<?php
require_once "config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT nombre_cliente from tbclientes where nombre_cliente LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['nombre_cliente'];
	echo "$cname\n";
}
?>