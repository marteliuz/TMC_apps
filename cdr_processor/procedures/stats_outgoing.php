<?php
//@date: 2014/08/29
//@autor: Marteliuz
session_start();
require('../cnfg/config.php');
include("lib_functions.php");
include("lib_log.php");

log_info("Generando estadísticas básicas On Demand");

if(isset($_SESSION['username']))
{ 
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CDR Processing... Report</title>
	<link href='../resources/tmc.ico' rel='shortcut icon' type='image/x-icon'>
	<style type="text/css">
	html{
		font-family: 'Open Sans', Segoe UI light, Tahoma,Helvetica,sans-serif;
		background-image:url(../resources/background.png);
		background-repeat:no-repeat;
	}
	#header {
	position:absolute;
	top:0px;
	left:0px;
	width:auto;
	}
	#containers {
		position:static;
	}
	#TotalPorDireccion {
		position:absolute;
		top:100px;
		left:50px;
		width:auto;
		height:auto;
		font-size:12px;
	}
	#CallsPerDay {
		position:absolute;
		top:100px;
		left:400px;
		width:auto;
		height:600px;
		font-size:12px;
	}
	#EndpointType {
		position:relative;
		top:600px;
		left:50px;
		width:auto;
		height:600px;
		font-size:12px;
	}
	
	
	#chartAllCalls {
		position:absolute;
		top:100px;
		width:300px;
		height:300px;
	}
	#chartCallsPerDay {
		position:absolute;
		top:0px;
		left:250px;
		width:550px;
		height:500px;
	}
	#chartEndpointType {
		position:absolute;
		top:50px;
		left:450px;
		width:550px;
		height:500px;
	}
	</style>
	<link rel="stylesheet" href="charts/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="charts/scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="charts/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="charts/jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="charts/jqwidgets/jqxchart.core.js"></script>
    <script type="text/javascript" src="charts/jqwidgets/jqxdata.js"></script>
	

    <script type="text/javascript">
        $(document).ready(function () {
			// chartAllCalls
			var source =
			{
				 datatype: "json",
				 datafields: [
					 { name: 'CallDirection'},
					 { name: 'Cantidad'}
				],
				url: 'qryChartAllCalls.php'
			};
            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            var settings = {
                title: "Total de llamadas",
                description: "por dirección",
                enableAnimations: true,
                showLegend: false,
                showBorderLine: true,
                legendPosition: { left: 520, top: 140, width: 100, height: 100 },
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                colorScheme: 'scheme02',
                seriesGroups:
                    [
                        {
                            type: 'pie',
                            showLabels: true,
                            series:
                                [
                                    { 
                                        dataField: 'Cantidad',
                                        displayText: 'CallDirection',
                                        labelRadius: 80,
                                        initialAngle: 15,
                                        radius: 100,
										centerOffset: 0
                                    }
                                ]
                        }
                    ]
            };
            $('#chartAllCalls').jqxChart(settings);
			
			// chartCallsPerDay
			var source =
            {
				 datatype: "json",
				 datafields: [
					 { name: 'Date'},
					 { name: 'cantidad'}
				],
				url: 'qryChartCallsPerDayOUTGOING.php'
            };
            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            var months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            // prepare jqxChart settings
            var settings = {
                title: "Llamadas por día",
                description: "Outgoing",
                enableAnimations: true,
                showLegend: true,
                padding: { left: 5, top: 5, right: 11, bottom: 5 },
                titlePadding: { left: 10, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                xAxis:
                    {
                        dataField: 'Date',
                        formatFunction: function (value) {
                            return  value.getDate();
                        },
                        toolTipFormatFunction: function (value) {
                            return value.getDate() + '-' + months[value.getMonth()] + '-' + value.getFullYear();
                        },
                        showTickMarks: true,
                        type: 'date',
                        baseUnit: 'day',
                        tickMarksInterval: 1,
                        tickMarksColor: '#888888',
                        unitInterval: 1,
                        showGridLines: true,
                        gridLinesInterval: 31,
                        gridLinesColor: '#888888',
                        valuesOnTicks: false
                    },
                colorScheme: 'scheme02',
                seriesGroups:
                    [
                        {
                            type: 'stackedline',
                            valueAxis:
                            {
                                unitInterval: 10,
                                minValue: 0,
                                maxValue: 250,
                                description: 'Cantidad de Llamadas',
                                tickMarksColor: '#888888'
                            },
                            series: [
                                    { dataField: 'cantidad'}
                                ]
                        }
                    ]
            };
            // setup the chart
            $('#chartCallsPerDay').jqxChart(settings);
			
			// chartEndpointType
            var source =
            {
				 datatype: "json",
				 datafields: [
					 { name: 'System'},
					 { name: 'Cantidad'}
				],
				url: 'qryChartEndpointTypeOUTGOING.php'
            };
            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            // prepare jqxChart settings
            var settings = {
                title: "Total de llamadas",
                description: "por dirección",
                enableAnimations: true,
                showLegend: false,
                showBorderLine: true,
                legendPosition: { left: 520, top: 140, width: 100, height: 100 },
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                colorScheme: 'scheme02',
                seriesGroups:
                    [
                        {
                            type: 'pie',
                            showLabels: true,
                            series:
                                [
                                    { 
                                        dataField: 'Cantidad',
                                        displayText: 'System',
                                        labelRadius: 0,
                                        initialAngle: 15,
                                        radius: 220,
										centerOffset: 0
                                    }
                                ]
                        }
                    ]
            };
            $('#chartEndpointType').jqxChart(settings);
			
			
			
        });
    </script>
	
</head>
<body>
	<div id="header">
		<table style="background-color:transparent;">
			<tr>
				<td><img src="../resources/tm2.png" alt="tm" height="50" width="50" /></td>
				<td width="10"> </td>
				<td><p class="header"><font color="#FFFFFF"> Procesamiento CDR</font></p></td>
				<td width="10"> </td>
				<td><h2><font color="#FFFFFF">Touch Media</font></h2></td>
			</tr>
		</table>
	</div>

	<div class="container" id="containers">
	  <div id="TotalPorDireccion">
			<table class="table hovered">
				<thead>
				<tr>
					<th colspan="3">Total de llamadas y Duración</th>
				</tr>
				<tr>
					<th>Dirección</th>
					<th>Cantidad</th>
					<th>Tiempo</th>
				</tr>
				</thead>
<?php		$qry = "SELECT call_direction, COUNT(call_direction) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata GROUP BY call_direction;";
			$result = mysql_query ($qry, $conexion);
			while($Reg = mysql_fetch_array($result))
			{
				echo "<tr><td>".$Reg['call_direction']."</td><td align='center'>".$Reg['cantidad']."</td><td align='right'>".$Reg['tiempo']."</td></tr>";
			}
?> 	
			</table>
			<div id="chartAllCalls"></div>
		</div>
		<div id="CallsPerDay">
			<table class="table hovered">
				<thead>
				<tr>
					<th colspan="3">Total de llamadas por día</th>
				</tr>
				<tr>
					<th colspan="3">Outgoing</th>
				</tr>
				<tr>
					<th>Fecha</th>
					<th>Cantidad</th>
					<th>Tiempo</th>
				</tr>
				</thead>
<?php		$qry = "SELECT start_date AS fecha, COUNT(start_date) AS cantidad_llamadas, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) AS tiempo_total FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' GROUP BY start_date ORDER BY start_date ASC;";
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
			</table>
			<div id="chartCallsPerDay"></div>
		</div>
		<div id="EndpointType">
			<table class="table hovered">
				<thead>
				<tr>
					<th colspan="2">Total de llamadas por Tipo de Terminal</th>
				</tr>
				<tr>
					<th colspan="2">Outgoing</th>
				</tr>
				<tr>
					<th>Tipo Terminal</th>
					<th>Cantidad</th>
				</tr>
				</thead>
<?php			$qry = "SELECT system_manufacturer, COUNT(*) AS cantidad FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' group by system_manufacturer;";
				$result = mysql_query ($qry, $conexion);
				while($Reg = mysql_fetch_array($result))
				{
					echo 
						"<tr>
							<td align='left'>".$Reg['system_manufacturer']."</td>
							<td align='center'>".$Reg['cantidad']."</td>
						</tr>";
				}
?>
			</table>
			<div id="chartEndpointType"></div>
		</div>  
	</div>
</body>
</html>
<?php
}else{
	header("location:../index.php");
}
?>