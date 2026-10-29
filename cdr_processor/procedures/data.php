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

$ret = array();

     while($r = mysql_fetch_array($result)) {
      	$row[0] = $r[0];
      	$row[1] = $r[1];
      	$row[2] = $r[2];
        array_push($rows,$row);

        $ret[] = array($row[0],$row[1],$row[2]);

}

//echo json_encode($rows, JSON_NUMERIC_CHECK);

echo json_encode($ret);

?>