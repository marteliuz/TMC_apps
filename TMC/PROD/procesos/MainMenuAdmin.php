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
<script src="../js/jquery-1.3.2.min.js"></script>
<script src="../js/SpryAccordion.js" type="text/javascript"></script>
<link href="../css/SpryAccordion.css" rel="stylesheet" type="text/css" />
<SCRIPT>
	$(document).ready(function() 
	{
		$("#DIValertas").load("qryAlertas.php");
		var interv = 30000;
		var refreshId = setInterval(function() 
		{
			$("#DIValertas").load('qryAlertas.php?randval='+ Math.random());
		}, interv);
	}
	);
</SCRIPT>
<SCRIPT>
	$(document).ready(function() 
	{
		$("#DIVvencimientos").load("qryVencimientos.php");
		var interv = 30000;
		var refreshId = setInterval(function() 
		{
			$("#DIVvencimientos").load('qryVencimientos.php?randval='+ Math.random());
		}, interv);
	}
	);
</SCRIPT>
<style type="text/css">
<!--
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
	font-style:oblique;
	background-color: #999;
}
#DIValertas {
	position:absolute;
	top:100px;
	right:50px;
}
#DIVvencimientos {
	position:absolute;
	top:250px;
	right:50px;
}
#sesion {
	position:absolute;
	top:50px;
	right:50px;
}
#AccorMenu {
	position:absolute;
	top:100px;
	left:50px;
	width:600px;
}
#foot {
	font-family: Arial, Helvetica, sans-serif;
	font-size:8px;
	position:fixed;
	left:0px;
	bottom: 0;
	height: 65px;
	width: 100%;
	background: #cecece;
	}
