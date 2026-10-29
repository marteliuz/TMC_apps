<?php
include("config.php");
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
if(isset($_SESSION['Usuario']))
{
	$username = $_SESSION['Usuario'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Revision de Tickets Abiertos</title>
	<script language="javascript" type="text/javascript" src="../js/lib_funciones.js"></script>
	<style type="text/css">
		<!--
		#DIVcmbTickets {
		position:absolute;
		left:25px;
		top:25px;
		}
		#DatosTicket {
		position:absolute;
		left:190px;
		top:25px;
		}
		#Resultado {
		position:absolute;
		left:920px;
		top:550px;
		}
		#Comentarios {
		position:absolute;
		left:920px;
		top:25px;
		}
		#acciones {
		position:absolute;
		left:730px;
		top:400px;
		}
		#foot {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 10px;
		position: fixed;
		left: 0px;
		bottom: 0;
		height: 65px;
		width: 100%;
		background: #cecece;
		}
		-->
</style>
	<script type="text/javascript" src="../AlertBox/mootools.js"></script>
	<script type="text/javascript" src="../AlertBox/sexyalertbox.packed.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/sexyalertbox.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="../AlertBox/global.css"/>

	<script type="text/javascript">
	window.addEvent('domready', function() {
		Sexy = new SexyAlertBox();
	});
	</script>
</head>
<body>
	<div id="DIVcmbTickets">
		<form name="form1">
			<select id="cmbTickets" size="24" onclick="javascript:showTicketInfo()">
				<?php
					// 20130905
					//modificacion query
					//$qry = "SELECT idtbtickets as idtb, fecha_creacion, id_ticket FROM dbtmedia.tbtickets where estado = 0 ORDER BY fecha_creacion DESC ";
					//
					$qry = "SELECT idtbtickets as idtb, fecha_creacion, id_ticket FROM dbtmedia.tbtickets where estado <> 2 ORDER BY fecha_creacion DESC ";
					
					$result = mysql_query($qry,$conexion);
					$cont   = mysql_num_rows($result);
					if($cont!=0)
					{
						echo "<optgroup label='Tickets Abiertos'>";
						while($Reg = mysql_fetch_array($result))
						{
							echo "<option value='".$Reg['idtb']."'>".$Reg['id_ticket']."</option>";
						}
						echo "</optgroup>";
					}
				?>
			</select>
			<?php
				echo "<br>Total Tickets: ".$cont;
			?>
		</form>
	</div>
	<div id="DatosTicket"></div>
	<div id="Resultado"></div>
	<div id="Comentarios"></div>
	<!-- <div id="foot" align="center"><p>Desarrollado por @Marteliuz para Touchmedia Consulting Ltda.</p><p>2012 Derechos Reervados.</p></div> -->
</body>
</html>
<?php
}else{
	header("location:../errores/SinPermisos.php");
}
?>