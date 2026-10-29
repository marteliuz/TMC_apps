<?php
//@date: 2014/10/07
//@autor: Marteliuz
session_start();
require('../cnfg/config.php');
include("lib_functions.php");
include("lib_log.php");

log_info("Generando Reporte 1 On Demand");

if(isset($_SESSION['username']))
{ 
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CDR Processing... Report</title>
	<link href='../resources/tmc.ico' rel='shortcut icon' type='image/x-icon'>
	<script type="text/javascript" src="charts/scripts/jquery-1.10.2.min.js"></script>
	
	<style type="text/css">
	html{
		font-family: 'Open Sans', Segoe UI light, Tahoma,Helvetica,sans-serif;
		font-size:12px;
	}
	#containers {
		
	}
	#data {
		position:relative;
		width:auto;
		height:auto;
	}
	#tabla_resumen {
		position:relative;
		top:-235px;
		left:500px;
		width:600px;
		height:300px;
	}
	</style>
	<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#container").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
	
	
</head>
<body>
	<div id="export">
		<form action="excelFile.php" method="post" target="_blank" id="FormularioExportacion">
		<p>Exportar a Excel  <img src="../resources/export_to_excel.gif" class="botonExcel" /></p>
		<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
		</form>
	<div>
	

	<div id="container">
		<div style="border-width: 2px; border-style: solid; border-color: red; " id="data">
			<table border="1">
				<thead>
					<tr>
						<th colspan="2">Parámetros del Reporte</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th align="left" nowrap scope="row">Creación</th>
						<td align="right"><?php echo date("F j, Y, g:i a");  ?></td>
					</tr>
					<tr>
						<th align="left" nowrap scope="row">Nombre del archivo</th>
						<td align="right"><?php echo getFileName(); ?></td>
					</tr>
					<tr>
						<th align="left" nowrap scope="row">Tamaño del archivo</th>
						<td align="right"><?php echo getFileSize(); ?></td>
					</tr>
					<tr>
						<th align="left" nowrap scope="row">Total de Registros</th>
						<td align="right"><?php echo getCountItemsFile(); ?></td>
					</tr>
					<tr>
						<th align="left" nowrap scope="row">Registros Procesados</th>
						<td align="right"><?php echo getCountAllItems(); ?></td>
					</tr>
					<tr>
						<th align="left" nowrap scope="row">% de Efectividad</th>
						<td align="right"><?php echo getPercentEffectiveness(); ?></td>
					</tr>
					<tr>
						<th align="left" nowrap scope="row">Total de llamadas concretadas</th>
						<td align="right"><?php echo (getCountAllItems() - getCountFailedAttempr()); ?></td>
					</tr>
					<tr>
						<th align="left" nowrap scope="row">Total de llamadas fallidas</th>
						<td align="right"><?php echo getCountFailedAttempr(); ?></td>
					</tr>					
					<tr>
						<th align="left" nowrap scope="row">Primer Registro</th>
						<td align="right"><?php echo getDateFirstRecord(); ?></td>
					</tr>
					<tr>
						<th align="left" nowrap scope="row">Ultimo Registro</th>
						<td align="right"><?php echo getDateLastRecord(); ?></td>
					</tr>
				</tbody>
			</table>
			
			<br>
			<div style="border-width: 2px; border-style: solid; border-color: black; " id="tabla_resumen">
			<table>
				<thead>
				<tr>
					<th colspan="3">Total de llamadas</th>
				</tr>
				<tr>
					<th>Dirección</th>
					<th>Cantidad</th>
					<th>Tiempo</th>
				</tr>
				</thead>
	<?php
			$qry = "SELECT call_direction, COUNT(call_direction) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata WHERE disconnect_info NOT LIKE 'Fail%' GROUP BY call_direction;";
			$result = mysql_query ($qry, $conexion);
			while($Reg = mysql_fetch_array($result))
			{
				if($Reg['call_direction']=="INCOMING"){
					$call_direction = "Entrantes";
				}
				if($Reg['call_direction']=="OUTGOING"){
					$call_direction = "Salientes";
				}
				echo "<tr><td>".$call_direction."</td><td align='center'>".$Reg['cantidad']."</td><td align='right'>".$Reg['tiempo']."</td></tr>";
			}
	?> 
			</table>
			</div>
			
		</div>

		<div style="border-width: 2px; border-style: solid; border-color: red; " id="incoming">
		
		<br><br> ENTRANTES <br><br><br>
		
		<table>
			<thead>
			<tr>
				<th colspan="3">Llamadas por día</th>
			</tr>
			<tr>
				<th>Fecha</th>
				<th>Cantidad</th>
				<th>Tiempo</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$qry = "SELECT start_date AS fecha, COUNT(start_date) AS cantidad_llamadas, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) AS tiempo_total FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY start_date ORDER BY start_date ASC;";
			$result = mysql_query ($qry, $conexion);
			while($Reg = mysql_fetch_array($result))
			{
				echo 
					"<tr>
						<td align='left'>".$Reg['fecha']."</td>
						<td align='center'>".$Reg['cantidad_llamadas']."</td>
						<td >".$Reg['tiempo_total']."</td>
				</tr>";
			}
			?>
			</tbody>		
		</table>
		
		<br>
		
		<table>
		<thead>
			<tr>
				<th colspan="3">Total de llamadas y duración por Tipo de Sitio</th>
			</tr>
			<tr>
				<th>Tipo Sitio</th>
				<th>Cantidad</th>
				<th>Tiempo</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$qry = "SELECT endpoint_type, COUNT(endpoint_type) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY endpoint_type;";
		$result = mysql_query ($qry, $conexion);
		while($Reg = mysql_fetch_array($result))
		{
			$endpoint_type = $Reg['endpoint_type'];
			if($endpoint_type == " "){
				$endpoint_type = "Software";
			}elseif($endpoint_type == "user:terminal"){
				$endpoint_type = "Terminal";
			}
			echo "<tr><td>".$endpoint_type."</td><td align='center'>".$Reg['cantidad']."</td><td align='center'>".$Reg['tiempo']."</td></tr>";
		}
		?>
		</tbody>
		</table>

		<br>
		
		<table>
		<thead>
			<tr>
				<th colspan="3">Total de llamadas y duración por Sitio</th>
			</tr>
			<tr>
				<th>Nombre Sitio</th>
				<th>Cantidad</th>
				<th>Tiempo</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$qry = "SELECT name, count(name) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info not like 'Fail%' GROUP BY name ORDER BY cantidad DESC;";
		$result = mysql_query ($qry, $conexion);
		while($Reg = mysql_fetch_array($result))
		{
			echo "<tr><td>".$Reg['name']."</td><td align='center'>".$Reg['cantidad']."</td><td align='right'>".$Reg['tiempo']."</td></tr>";
		}
		?>
		</tbody>
		</table>

		<br>
		
		<table>
		<thead>
			<tr>
				<th colspan="5">QoE - Calidad de la Experiencia</th>
			</tr>
			<tr>
				<th>Nombre Sitio</th>
				<th>Sumatoria<br>Packets Loss RX</th>
				<th>Promedio %<br>Packets Lost RX</th>
				<th>Sumatoria<br>Packets Loss TX</th>
				<th>Promedio %<br>Packets Lost TX</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$qry = "SELECT name, SUM(avg_packets_lost_rx), AVG(avg_percent_packeT_loss_rx), SUM(avg_packets_lost_tx),AVG(avg_percent_packet_loss_tx) FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY NAME;";
		$result = mysql_query ($qry, $conexion);
		while($Reg = mysql_fetch_array($result))
		{
			echo "<tr><td>".$Reg['name']."</td><td align='center'>".$Reg['SUM(avg_packets_lost_rx)']."</td><td align='center'>".$Reg['AVG(avg_percent_packeT_loss_rx)']."</td><td align='center'>".$Reg['SUM(avg_packets_lost_tx)']."</td><td align='center'>".$Reg['AVG(avg_percent_packet_loss_tx)']."</td></tr>";
		}
		?>
		</tbody>
		</table>
		

		</div>
		
		<div style="border-width: 2px; border-style: solid; border-color: red; " id="outgoing">
		<br><br>SALIENTES <br><br><br>
		
			<table class="table hovered">
			<thead>
			<tr>
				<th colspan="3">Llamadas por día</th>
			</tr>
			<tr>
				<th>Fecha</th>
				<th>Cantidad</th>
				<th>Tiempo</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$qry = "SELECT start_date AS fecha, COUNT(start_date) AS cantidad_llamadas, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) AS tiempo_total FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY start_date ORDER BY start_date ASC;";
			$result = mysql_query ($qry, $conexion);
			while($Reg = mysql_fetch_array($result))
			{
				echo 
					"<tr>
						<td align='left'>".$Reg['fecha']."</td>
						<td align='center'>".$Reg['cantidad_llamadas']."</td>
						<td >".$Reg['tiempo_total']."</td>
				</tr>";
			}
			?>
			</tbody>		
		</table>
		
		<br>
		
		<table>
		<thead>
			<tr>
				<th colspan="3">Total de llamadas y duración por Tipo de Sitio</th>
			</tr>
			<tr>
				<th>Tipo Sitio</th>
				<th>Cantidad</th>
				<th>Tiempo</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$qry = "SELECT endpoint_type, COUNT(endpoint_type) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY endpoint_type;";
		$result = mysql_query ($qry, $conexion);
		while($Reg = mysql_fetch_array($result))
		{
			$endpoint_type = $Reg['endpoint_type'];
			if($endpoint_type == " "){
				$endpoint_type = "Software";
			}elseif($endpoint_type == "user:terminal"){
				$endpoint_type = "Terminal";
			}
			echo "<tr><td>".$endpoint_type."</td><td align='center'>".$Reg['cantidad']."</td><td align='center'>".$Reg['tiempo']."</td></tr>";
		}
		?>
		</tbody>
		</table>

		<br>
		<table>
		<thead>
			<tr>
				<th colspan="3">Total de llamadas y duración por Sitio</th>
			</tr>
			<tr>
				<th>Nombre Sitio</th>
				<th>Cantidad</th>
				<th>Tiempo</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$qry = "SELECT name, count(name) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info not like 'Fail%' GROUP BY name ORDER BY cantidad DESC;";
		$result = mysql_query ($qry, $conexion);
		while($Reg = mysql_fetch_array($result))
		{
			echo "<tr><td>".$Reg['name']."</td><td align='center'>".$Reg['cantidad']."</td><td align='right'>".$Reg['tiempo']."</td></tr>";
		}
		?>
		</tbody>
		</table>

		<br>
		
		<table>
		<thead>
			<tr>
				<th colspan="5">QoE - Calidad de la Experiencia</th>
			</tr>
			<tr>
				<th>Nombre Sitio</th>
				<th>Sumatoria<br>Packets Loss RX</th>
				<th>Promedio %<br>Packets Lost RX</th>
				<th>Sumatoria<br>Packets Loss TX</th>
				<th>Promedio %<br>Packets Lost TX</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$qry = "SELECT name, SUM(avg_packets_lost_rx), AVG(avg_percent_packeT_loss_rx), SUM(avg_packets_lost_tx),AVG(avg_percent_packet_loss_tx) FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY NAME;";
		$result = mysql_query ($qry, $conexion);
		while($Reg = mysql_fetch_array($result))
		{
			echo "<tr><td>".$Reg['name']."</td><td align='center'>".$Reg['SUM(avg_packets_lost_rx)']."</td><td align='center'>".$Reg['AVG(avg_percent_packeT_loss_rx)']."</td><td align='center'>".$Reg['SUM(avg_packets_lost_tx)']."</td><td align='center'>".$Reg['AVG(avg_percent_packet_loss_tx)']."</td></tr>";
		}
		?>
		</tbody>
		</table>
		
		
		</div>
	</div>
</body>
</html>
<?php
}
?>