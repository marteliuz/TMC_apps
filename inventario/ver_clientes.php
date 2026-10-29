<script type="text/javascript" src="fun_inv.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<style media="print" type="text/css">
#oculto {
visibility:hidden
}
</style>
<?php
include ("fecha.php");
$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$result = mysql_query ("SELECT * FROM inventario.clientes WHERE ID_Clientes>'0' ORDER BY Clientes ");
	
	$numero = mysql_num_rows($result);
	?>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
	<body text=#444>
    <div id=clientes>
    <table width="200" cellpadding="3" cellspacing="3">
    <tr>
    <td width="42"><?php echo"<h2>Clientes<h2>"?></td>
	<td id= "oculto" width="135"><a href="javascript:imprime_clientes()"><img src="boton_imprimir.png" alt="imprimir" longdesc="boton-imprimir.jpg" ></img></a></td>
    </tr> 
    </table>
    <form name="form1" method="post">
    <table width="1150" cellpadding="3" cellspacing="3">
        <tr>
          <td id= "oculto2" width="450"><font size=3 color=#000000>Buscar por: Nombre</font>
            <input type="text" name="nombre_cliente" id="nombre_cliente" /></td>
            <td id= "oculto2"><font size=3 color=#000000>Rut</font>
            <input type="text" name="rut_cliente" id="rut_cliente" /></td>
            <td width="136"> <a href='#' title="enviar" onClick="busqueda_cliente();"><img src='enviar.png'></a>&nbsp;&nbsp;&nbsp; <img src="borrar.png" onclick="document.form1.reset()" style="CURSOR:hand" title="borrar"></td>
          <td width="204" id= "oculto2"><font size=3 color=#000000>TOTAL CLIENTES:&nbsp;</font><?php echo "<font color=red size=4>$numero</font></B>" ?></td>
        </tr>
      </table>
    </form>
	<div id=imprimir>
    <?php
	
		echo "<table border=1 cellpadding=3 cellspacing=0>";
		 
echo "<td width=400 align= center bgcolor='#0073c4'><B><font size=3 color=#FFFFF>Clientes</font></B></td>";
echo "<td width=100 align= center bgcolor='#0073c4'><B><font size=3 color=#FFFFF>Rut Clientes</font></B></td>";
echo "<td width=500 align= center bgcolor='#0073c4'><B><font size=3 color=#FFFFF>Dirección</font></B></td>";
echo "<td width=250 align= center bgcolor='#0073c4'><B><font size=3 color=#FFFFF>Teléfono</font></B></td>";
echo "<td width=100 align= center bgcolor='#0073c4'><B><font size=3 color=#FFFFF>Nombre Contacto</font></B></td>";
echo "<td width=100 align= center bgcolor='#0073c4'><B><font size=3 color=#FFFFF>Correo Contacto</font></B></td>";
echo "<td width=100 align= center bgcolor='#0073c4'><B><font size=3 color=#FFFFF>Teléfono Contacto</font></B></td>";
echo "</tr>";
	$reg = mysql_fetch_array($result, MYSQL_BOTH);
	
	{
		 while($reg)
{
echo "<td align= left><font size=2>".$reg["Clientes"]."</font></td>";
echo "<td align= center><font size=2>".$reg["Rut_Clientes"]."</font></td>";
echo "<td align= center><font size=2>".$reg["Direccion"]."</font></td>";
echo "<td align= center><font size=2>".$reg["Telefono"]."</font></td>";
echo "<td align= center><font size=2>".$reg["Contacto"]."</font></td>";
echo "<td align= center><font size=2>".$reg["Correo"]."</font></td>";
echo "<td align= center><font size=2>".$reg["Tcontacto"]."</font></td>";
$reg = mysql_fetch_array($result, MYSQL_BOTH);
	?>
	</div> 
</div>
<?php
echo "</tr>";
}
echo "</table>";
	mysql_close($con);
	}
	?>
   </body>