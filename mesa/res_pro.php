<?php 


$seleccion		= $_POST['seleccion'];
$sel			= $_POST['sel'];

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("mydb", $con);
	
	$result = mysql_query ("SELECT ID_Red, Sol FROM Problemas_Red WHERE ID_Red='$sel'", $con);
	
	echo"<B><font color=#444 size=5>Solución</font></B><br><p>";
	
	
	while ($registro = mysql_fetch_array($result)) {
?>
    
    <p style="text-align:justify">
	<?php
    echo $registro['Sol'];
	}?>
</p>
	<?php
	mysql_close($con);
	
	
	?>

	
