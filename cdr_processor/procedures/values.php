<?php
//require config.php for connection bd
require('../cnfg/config.php');
//include library lib_functions for extrac values
include("lib_functions.php");
//include lib_log.php for create log
include("lib_log.php");

//$result = mysql_query("SELECT * FROM `value`");
$result1 = "SELECT * FROM value";
$result = mysql_query ($result1, $conexion);

while($row = mysql_fetch_array($result)) {
echo $row['month'] . "/" . $row['days']. "/" ;
}

?>