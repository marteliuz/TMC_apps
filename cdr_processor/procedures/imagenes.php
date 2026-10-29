<?php
//@autor     : Paulo Ossandon
//@date      : 2014/12/03
//@modified  : 2014/12/09

//Include file config.php - connection bd
include('../cnfg/config.php');
//Include lib_functions.php for abtain result query sql
include("lib_functions.php");
//Include lib_log.php for create log
include("lib_log.php");

//start session
session_start();

$consulta=mysql_query("select logo_cliente from tbclientes");

echo " <table>

<tr>
		<th>Imagen</th>
</tr>
";

while ($imagenes=mysql_fetch_array($consulta)) {
	# code...

    $imagen=$imagenes["logo_cliente"];

	echo " <tr>
                
               <td><img src='$imagen'></td>
               


	      </tr>";


}

echo "</table>";
?>
  
