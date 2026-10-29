<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

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
<head>
<script type="text/javascript" src="fun_inv.js"></script>
<script language='javascript' src='popcalendar.js'></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>inicio1</title>
<style type="text/css">
#Step4 {
	position:absolute;
	left:20px;
	top:160px;
	width:530px;
	height:807px;
	z-index:1;
}
#Step5 {
	position:absolute;
	left:633px;
	top:160px;
	width:50px;
	height:296px;
	z-index:2;
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
	left:622px;
	top:40px;
}
</style>
</head>
<body text="#444" onunload="Aviso"link="#0000CC" alink="#0000CC" vlink="#0000CC">
<div align="right"><a  id="Atrás" href="inicio.php"><img src="boton_atras.png" alt="volver a inicio" longdesc="boton_atras.png" /></img></a></div>
<div id="logo"><br><img height="100" width="100"  src="tm3.png"></div>
<div id="tabla">
<blockquote>	
<table width="1115" cellpadding="3" cellspacing="3">
		<tr>
           <td width="21"><input type="radio" name="Inventario" value="inv2" id="inv2" onClick="javascript:Step4()"></td>
           <td >Ingresar Inventario </td>
           <td width="120"></td>
           <td width="20">&nbsp;</td>
           <td width="357">&nbsp;</td>
            <td width="276"></td>
            </tr>
		 <tr>
           <td> <input type="radio" name="Inventario" value="inv_usado2" id="inv_usado2" onClick="javascript:Step4()"></td>
           <td >  Retirar Inventario</td>
           <td width="120"></td>
           <td >&nbsp;</td>
           <td>&nbsp;</td>
      </tr> 
      </table>
<blockquote>
</div>	
<div id="Step4"></div>
<div id="Step5"></div>

</body>
</html>
