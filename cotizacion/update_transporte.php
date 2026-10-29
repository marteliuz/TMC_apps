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

$result= mysql_query("SELECT * FROM tbtransporte WHERE idtbtransporte='$id'", $con);

 
$data=mysql_fetch_array($result); 

?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type='text/javascript' src='fun_cotizacion.js'></script></head>
<body>

<form>
	<table width="630">
	<tr><td width="241">ID</td><td width="377"><input type="text" readonly="readonly" name="id" id="id" value="<?php echo $data["idtbtransporte"]?>" /></td></tr>
	<tr><td>Zona</td><td><input type="text" name="zona" id="zona" value="<?php echo $data["zona"]; ?>" maxlength="25"/></td></tr>
	<tr><td>Lugar Base</td><td><input type="text" name="base" id="base" maxlength="25" value="<?php echo $data["base"];?>"/></td></tr>
	<tr><td>Tarifa Premium Carro Móvil</td><td><input type="text" name="tarifa1" id="tarifa1" onKeyPress="return soloLetras(event)" value="<?php echo $data["tarifa_premium_carro_movil"];?>" maxlength="21"/></td></tr>
	<tr><td>Tarifa Premium Códec</td><td><input type="text" name="tarifa2" id="tarifa2" onKeyPress="return soloLetras(event)" value="<?php echo $data["tarifa_premium_codec"];?>" maxlength="21"/></td></tr>
	<tr><td>Tarifa Premium Monitor</td><td><input type="text" name="tarifa3" id="tarifa3" onKeyPress="return soloLetras(event)" value="<?php echo $data["tarifa_premium_monitor"];?>" maxlength="21"/></td></tr>
	<tr><td>Tiempo Entrega Premium</td><td><input type="text" name="entrega" id="entrega" value="<?php echo $data["entrega_premium"]; ?>"  maxlength="15"/></td></tr>
	<tr><td>Tarifa Priority Carro Móvil</td><td><input type="text" name="tarifa4" id="tarifa4" onKeyPress="return soloLetras(event)" value="<?php echo $data["tarifa_priority_carro_movil"];?>" maxlength="21"/></td></tr>
	<tr><td>Tarifa Priority Códec</td><td><input type="text" name="tarifa5" id="tarifa5" onKeyPress="return soloLetras(event)" value="<?php echo $data["tarifa_priority_codec"];?>" maxlength="21"/></td></tr>
	<tr><td>Tarifa Priority Monitor</td><td><input type="text" name="tarifa6" id="tarifa6" onKeyPress="return soloLetras(event)" value="<?php echo $data["tarifa_priority_monitor"];?>" maxlength="21"/></td></tr>
	<tr><td>Tiempo Entrega Priority</td><td><input type="text" name="entrega2" id="entrega2" value="<?php echo $data["entrega_priority"]; ?>"  maxlength="15"/></td></tr>
	<tr><td>Tarifa Express Carro Móvil</td><td><input type="text" name="tarifa7" id="tarifa7" onKeyPress="return soloLetras(event)" value="<?php echo $data["tarifa_express_carro_movil"];?>" maxlength="21"/></td></tr>
	<tr><td>Tarifa Express Códec</td><td><input type="text" name="tarifa8" id="tarifa8" onKeyPress="return soloLetras(event)" value="<?php echo $data["tarifa_express_codec"];?>" maxlength="21"/></td></tr>
	<tr><td>Tarifa Express Monitor</td><td><input type="text" name="tarifa9" id="tarifa9" onKeyPress="return soloLetras(event)" value="<?php echo $data["tarifa_express_monitor"];?>" maxlength="21"/></td></tr>
	<tr><td>Tiempo Entrega Express</td><td><input type="text" name="entrega3" id="entrega3" value="<?php echo $data["entrega_express"]; ?>"  maxlength="15"/></td></tr>
	
	</table><br>
&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
<input name="Enviar" type="button" value="Enviar" onClick="javascript=validar_update1()"/>
&nbsp;<input name="button" type="button" onClick="window.close();" value="Cancelar" />
</form>
</body>
</html>
<?php

mysql_close($con);

?> 