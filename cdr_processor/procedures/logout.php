<?php

//@date        : 2014/08/23
//@autor       : Marteliuz
//@Modified by : Paulo Ossandon
//@Date        : 2014/11/29

//include file config.php for connection bd
include("../cnfg/config.php");
//include library lib_log.php for create log
include("lib_log.php");

//Star session
session_start();
//Control of excepcion
try{
	mysql_close($conexion);
	session_destroy();
	log_info("Sesión cerrada...");
	echo "OK";
}catch(Exception $e)
{
	log_error("Error al cerrar sesión");
	echo "ERROR";
}
?>