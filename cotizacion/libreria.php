<?php 

function Categoria_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("inventario", $con);

$result =mysql_query("SELECT * FROM categoria");
 
echo "<select name='categoria' id='categoria[]'>"; 
while($reg=mysql_fetch_array($result)) 
	{ 
	echo "<option value=".$reg['ID_Categoria'].">".$reg['Categoria']."</option>"; 
	} 
	echo "</select>"; 
 
return $reg['ID_Categoria'];

}

function Categoria_Combo1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("inventario", $con);

$result =mysql_query("SELECT * FROM categoria");
 
echo "<select name='categoria' id='categoria'>"; 
while($reg=mysql_fetch_array($result)) 
	{ 
	echo "<option value=".$reg['ID_Categoria'].">".$reg['Categoria']."</option>"; 
	} 
	echo "</select>"; 
 
return $reg['ID_Categoria'];

}


function Marca_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("inventario", $con);

$result =mysql_query("SELECT * FROM marca ORDER BY Marca");
 
echo "<select name='marca' id='marca[]'>"; 
while($reg=mysql_fetch_array($result)) 
	{ 
	echo "<option value=".$reg['ID_Marca'].">".$reg['Marca']."</option>"; 
	} 
	echo "</select>"; 
 
return $reg['ID_Marca'];

}



function Tipo_Moneda_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("dbmaster", $con);

$result =mysql_query("SELECT * FROM tbmoneda");
 
echo "<select name='moneda' id='moneda[]'>"; 
while($reg=mysql_fetch_array($result)) 
	{ 
	echo "<option value=".$reg['idtbmoneda'].">".$reg['descripcion']."</option>"; 
	} 
	echo "</select>"; 
 
return $reg['idtbmoneda'];

}

function Tipo_Moneda_Combo1(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("dbmaster", $con);

$result =mysql_query("SELECT * FROM tbmoneda");
 
echo "<select name='moneda' id='moneda'>"; 
while($reg=mysql_fetch_array($result)) 
	{ 
	echo "<option value=".$reg['idtbmoneda'].">".$reg['descripcion']."</option>"; 
	} 
	echo "</select>"; 
 
return $reg['idtbmoneda'];

}

function Tipo_Moneda_Combo2(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("dbmaster", $con);

$result =mysql_query("SELECT * FROM tbmoneda");
 
echo "<select name='moneda2' id='moneda2'>"; 
while($reg=mysql_fetch_array($result)) 
	{ 
	echo "<option value=".$reg['idtbmoneda'].">".$reg['descripcion']."</option>"; 
	} 
	echo "</select>"; 
 
return $reg['idtbmoneda'];

}

function Tipo_Moneda_Combo3(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("dbmaster", $con);

$result =mysql_query("SELECT * FROM tbmoneda");
 
echo "<select name='moneda3' id='moneda3'>"; 
while($reg=mysql_fetch_array($result)) 
	{ 
	echo "<option value=".$reg['idtbmoneda'].">".$reg['descripcion']."</option>"; 
	} 
	echo "</select>"; 
 
return $reg['idtbmoneda'];

}

function Tipo_Moneda_Combo4(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("dbmaster", $con);

$result =mysql_query("SELECT * FROM tbmoneda");
 
echo "<select name='moneda4' id='moneda4'>"; 
while($reg=mysql_fetch_array($result)) 
	{ 
	echo "<option value=".$reg['idtbmoneda'].">".$reg['descripcion']."</option>"; 
	} 
	echo "</select>"; 
 
return $reg['idtbmoneda'];

}

function Categoria_Combo_Selected($id_cmb, $idtbcategoria)
{
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$qry 	= "SELECT * FROM categoria";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['ID_Categoria']==$idtbcategoria)
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

function Marca_Combo_Selected($id_cmb, $ID_Marca)
{
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);
	
	$qry 	= "SELECT * FROM marca ORDER BY Marca";
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

function Moneda_Combo_Selected($id_cmb, $idtbmoneda)
{
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("dbmaster", $con);
	
	$qry 	= "SELECT * FROM tbmoneda";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['idtbmoneda']==$idtbmoneda)
			{
				echo "<option value='".$Reg['idtbmoneda']."' selected>".$Reg['descripcion']."</option>";
			}else{
				echo "<option value='".$Reg['idtbmoneda']."'>".$Reg['descripcion']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['idtbmoneda'];
}


function Categoria($categoria){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("inventario", $con);

 $result =mysql_query("SELECT Categoria FROM categoria WHERE ID_Categoria='$categoria'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['Categoria'];

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

function Tipo_Moneda($moneda){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("dbmaster", $con);

 $result =mysql_query("SELECT descripcion FROM tbmoneda WHERE idtbmoneda='$moneda'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['descripcion'];

}

function Estado($estado){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("dbmaster", $con);

 $result =mysql_query("SELECT descripcion FROM tbestado WHERE idtbestado='$estado'");
 
 $reg=mysql_fetch_array($result);
 
 return $reg['descripcion'];

}

function Estado_Combo_Selected($id_cmb, $idtbestado)
{
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("dbmaster", $con);
	
	$qry 	= "SELECT * FROM tbestado";
	$result = mysql_query($qry);
	$cont   = mysql_num_rows($result);
	
	echo "<select name='$id_cmb' id='$id_cmb'>";
	if($cont==0)
	{
		echo "<option>vacio</option>";
	}else{
		while($Reg = mysql_fetch_array($result))
		{
			if($Reg['idtbestado']==$idtbestado)
			{
				echo "<option value='".$Reg['idtbestado']."' selected>".$Reg['descripcion']."</option>";
			}else{
				echo "<option value='".$Reg['idtbestado']."'>".$Reg['descripcion']."</option>";
			}
		}
	}
	echo "</select>";
	
	$Reg['idtbestado'];
}

function Productos_Combo(){

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
mysql_select_db("dbmaster", $con);

$result =mysql_query("SELECT * FROM tbproductos ORDER BY nombre");
 
echo "<select name='productos' id='productos'>"; 
while($reg=mysql_fetch_array($result)) 
	{ 
	echo "<option value=".$reg['idtbproductos'].">".$reg['nombre']."</option>"; 
	} 
	echo "</select>"; 
 
return $reg['idtbproductos'];

}

function Moneda_Selected($id)
{
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	if (!$con)
    {
		die('Could not conect: ' . mysql_error() );
	}
	
	mysql_select_db("dbmaster", $con);
	
	$qry 	= mysql_query("SELECT * FROM tbmoneda WHERE idtbmoneda=$id");
	while ($filas=mysql_fetch_array($qry)) { 
	
	
	return $filas['descripcion'];
	
	}
}




?>
