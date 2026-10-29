<?php
// Configuracion de la Base de Datos.
	$host         = "localhost"; // Host name 
	$username     = "usergui"; // Mysql username 
	$password     = "Touchmedia"; // Mysql password 
	$db_name      = "dbtmedia"; // Database name 
	$conexion     = mysql_connect($host,$username,$password);
	mysql_select_db($db_name, $conexion) OR DIE ("No se Puede Conectar");
	mysql_query("SET NAMES 'utf8'"); //seteamos las consultas con charset UTF-8 para acentos o special chars
	
?>