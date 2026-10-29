<script type="text/javascript" src="funciones.js"></script>
<?php 

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("mydb", $con);
	
	$result = mysql_query ("SELECT ID_Red, Pro_Red FROM Problemas_Red", $con);
	
	echo"<B><font color=#444 size=5>Problema</font></B><br><p>";
	

	
	while($row = mysql_fetch_array($result))
	{ 
		echo "<input type='radio' onClick='javascript:detector()' name='seleccion' value=".$row['ID_Red'].">".$row['Pro_Red']."<br>";
		
	}
	
	

		mysql_close($con);
	
	
	

	?>


    
