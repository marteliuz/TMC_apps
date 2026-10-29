<?php

function DateConvertA($fecha){
	$matriz= explode("-", $fecha);
if ($fecha!=""){
	$day	= $matriz[0];
	$month	= $matriz[1];
	$year	= $matriz[2];
	
	$fecha= $year."/".$month."/".$day;
	$fecha= date($fecha);
	
	return $fecha;
}
}
	function DateConvertB($fecha){
	$matriz= explode("-", $fecha);
if ($fecha!=""){
	$day	= $matriz[2];
	$month	= $matriz[1];
	$year	= $matriz[0];
	
	$fecha= $day."-".$month."-".$year;
	$fecha= date($fecha);
	
	return $fecha;
}
}

function DateConvertC($fecha){
	$matriz= explode("/", $fecha);
if ($fecha!=""){
	$day	= $matriz[2];
	$month	= $matriz[1];
	$year	= $matriz[0];
	
	$fecha= $day."-".$month."-".$year;
	$fecha= date($fecha);
	
	return $fecha;
}
}

function DateConvertD($fecha){
	$matriz= explode("/", $fecha);
if ($fecha!=""){
	$day	= $matriz[0];
	$month	= $matriz[1];
	$year	= $matriz[2];
	
	$fecha= $year."-".$month."-".$day;
	$fecha= date($fecha);
	
	return $fecha;
}
}

function DateConvertE($fecha){
	$matriz= explode("-", $fecha);
if ($fecha!=""){
	$day	= $matriz[2];
	$month	= $matriz[1];
	$year	= $matriz[0];
	
	$fecha= $day."/".$month."/".$year;
	$fecha= date($fecha);
	
	return $fecha;
}
}

function DateConvertF($fecha){
	$matriz= explode("/", $fecha);
if ($fecha!=""){
	$day	= $matriz[2];
	$month	= $matriz[1];
	$year	= $matriz[0];
	
	$fecha= $day."/".$month."/".$year;
	$fecha= date($fecha);
	
	return $fecha;
}
}

function Compra_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM facturacion WHERE Nro_Orden_Compra IS NULL");
 
 
echo "<select name='compra_combo[]' id='compra_combo[]'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Facturacion'].">".$reg['Nombre_Empresa']." / ".$reg['Nro_Cotizacion']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Facturacion'];

}

function Factura_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM facturacion WHERE Nro_Factura IS NULL AND Nro_Orden_Compra!=''");
 
 
 
echo "<select name='factura_combo[]' id='factura_combo[]'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Facturacion'].">".$reg['Nombre_Empresa']." / ".$reg['Nro_Cotizacion']." / ".$reg['Nro_Orden_Compra']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Facturacion'];

}

function Situacion_Cotizacion($id_cmb, $Situacion_Cotizacion){

$qry = "SELECT * FROM situacion";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Situacion']==$Situacion_Cotizacion)
			{
				echo "<option value='".$Reg['ID_Situacion']."' selected>".$Reg['Situacion']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Situacion']."'>".$Reg['Situacion']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Situacion'];
}

function Situacion_Orden_Compra($id_cmb, $Situacion_Orden_Compra){

$qry = "SELECT * FROM situacion_compra";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Situacion']==$Situacion_Orden_Compra)
			{
				echo "<option value='".$Reg['ID_Situacion']."' selected>".$Reg['Situacion']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Situacion']."'>".$Reg['Situacion']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Situacion'];
}

function Situacion_Factura($id_cmb, $Situacion_Factura){

	$qry = "SELECT * FROM situacion_factura";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Situacion_Factura']==$Situacion_Factura)
			{
				echo "<option value='".$Reg['ID_Situacion_Factura']."' selected>".$Reg['Situacion_Factura']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Situacion_Factura']."'>".$Reg['Situacion_Factura']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Situacion_Factura'];
}


function leer_archivo($nombre)
{
$dir = opendir("files");   // Indica el patch de la carpeta donde esten los archivos
while ($file = readdir($dir)) {
      // Eliges que ficheros deseas mostrar

$matriz= explode(".",$file);
	$nombre1	= $matriz[0];
	$extension	= $matriz[1]; // Para que no me muestre la extension del archivo
	

if($nombre1==$nombre && $nombre1!=""){
echo "<a href=files/".$nombre1.".".$extension.">$file</a><br>";

		}
	
}
closedir($dir);

}

function Factura_Combo_Selected($id_cmb, $ID_Facturacion)
{
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$qry 	= "SELECT * FROM facturacion";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Facturacion']==$ID_Facturacion)
			{
				echo "<option value='".$Reg['ID_Facturacion']."' selected>".$Reg['Nombre_Empresa']." - ".$Reg['Nro_Cotizacion']." - ".$Reg['Nro_Orden_Compra']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Facturacion']."'>".$Reg['Nombre_Empresa']." - ".$Reg['Nro_Cotizacion']." - ".$Reg['Nro_Orden_Compra']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Facturacion'];
}
	
	
function Orden_Combo_Selected($id_cmb, $ID_Facturacion)
{
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$qry 	= "SELECT * FROM facturacion";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Facturacion']==$ID_Facturacion)
			{
				echo "<option value='".$Reg['ID_Facturacion']."' selected>".$Reg['Nombre_Empresa']." - ".$Reg['Nro_Cotizacion']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Facturacion']."'>".$Reg['Nombre_Empresa']." - ".$Reg['Nro_Cotizacion']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Facturacion'];
}

function Ver_Rut(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT DISTINCT Rut_Empresa FROM facturacion ORDER BY Rut_Empresa ASC");
 
 
 
echo "<select name='rut' id='rut'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['Rut_Empresa'].">".$reg['Rut_Empresa']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['Rut_Empresa'];

}

function Cliente_Ver_Combo1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT DISTINCT Nombre_Empresa FROM facturacion ORDER BY Nombre_Empresa ASC"); 
 
 
echo "<select name='cliente' id='cliente'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value='$reg[Nombre_Empresa]'>$reg[Nombre_Empresa]</option>"; 
} 
echo "</select>"; 
 
 return $reg['Nombre_Empresa'];

}

function Ver_Vendedor(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM Vendedor");
 
 
 
echo "<select name='vendedor[]' id='vendedor[]'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Vendedor'].">".$reg['ID_Vendedor']." - ".$reg['Vendedor']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Vendedor'];

}

function Ver_Vendedor1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM Vendedor");
 
 
echo "<select name='vendedor' id='vendedor'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Vendedor'].">".$reg['ID_Vendedor']." - ".$reg['Vendedor']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Vendedor'];

}

function Situacion_Cotizacion1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM situacion");
 
 
echo "<select name='situacion' id='situacion'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Situacion'].">".$reg['Situacion']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Situacion'];

}

function Situacion_Compra1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM situacion_compra");
 
 
echo "<select name='situacion_compra' id='situacion_compra'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Situacion'].">".$reg['Situacion']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Situacion'];

}

