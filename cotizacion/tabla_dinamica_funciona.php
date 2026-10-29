<?php

@session_start();
include ("libreria.php");

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
mysql_select_db("dbmaster",$con);

$id        	= $_GET['productos'];
$div        = $_GET['div'];
$cantidad	= "1";
$margen		= "0%";


$resultado = mysql_query("SELECT * FROM tbproductos WHERE idtbproductos='$id'"); 

$head = "
<table id='tb' name='tb' class='tabla_actores'>
	<thead><tr>
		<th></th>
		<th>Nombre</th>
		<th>Imagen</th>
		<th>Descripción</th>
		<th>Cantidad</th>
		<th>Valor Unitario</th>
		<th>Margen de Ganancia</th>
		<th>Valor Neto</th>
		<th></th>
	</tr></thead>";

while ($filas=mysql_fetch_array($resultado)) 
{ 
	$formato_precio  = number_format($filas['precio'],  2,  ',',  '.');
	$precioneto      = $filas['precio']*$cantidad;
	$formato_precio2 = number_format($precioneto,  2,  ',',  '.');
		
	$rows = "<tr id=".$filas['idtbproductos'].">
			    <td align= center> <a href=# onclick='javascript:borrar(".$filas['idtbproductos'].");return false;'><img name='quitar' title='quitar producto de la cotización' style='cursor:pointer' id='Delete Row' src='menos1.png' width='47' height='52' border='0'></a></td>
				<td align= center width=180>".$filas['nombre']."</td>
				<td align= center> <img src='visor.php?id=".$filas['idtbproductos']."' alt='Imagen desde Blob' ></td>
				<td class= align.align { text-align: justify; padding:3px }>".nl2br($filas['descripcion'])."</td>
				<td align= center><input type='text' size='4' id='cantidad' name='cantidad' onkeypress='return soloLetras(event)' maxlength='10' value='".$cantidad."'></td>
				<td align= center width=100><input type='text' size='12' id='precio' name='precio' maxlength='26' value='".Moneda_Selected($filas['moneda'])." ".$formato_precio."'></td>
				<td align= center width=100><input type='text' size='4' id='margen' name='margen'onkeypress='return soloLetras1(event)' maxlength='6' value='".$margen."'></td>
				<td align= center width=110>".Moneda_Selected($filas['moneda'])." ".$formato_precio2."</td>
				<td align= center> <input type='image' onclick='javascript:guardar(".$filas['idtbproductos'].")' name='guardar' title='guardar cambios' alt='guardar cambios' style='cursor:pointer' id='Save Row' src='guardar.png' width='35' height='40' border='0'></td>
			</tr>";
}

$_SESSION['$rows'] = $_SESSION['$rows'].$rows;

$tabla=$head.$rows;

if($div =="")
{
	echo $tabla;
}else{
	echo $head.$_SESSION['$rows'];
}
echo "</table>";

?>
