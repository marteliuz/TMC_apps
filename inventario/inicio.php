<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}else { 
    
include ("fecha.php");
$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
mysql_select_db("inventario",$con);

$resultado = mysql_query("SELECT Fecha_Ingreso FROM inventario ORDER BY Fecha_Ingreso DESC LIMIT 1");

while ($res=mysql_fetch_array($resultado)) 
{ 
		echo "Fecha Ultima Actualización: ".DateConvertB($res['Fecha_Ingreso']);
		echo "".""."";
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
<head>
<script type="text/javascript" src="fun_inv.js"></script>
<script language='javascript' src='popcalendar.js'></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<title>inicio</title>
<!--<script type="text/javascript">
       window.onbeforeunload = function Aviso(){
            return "Está saliendo de la página, ¿Está Seguro?";
           header("Location: logout.php");
		  
        }
</script>-->
<script>
function mostrar(enla) {
  obj = document.getElementById('oculto');
  obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
  enla.innerHTML = (enla.innerHTML == '-') ? '+' : '-';
}
</script>
</style>
<style type="text/css">
.fila_0 { background-color: ;}
.fila_1 { background-color: #D3EDFF;}
</style>

<style type="text/css">

#Step1 {
	position:absolute;
	left:-600px;
	top:220px;
	width:530px;
	height:807px;
	z-index:1;
}
#Step3 {
	position:absolute;
	left:50px;
	top:192px;
	width:633px;
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
<div align="right"><a  id="cerrar" href="logout.php"><img src="cerrar_sesion.png" alt="cerrar sesion" longdesc="cerrar sesion.jpg" /></img></a></div>
<div id="logo"><br><img height="100" width="100"  src="tm3.png"></div>
<div id="tabla">
<blockquote>
  <table  width="1093" cellpadding="3" cellspacing="3">
    		 <tr>
           <td width="27"><input type="radio" name="Inventario" value="inv" id="inv" onclick="javascript:Step1()" /></td>
           <td >Ingresar Inventario </td>
           <td  width="50"></td>
           <td width="20" ><input type="radio" name="Inventario" value="modificar" id="modificar" onclick="javascript:Step1()" /></td>
           <td width="305" >Reingresar  Inventario Utilizado</td>
           <td  width="150"></td>
            <td width="129"></td>
    </tr>
   		 <tr>
           <td> <input type="radio" name="Inventario" value="inv_usado" id="inv_usado" onClick="javascript:Step1()"></td>
           <td >  Retirar  Inventario Actual</td>
           <td  width="50"></td>
           <td ><input type="radio" name="Inventario" value="modificar_inv_us" id="modificar_inv_us" onclick="javascript:Step1()" /></td>
           <td >Modificar Inventario Utilizado</td>
           <td  width="96"></td>
      </tr>
      <tr>
           <td> <input type="radio" name="Inventario" value="modificar_inv" id="modificar_inv" onClick="javascript:Step1()"></td>
           <td >  Modificar Inventario Actual</td>
           <td  width="50"></td>
           <td ><input type="radio" name="Inventario" value="ver_inv_us" id="ver_inv_us" onclick="javascript:Step1()" /></td>
           <td > Ver Inventario Utilizado </td>
           <td  width="96"></td>
		   <td></td>
            
          
      </tr> 
            <tr>
           <td >  <input type="radio" name="Inventario" value="ver_inv" id="ver_inv" onclick="javascript:Step1()" /></td>
           <td > Ver Inventario Actual </td>
           <td  width="50"></td>
           <td ><input name="Inventario" type="radio" id="bus_hist" onclick="javascript:Step1()" value="bus_hist" /></td>
           <td >Búsqueda Avanzada Inventario Utilizado</td>
            
           </tr>  
            <tr>
           <td id="oculto3"><input name="Inventario" type="radio" id="bus" onclick="javascript:Step1()" value="bus" /></td>
           <td width="398">Búsqueda Avanzada Inventario Actual</td>
            <td width="50"></td>
            <td ><input type="radio" name="Inventario" value="control" id="control" onclick="javascript:Step1()" /></td>
           <td >Control Inventario</td>
           </tr>    
  </table>                                                                 
</blockquote>
</div>
<div id="clientes"><img src="ver_cliente" style="CURSOR:hand" name="clientes" type="button" id="clientes" onclick = "window.open('ver_clientes.php', 'clientes','status = 1, height = 650, width = 1300, scrollbars=1, resizable = 0' )"/><div>

<div id="Step1"></div>
<div id="Step3"></div>
</p>
</body>
</html>
<?php } ?>