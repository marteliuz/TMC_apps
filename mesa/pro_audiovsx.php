<script type="text/javascript" src="funciones.js"></script>
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
	$result = mysql_query ("SELECT ID_Pro, Pro FROM Pro_audiovsx WHERE ID_Sin= $sel");
	
	echo"<B><font color=#444 size=5>Problema</font></B><br><p>";
	
	while($row = mysql_fetch_array($result))

    {
		echo "<input type='radio' onClick='javascript:detector10()' name='seleccion10' value=".$row['ID_Pro'].">".$row['Pro']."<br>";
	}

	mysql_close($con);
	
	
	?>