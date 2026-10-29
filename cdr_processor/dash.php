<?php

session_start();
//require config.php for connection bd
require('../cnfg/config.php');
//include library lib_functions for extrac values
include("lib_functions.php");
//include lib_log.php for create log
include("lib_log.php");

    $qry = "SELECT call_direction, COUNT(call_direction) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata GROUP BY call_direction;";
    $result = mysql_query ($qry, $conexion);
    $rows = array();

     while($r = mysql_fetch_array($result)) {
        $jsonData[0] = $r[0];
        $jsonData[1] = $r[1];
        $jsonData[2] = $r[2];
        array_push($rows,$row);

}

echo json_encode($$jsonData, JSON_NUMERIC_CHECK);

?>  

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<title>phpflow.com : Source code of  pie charts</title>
<div><h3>Source code : pie charts</h1></div>

<div class="col-sm-8" id="container2">

</div>
<script>
jQuery(document).ready(function() {
var doc = $(document);


$('#container2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Task Status'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
				showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: <?php echo json_encode($jsonData);?>
        }]
    });
    });
</script>