function Situacion_Factura1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM situacion_factura");
 
 
echo "<select name='situacion_factura' id='situacion_factura'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Situacion_Factura'].">".$reg['Situacion_Factura']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Situacion_Factura'];

}


function Vendedor_Selected($id_cmb, $ID_Vendedor)
{
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$qry 	= "SELECT * FROM Vendedor";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Vendedor']==$ID_Vendedor)
			{
				echo "<option value='".$Reg['ID_Vendedor']."' selected>".$Reg['ID_Vendedor']." - ".$Reg['Vendedor']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Vendedor']."'>".$Reg['ID_Vendedor']." - ".$Reg['Vendedor']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Vendedor'];
}

function Seguimiento_Vendedor($vendedor){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT Vendedor FROM vendedor WHERE ID_Vendedor='$vendedor'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['Vendedor'];

}

function Seguimiento_Vendedor1($vendedor){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT correo FROM vendedor WHERE ID_Vendedor='$vendedor'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['correo'];

}

function Tipo_Moneda_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM tipo_moneda");
 
echo "<select name='moneda[]' id='moneda[]'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Tipo_Moneda'].">".$reg['Tipo_Moneda']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Tipo_Moneda'];

}

function Tipo_Moneda($moneda){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT Tipo_Moneda FROM tipo_moneda WHERE ID_Tipo_Moneda='$moneda'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['Tipo_Moneda'];

}

function Tipo_Moneda_Selected($id_cmb, $ID_Tipo_Moneda)
{
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$qry 	= "SELECT * FROM tipo_moneda";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Tipo_Moneda']==$ID_Tipo_Moneda)
			{
				echo "<option value='".$Reg['ID_Tipo_Moneda']."' selected>".$Reg['Tipo_Moneda']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Tipo_Moneda']."'>".$Reg['Tipo_Moneda']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Tipo_Moneda'];
}

function Tipo_Moneda_Combo_Selected($id_cmb, $ID_Tipo_Moneda)
{
	$qry = "SELECT * FROM tipo_moneda";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Tipo_Moneda']==$ID_Tipo_Moneda)
			{
				echo "<option value='".$Reg['ID_Tipo_Moneda']."' selected>".$Reg['Tipo_Moneda']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Tipo_Moneda']."'>".$Reg['Tipo_Moneda']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Tipo_Moneda'];
}

function Vendedor_Combo_Selected($id_cmb, $ID_Vendedor)
{
	$qry = "SELECT * FROM vendedor";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Vendedor']==$ID_Vendedor)
			{
				echo "<option value='".$Reg['ID_Vendedor']."' selected>".$Reg['Vendedor']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Vendedor']."'>".$Reg['Vendedor']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Vendedor'];
}


	
?>






