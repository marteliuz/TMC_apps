<?php

include ("libreria.php");

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
mysql_select_db("dbmaster",$con);


$id        = $_GET['id'];

echo $id;

?>