-->
</style>
</head>
<body>
	<div id="DIValertas">Alertas</div>
	<div id="DIVvencimientos">Vencimientos</div>
	<div id="sesion"><p><strong>Ha iniciado sesión como: </strong><?php echo $usuario;?> <a href="../procesos/logout.php">Cerrar Sesión</a></p></div>
	<div id="AccorMenu" class="Accordion" tabindex="0">
	
		<div class="AccordionPanel">
        <div class="AccordionPanelTab">Tickets</div>
			<div class="AccordionPanelContent" align="center" style="vertical-align:middle">
			    <br />
                <table>
                    <tr>
                        <td align="center"><a href="../procesos/nuevoTicket.php"><img src="../resources/add_ticket.png" /></a></td>
                        <td align="center" width="48px"></td>
                        <td align="center"><a href="../procesos/TicketsAbiertos.php"><img src="../resources/open_tickets.png" /></a></td>
                        <td align="center" width="48px"></td>
                        <td align="center"><a href="../procesos/BuscarTickets.php"><img src="../resources/search_ticket.png" /></a></td>
						<td align="center" width="48px"></td>
                        <td align="center"><a href="../procesos/xls_Tickets.php"><img src="../resources/export_xls.png" /></a></td>
                    </tr>
                    <tr>
                        <td><a href="../procesos/nuevoTicket.php">Crear nuevo Ticket</a></td>
                        <td align="center"></td>
                        <td><a href="../procesos/TicketsAbiertos.php">Tickets Abiertos</a></td>
						<td align="center"></td>
						<td><a href="../procesos/BuscarTickets.php">Buscar Tickets</a></td>
						<td align="center"></td>
						<td><a href="../procesos/xls_Tickets.php">Exportar Tickets</a></td>
                    </tr>
                </table>
			</div>
		</div>
	
		<div class="AccordionPanel">
		<div class="AccordionPanelTab">Clientes</div>
			<div class="AccordionPanelContent" align="center" style="vertical-align:middle">
			    <br />
                <table>
                    <tr>
                        <td align="center"><a href="../procesos/nuevoCliente.php"><img src="../resources/add_customer.png" /></a></td>
                        <td align="center" width="48px"></td>
                        <td align="center"><a href="../procesos/alterCliente.php"><img src="../resources/edit_customer.png" /></a></td>
                    </tr>
                    <tr>
                        <td><a href="../procesos/nuevoCliente.php">Crear nuevo cliente</a></td>
                        <td align="center"></td>
                        <td><a href="../procesos/alterCliente.php">Modificar cliente</a></td>
                    </tr>
                </table>
			</div>
		</div>
		
		<div class="AccordionPanel">
		<div class="AccordionPanelTab">Contratos</div>
			<div class="AccordionPanelContent" align="center" style="vertical-align:middle">
			    <br />
                <table>
                    <tr>
                        <td align="center"><a href="../procesos/nuevoContrato.php"><img src="../resources/contrato.png" /></a></td>
                        <td align="center" width="48px"></td>
                        <td align="center"><a href="../procesos/alterContrato.php"><img src="../resources/contrato.png" /></a></td>
						<td align="center" width="48px"></td>
						<td align="center"><a href="../procesos/alterContratoPolycom.php"><img src="../resources/contratoPolycom.png" /></a></td>
					</tr>
                    <tr>
                        <td><a href="../procesos/nuevoContrato.php">Nuevo Contrato Cliente</a></td>
                        <td align="center"></td>
                        <td><a href="../procesos/alterContrato.php">Modificar Contrato Cliente</a></td>
						<td align="center"></td>
						<td><a href="../procesos/alterContratoPolycom.php">Modificar Contrato Polycom</a></td>
                    </tr>
					<tr>
						<td></td>
						<td align="center" width="48px"></td>
						<td align="center"><a href="../procesos/VerContrato.php"><img src="../resources/contrato_ver.png" /></a></td>
					</tr>
					<tr>
						<td></td>
						<td align="center" width="48px"></td>
                        <td align="center" ><a href="../procesos/VerContrato.php">Ver Contrato Cliente</a></td>
                        <td align="center"></td>
					</tr>
                </table>
			</div>
		</div>
		
		<div class="AccordionPanel">
        <div class="AccordionPanelTab">Terminales</div>
			<div class="AccordionPanelContent" align="center" style="vertical-align:middle">
			    <br />
                <table>
                    <tr>
                        <td align="center"><a href="../procesos/nuevoTerminal.php"><img src="../resources/add_endpoint.png" /></a></td>
                        <td align="center" width="48px"></td>
                        <td align="center"><a href="../procesos/SearchTerminales.php"><img src="../resources/edit_endpoint.png" /></a></td>
						<td align="center" width="48px"></td>
                        <td align="center"><a href="../procesos/AsociaTerminalContrato.php"><img src="../resources/add_endpoint.png" /></a></td>
						<td align="center" width="48px"></td>
                        <td align="center"><a href="../procesos/TerminalesCliente.php"><img src="../resources/client_endpoint.png" /></a></td>
                    </tr>
                    <tr>
                        <td><a href="../procesos/nuevoTerminal.php">Nuevo Terminal</a></td>
                        <td align="center"></td>
                        <td><a href="../procesos/SearchTerminales.php">Buscar Terminal</a></td>
						<td align="center"></td>
                        <td><a href="../procesos/AsociaTerminalContrato.php">Asocia Terminal a Contrato</a></td>
						<td align="center"></td>
                        <td><a href="../procesos/TerminalesCliente.php">Terminales de un Cliente</a></td>
                    </tr>
					<tr>
                        <td align="center"></td>
                        <td align="center" width="48px"></td>
                        <td align="center"></td>
						<td align="center" width="48px"></td>
						<td align="center"><a href="../procesos/AsociaTerminalCliente.php"><img src="../resources/client.png" /></a></td>
						<td align="center" width="48px"></td>
                        <td align="center"></a></td>
					</tr>
					<tr>
						 <td></td>
						 <td align="center"></td>
						 <td></td>
						 <td align="center"></td>
						 <td><a href="../procesos/AsociaTerminalCliente.php">Asocia Terminal a Cliente</a></td>
						 <td align="center"></td>
						 <td></td>
					</tr>
					<tr>
					</tr>
                </table>
			</div>
		</div>
		
		<div class="AccordionPanel">
		<div class="AccordionPanelTab">Usuarios</div>
			<div class="AccordionPanelContent" align="center" style="vertical-align:middle">
            	<br />
                <table>
                    <tr>
                        <td align="center"><a href="../procesos/nuevoUsuario.php"><img src="../resources/add_user.png" /></a></td>
                        <td align="center" width="48px"></td>
                        <td align="center"><a href="../procesos/alterUsuario.php"><img src="../resources/edit_user.png" /></a></td>
                    </tr>
                    <tr>
                        <td><a href="../procesos/nuevoUsuario.php">Nuevo usuario</a></td>
                        <td align="center"></td>
                        <td><a href="../procesos/alterUsuario.php">Modificar usuario</a></td>
                    </tr>
                </table>
			</div>
		</div>
		
	</div>
<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("AccorMenu");
//-->
</script>
    <div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p>
								  <p>2012 Derechos Reservados.</p>
								  <p>Uso exclusivo e interno de Touchmedia Consulting Ltda.</p></div>
								  
								  
	
</body>
</html>
<?php
}else{ 
	// Usuario que no se ha logueado 
	header("location:../errores/SinPermisos.php");
}
?>
