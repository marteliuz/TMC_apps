<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Graficas Ejemplo</title>
		
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/highcharts.js"></script>
		<script type="text/javascript" src="js/exporting.js"></script>
		
		<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'graficaCircular'
					},
					title: {
						text: 'Porcentaje de Visitas por Paises'
					},
					subtitle: {
						text: 'Jarroba.com'
					},
					plotArea: {
						shadow: null,
						borderWidth: null,
						backgroundColor: null
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								formatter: function() {
									return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
								}
							}
						}
					},
				    series: [{
						type: 'pie',
						name: 'Browser share',
						data: [<?echo json_encode($rows, JSON_NUMERIC_CHECK);?>]
					}]
				});
			});
				
		</script>
		
	</head>
	<body>
		<?php
//Star session
session_start();
//require config.php for connection bd
require('../cnfg/config.php');
//include library lib_functions for extrac values
include("lib_functions.php");
//include lib_log.php for create log
include("lib_log.php");
log_info("Generando estadísticas básicas On Demand");
	
	/*
	$qry = "SELECT call_direction, COUNT(call_direction) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata GROUP BY call_direction;";
    $result = mysql_query ($qry, $conexion);
    $rows = array();

     while($r = mysql_fetch_array($result)) {
      	$row[0] = $r[0];
      	$row[1] = $r[1];
      	$row[2] = $r[2];
        array_push($rows,$row);

}

echo json_encode($rows, JSON_NUMERIC_CHECK);*/

//$result = mysql_query("SELECT * FROM `values`") or die ("Error");
/*$result = "SELECT call_direction, COUNT(call_direction) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata GROUP BY call_direction;";
$result = mysql_query ($result, $conexion);

while($row = mysql_fetch_array($result)) {
echo $row['call_direction'] . "/" . $row['cantidad']. "/" . $row['tiempo']. "/" ;
}*/

	
	$qry = "SELECT call_direction, COUNT(call_direction) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata GROUP BY call_direction;";
    $result = mysql_query ($qry, $conexion);
    $rows = array();

     while($r = mysql_fetch_array($result)) {
      	$row[0] = $r[0];
      	$row[1] = $r[1];
        array_push($rows,$row);

}

echo json_encode($rows, JSON_NUMERIC_CHECK);

//echo json_encode($ret);

?>
		<div id="graficaCircular" style="width: 100%; height: 500px; margin: 0 auto"></div>		
	</body>
</html>
