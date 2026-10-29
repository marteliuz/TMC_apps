<script type="text/javascript" src="funciones.js"></script>
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
	
	$result = mysql_query ("SELECT ID_Sin, Sin FROM sin_videohdx WHERE ID_Cat= $sel");
	
	echo"<B><font color=#444 size=5>Síntoma</font></B><br><p>";
	
	while($row = mysql_fetch_array($result))
	{
		echo "<input type='radio' onClick='javascript:detector7()' name='seleccion7' value=".$row['ID_Sin'].">".$row['Sin']."<br>";
	}
	
	mysql_close($con);
	

	?>
</body>
</html>