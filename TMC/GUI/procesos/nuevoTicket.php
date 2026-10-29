<?php
include("config.php");
require("lib_functions.php");

session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
if(isset($_SESSION['Usuario']))
{
	$username = $_SESSION['Usuario'];
	if(isAdmin($username)==true)
	{
		// echo "Ticket creado por el usuario ".$username." que es un administrador";
		header("location:ticket_admin_user.php");

	}else{
		// echo "Ticket creado por el usuario ".$username." que es un usuario asociado a un cliente";
		header("location:ticket_client_user.php");
	}
}else{
	// echo "Se creara ticket por un usuario externo";
	header("location:ticket_external_user.php");
}
?>