<script type="text/javascript" src="funciones.js"></script>
<?php 

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("mydb", $con);
	
	$result = mysql_query ("SELECT ID_Cat, Cat FROM cat_videohdx");
	
	echo"<B><font color=#444 size=5>Categoría</font></B><br><p>";

	while($row = mysql_fetch_array($result))
	{
		echo"<input type='radio' onClick='javascript:detector3()' name='seleccion3' value='".$row['ID_Cat']."'>".$row['Cat']."<br>";
	}

	mysql_close($con);
	
	
	

	?>