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

$result= mysql_query("SELECT * FROM tbmantencion WHERE idtbmantencion='$id'", $con);

 
$data=mysql_fetch_array($result); 

?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type='text/javascript' src='fun_cotizacion.js'></script></head>
<body>

<form>
	<table width="630">
	<tr><td width="241">ID</td><td width="377"><input type="text" readonly="readonly" name="id" id="id" value="<?php echo $data["idtbmantencion"]?>" /></td></tr>
	<tr><td>Nombre</td><td><input type="text" name="nombre" id="nombre" maxlength="50" value="<?php echo $data["nombre"]; ?>"/></td></tr>
	<tr><td>Part Number</td><td><input type="text" name="part" id="part"  value="<?php echo $data["part_number"]?>" maxlength="25" /></td></tr>
	<tr><td>Categoría</td><td><?php Categoria_Combo_Selected('categoria',$data["categoria"]);?></td></tr>
	<tr><td>Part Number Asociado</td><td><input type="text" name="part2" id="part2"  value="<?php echo $data["part_number_asociado"]?>" maxlength="25" /></td></tr>
	<tr><td>Descripción</td><td> <textarea onKeyUp="contar(this);" name="descripcion" id="descripcion" cols="60" rows="10"><?php echo $data["descripcion"]?></textarea><span id="letras">800/800 caracteres</span></td></tr>
	<tr><td>Moneda y Precio Mantención</td><td><?php Moneda_Combo_Selected('moneda',$data["moneda"]); ?><input type="text" name="precio" id="precio" onKeyPress="return soloLetras(event)" maxlength="21" value="<?php echo $data["precio"]?>" /></td></tr>
	</table><br>
&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
<input name="Enviar" type="button" value="Enviar" onClick="javascript=validar_update()"/>
&nbsp;<input name="button" type="button" onClick="window.close();" value="Cancelar" />
</form>
</body>
</html>
<?php

mysql_close($con);

?> 