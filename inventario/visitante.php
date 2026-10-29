<?php
include ("fecha.php");
$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
mysql_select_db("inventario",$con);

$resultado = mysql_query("SELECT Fecha_Ingreso FROM inventario ORDER BY Fecha_Ingreso DESC LIMIT 1");

while ($res=mysql_fetch_array($resultado)) 
{ 
		echo "Fecha Ultima Actualización: ".DateConvertB($res['Fecha_Ingreso']);
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>visitante</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<script type="text/javascript" src="fun_inv.js"></script>
<script language="javascript" type="text/javascript">
function obtiene_fecha() {

miFecha = new Date() 
document.write(miFecha.getHours() + ":" + miFecha.getMinutes() + ":" + miFecha.getSeconds())
	
	var fecha_actual = new Date()

	var dia = fecha_actual.getDate()
	var mes = fecha_actual.getMonth() + 1
	var anio = fecha_actual.getFullYear()

	if (mes < 10)
		mes = '0' + mes

	if (dia < 10)
		dia = '0' + dia
	
	return (-dia + "/" + mes + "/" + anio)
}

function MostrarFecha() {
   document.write ( obtiene_fecha() )
}

</script>

<style type="text/css">

#Step1 {
	position:absolute;
	left:-600px;
	top:145px;
	width:531px;
	height:807px;
	z-index:1;
}

#Step3 {
	position:absolute;
	left:50px;
	top:155px;
	width:638px;
	height:807px;
	z-index:1;
}

#tabla {
	position:absolute;
	left:10px;
	top:20px;
}
#logo {
	position:absolute;
	left:1000px;
	top:10px;
}

#clientes {
	position:absolute;
	left:617px;
	top:30px;
}
</style>
</head>

<body id="body" link="#0000CC" text="444"  alink="#0000CC" vlink="#0000CC">
<div align="right"><a  id="Atrás" href="logout.php"><img src="boton_atras.png" alt="volver a inicio" longdesc="boton_atras.png" /></img></a></div>
<div id="logo"><br><img height="100" width="100"  src="tm3.png"></div>
<div id="tabla">
<blockquote>	
	<table width="1071" cellpadding="3" cellspacing="3">
		<tr>
           <td width="26"><input type="radio" name="ver" value="ver_inv1" id="ver_inv1" onclick="javascript:Step2()" /></td>
           <td  width="254">Ver Inventario Actual </td>
           <td  width="55"></td>
           <td  width="20"><input name="ver" type="radio" id="bus1" onclick="javascript:Step2()" value="bus1" /></td>
           <td  width="371">Búsqueda Avanzada Inventario Actual</td>
             <td width="160"></td>
             <td  width="117"></td>
      </tr>
		 <tr>
           <td id="oculto" ><input type="radio" name="ver" value="ver_inv_us1" id="ver_inv_us1" onclick="javascript:Step2()" /></td>
           <td > Ver Inventario Histórico Utilizado</td>
           <td  width="55"></td>
           <td  width="20"><input name="ver" type="radio" id="bus_hist1" onclick="javascript:Step2()" value="bus_hist1" /></td>
           <td  width="371">Búsqueda Avanzada Inventario Histórico Utilizado </td> 
      </tr>        
  </table>                                                                 
</blockquote>
<div id="clientes"><img src="ver_cliente" style="CURSOR:hand" name="clientes" type="button" id="clientes" onclick = "window.open('ver_clientes.php', 'clientes','status = 1, height = 650, width = 1300, scrollbars=1, resizable = 0' )"/><div>
</div>
<div id="Step1"></div>
<div id="Step3"></div> 
 
     
</body>
</html>
