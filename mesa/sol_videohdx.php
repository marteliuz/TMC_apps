<?php

$seleccion		= $_POST['seleccion1'];
$sel			= $_POST['sel1']; 

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("mydb", $con);
	$result = mysql_query ("SELECT ID_Sol, Sol FROM sol_videohdx WHERE ID_Pro= $sel");
	
	echo "Solución:\r";
	
	while ($registro = mysql_fetch_array($result)) {
    
    echo $registro['Sol'];
	}
	mysql_close($con);
	
	
	?>