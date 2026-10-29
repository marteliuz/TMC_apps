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



function Categoria($categoria){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT Categoria FROM Categoria WHERE ID_Categoria='$categoria'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['Categoria'];

}

function Cliente($clientes){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT Clientes FROM clientes WHERE ID_Clientes='$clientes'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['Clientes'];

}

function Lugar($lugar){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT Lugar FROM lugar WHERE ID_Lugar='$lugar'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['Lugar'];

}

function Marca($marca){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT Marca FROM marca WHERE ID_Marca='$marca'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['Marca'];

}


function Tipo_Guia($tipoguia){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT Tipo_Guia FROM tipo_guia WHERE ID_Tipo_Guia='$tipoguia'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['Tipo_Guia'];

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


function Categoria_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM categoria");
 
 
 
echo "<select name='' id='categoria'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Categoria'].">".$reg['Categoria']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Categoria'];

}

function Cliente_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM clientes ORDER BY Clientes ASC");
 
 
 
echo "<select name='' id='cliente'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Clientes'].">".$reg['Clientes']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Clientes'];

}

function Marca_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM marca ORDER BY marca ASC");
 
 
 
echo "<select name='' id='marca'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Marca'].">".$reg['Marca']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Marca'];

}

function Tipo_Guia_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM tipo_guia");

echo "<select name='' id='tipo'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Tipo_Guia'].">".$reg['Tipo_Guia']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Tipo_Guia'];

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
 
echo "<select name='' id='moneda'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Tipo_Moneda'].">".$reg['Tipo_Moneda']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Tipo_Moneda'];

}


function Lugar_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM lugar");
 
echo "<select name='' id='lugar'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Lugar'].">".$reg['Lugar']."</option>"; 
} 
echo "</select>";
 
 return $reg['ID_Lugar'];

}



function Categoria_Ver_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM categoria");
 
echo "<select name='categoria' onchange='javascript:filtrar1()' id='categoria'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Categoria'].">".$reg['Categoria']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Categoria'];

}

function Categoria_Ver_Combo_Visita(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM categoria");
 
echo "<select name='categoria' onchange='javascript:filtrar1_visita()' id='categoria'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Categoria'].">".$reg['Categoria']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Categoria'];

}

function Marca_Ver_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM marca ORDER BY marca ASC");
 
 
 
echo "<select onchange='javascript:filtrar1()' name='marca' id='marca'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Marca'].">".$reg['Marca']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Marca'];

}

function Marca_Ver_Combo_Visita(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM marca ORDER BY marca ASC");
 
 
 
echo "<select onchange='javascript:filtrar1_visita()' name='marca' id='marca'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Marca'].">".$reg['Marca']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Marca'];

}

function Lugar_Ver_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM lugar");
 
echo "<select onchange='javascript:filtrar1()' name='lugar' id='lugar'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Lugar'].">".$reg['Lugar']."</option>"; 
} 
echo "</select>";
 
 return $reg['ID_Lugar'];

}

function Lugar_Ver_Combo_Visita(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM lugar");
 
echo "<select onchange='javascript:filtrar1_visita()' name='lugar' id='lugar'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Lugar'].">".$reg['Lugar']."</option>"; 
} 
echo "</select>";
 
 return $reg['ID_Lugar'];

}

function Categoria_Ver_Combo1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM categoria");
 
 
 
echo "<select name='categoria' onchange='javascript:filtrar()' id='categoria'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Categoria'].">".$reg['Categoria']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Categoria'];

}
function Categoria_Ver_Combo1_Visita(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM categoria");
 
 
 
echo "<select name='categoria' onchange='javascript:filtrar_visita()' id='categoria'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Categoria'].">".$reg['Categoria']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Categoria'];

}

function Cliente_Ver_Combo1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM clientes ORDER BY Clientes ASC");
 
 
 
echo "<select name='cliente' onchange='javascript:filtrar()' id='cliente'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Clientes'].">".$reg['Clientes']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Clientes'];

}

function Cliente_Ver_Combo1_Visita(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM clientes ORDER BY Clientes ASC");
 
 
 
echo "<select name='cliente' onchange='javascript:filtrar_visita()' id='cliente'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Clientes'].">".$reg['Clientes']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Clientes'];

}


function Marca_Ver_Combo1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM marca ORDER BY marca ASC");
 
 
 
echo "<select onchange='javascript:filtrar()' name='marca' id='marca'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Marca'].">".$reg['Marca']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Marca'];

}

function Marca_Ver_Combo1_Visita(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM marca ORDER BY marca ASC");
 
 
 
echo "<select onchange='javascript:filtrar_visita()' name='marca' id='marca'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option  value=".$reg['ID_Marca'].">".$reg['Marca']."</option>"; 
} 
echo "</select>"; 
 
 return $reg['ID_Marca'];

}

function Lugar_Ver_Combo1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM lugar");
 
echo "<select onchange='javascript:filtrar()' name='lugar' id='lugar'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Lugar'].">".$reg['Lugar']."</option>"; 
} 
echo "</select>";
 
 return $reg['ID_Lugar'];

}

function Lugar_Ver_Combo1_Visita(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT * FROM lugar");
 
echo "<select onchange='javascript:filtrar_visita()' name='lugar' id='lugar'>"; 
while($reg=mysql_fetch_array($result)) 
{ 
echo "<option value=".$reg['ID_Lugar'].">".$reg['Lugar']."</option>"; 
} 
echo "</select>";
 
 return $reg['ID_Lugar'];

}

function Categoria_Combo_Selected($id_cmb, $ID_Categoria)
{
	$qry = "SELECT * FROM categoria";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Categoria']==$ID_Categoria)
			{
				echo "<option value='".$Reg['ID_Categoria']."' selected>".$Reg['Categoria']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Categoria']."'>".$Reg['Categoria']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Categoria'];
}

function Tipo_Guia_Combo_Selected($id_cmb, $ID_Tipo_Guia)
{
	$qry = "SELECT * FROM tipo_guia";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Tipo_Guia']==$ID_Tipo_Guia)
			{
				echo "<option value='".$Reg['ID_Tipo_Guia']."' selected>".$Reg['Tipo_Guia']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Tipo_Guia']."'>".$Reg['Tipo_Guia']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Tipo_Guia'];
}

function Marca_Combo_Selected($id_cmb, $ID_Marca)
{
	$qry = "SELECT * FROM marca ORDER BY marca ASC";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Marca']==$ID_Marca)
			{
				echo "<option value='".$Reg['ID_Marca']."' selected>".$Reg['Marca']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Marca']."'>".$Reg['Marca']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Marca'];
}

function Cliente_Combo_Selected($id_cmb, $ID_Cliente)
{
	$qry = "SELECT * FROM clientes ORDER BY Clientes ASC";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Clientes']==$ID_Cliente)
			{
				echo "<option value='".$Reg['ID_Clientes']."' selected>".$Reg['Clientes']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Clientes']."'>".$Reg['Clientes']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Clientes'];
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

function Lugar_Combo_Selected($id_cmb, $ID_Lugar)
{
	$qry = "SELECT * FROM lugar";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Lugar']==$ID_Lugar)
			{
				echo "<option value='".$Reg['ID_Lugar']."' selected>".$Reg['Lugar']."</option>";
			}else{
				echo "<option value='".$Reg['ID_Lugar']."'>".$Reg['Lugar']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['ID_Lugar'];
}



