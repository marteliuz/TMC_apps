<?php
define('DB_SERVER','localhost');
define('DB_NAME','inventario');
define('DB_USER','root');
define('DB_PASSWORD','Touchmedia');
 
$con = mysql_connect(DB_SERVER,DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME,$con);
?>