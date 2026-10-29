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
 
$id = $_GET['id'];
 
//define array
//we need two arrays - "male" and "female" so $arr and $arr1 respectively!
$arr    = array();
$arr1   = array();
$result = array();
 
//get the result from the table "highcharts_data"
//$sql = "select * from higcharts_data where map_id = $id";
$sql = "SELECT call_direction, COUNT(call_direction) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata GROUP BY call_direction;";
$q   = mysql_query($sql);
$j = 0;
while($row = mysql_fetch_assoc($q)){
 
//highcharts needs name, but only once, so give a IF condition
  if($j == 0){
  $arr['name'] = 'call_direction';
  $arr1['name'] = 'cantidad';
  $arr2['name'] = 'tiempo';
    $j++;
  }
  //and the data for male and female is here
  $arr['data'][] = $row['call_direction'];
  $arr1['data'][] = $row['cantidad'];
  $arr2['data'][] = $row['tiempo'];
}
 
//after get the data for male and female, push both of them to an another array called result
array_push($result,$arr);
array_push($result,$arr1);
array_push($result,$arr2);
 
//now create the json result using "json_encode"
print json_encode($result, JSON_NUMERIC_CHECK);
 

?> 
