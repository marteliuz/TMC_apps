<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("libreria.php");

$id        = $_GET['id'];
	
	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
mysql_select_db("dbmaster",$con);

$result= mysql_query("SELECT * FROM tbproductos WHERE idtbproductos='$id'", $con);

 
$data=mysql_fetch_array($result); 

?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type='text/javascript' src='fun_cotizacion.js'></script></head>
<body>

<form method="post" action="subir_update.php" enctype="multipart/form-data">
	<table width="630">
	<tr><td width="241">ID</td><td width="377"><input type="text" readonly="readonly" name="id" id="id" value="<?php echo $data["idtbproductos"]?>" /></td></tr>
	<tr><td>Nombre</td><td><input type="text" name="nombre" id="nombre" maxlength="50" value="<?php echo $data["nombre"]; ?>"/></td></tr>
	<tr><td>Part Number</td><td><input type="text" name="part" id="part"  value="<?php echo $data["part_number"]?>" maxlength="25" /></td></tr>
	<tr><td>Categoría</td><td><?php Categoria_Combo_Selected('categoria',$data["categoria"]);?></td></tr>
	<tr><td>Marca</td><td><?php Marca_Combo_Selected('marca',$data["marca"]);?></td></tr>
	<tr><td>Imagen</td><?php echo"<td><img src='visor.php?id=".$data['idtbproductos']."' alt='Imagen desde Blob' /></td>";?></tr>
    <tr><td>Nombre Imagen</td><td><input type="text" readonly="readonly" name="nombreimg" id="nombreimg" value="<?php echo $data["nombreimg"]?>" /></td></tr>
    <tr><td>Tipo de Imagen</td><td><input type="text" readonly="readonly" name="tipo" id="tipo" value="<?php echo $data["tipo"]?>" /></td></tr>
    <tr><td>Fecha Ingreso</td><td><input type="text" readonly="readonly" name="fecha" id="fecha" value="<?php echo $data["fecha"]?>" /></td></tr>
    <tr>   
    <td>Cambiar Imagen</td>
    <td><input type="file" name="archivo" id="archivo"></td>
    </tr>
	<tr><td>Descripción</td><td> <textarea onKeyUp="contar(this);" name="descripcion" id="descripcion" cols="60" rows="10"><?php echo $data["descripcion"]?></textarea><span id="letras">800/800 caracteres</span></td></tr>
	<tr><td>Moneda y Precio</td><td><?php Moneda_Combo_Selected('moneda',$data["moneda"]); ?><input type="text" name="precio" id="precio" onKeyPress="return soloLetras(event)" maxlength="21" value="<?php echo $data["precio"]?>" /></td></tr>
	<tr><td>Moneda y Precio Instalación Central</td><td><?php Moneda_Combo_Selected('moneda2',$data["moneda2"]); ?><input type="text" name="precio2" id="precio2" onKeyPress="return soloLetras(event)" maxlength="21" value="<?php echo $data["precio2"]?>" /></td></tr>
	<tr><td>Moneda y Precio Instalación Norte y Sur</td><td><?php Moneda_Combo_Selected('moneda3',$data["moneda3"]); ?><input type="text" name="precio3" id="precio3" onKeyPress="return soloLetras(event)" maxlength="21" value="<?php echo $data["precio3"]?>" /></td></tr>
	<tr><td>Moneda y Precio Instalación Sur Extremo</td><td><?php Moneda_Combo_Selected('moneda4',$data["moneda4"]); ?><input type="text" name="precio4" id="precio4" onKeyPress="return soloLetras(event)" maxlength="21" value="<?php echo $data["precio4"]?>" /></td></tr>
	<tr><td>Estado</td><td><?php Estado_Combo_Selected('estado',$data["estado"]); ?></td></tr>
    <tr><td>Ip Pc Subida</td><td><input type="text" readonly="readonly" name="ip" id="ip" value="<?php echo $data["ip"]?>" /></td></tr>
	</table><br>
&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
<input name="Enviar" type="submit" value="Enviar" />
&nbsp;<input name="button" type="button" onClick="window.close();" value="Cancelar" />
</form>
</body>
</html>
<?php

mysql_close($con);

?> 