<?php
session_start();
if(isset($_SESSION['Usuario']))
{ 
	$usuario = $_SESSION['Usuario'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Control de Incidentes - Menu Principal</title>
</head>

<body>
	<p align="right"><strong>Ha iniciado sesión como: </strong><?php echo $usuario;?> <a href="../procesos/logout.php">Cerrar Sesión</a></p>
	<br><a href="../procesos/nuevoTicket.php">Crear nuevo Ticket</a>
	<br><a href="../procesos/ticketsRevisados.php">Seguimiento de Tickets</a>
</body>
</html>
<?php
}else{ 
	// Usuario que no se ha logueado 
	//header("location:../errores/SinPermisos.php");
	echo "Usuario sin permisos.";
}
?>