<?php
@session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
} 

include ("libreria.php");?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<script type="text/javascript" src="fun_cotizacion.js"></script>

<title>Mantenedor tbtransporte</title>
</head>

<body> 
<h1>&nbsp;&nbsp; Ingresar Valores de Transporte</h1>
<font color="#FF0000" size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Todos los valores deben ser ingresados sin IVA y en pesos chilenos</font>
<blockquote>
<form>
	<table width="976" cellpadding="3" cellspacing="3">
	<tr>
    <td width="195">Zona en la que se encuentra</td>
    <td width="749"><input type="text" name="zona" id="zona" maxlength="25" /></td>
    </tr>
	<tr>
    <td>Lugar Base</td>
    <td><input type="text" name="base" id="base" maxlength="25" /></td>
    </tr>
	<tr>
    <td>Tarifa Carro Móvil</td>
    <td><input type="text" name="tarifa1" id="tarifa1" onKeyPress="return soloLetras(event)" maxlength="21" />Ingrese valores sin puntos</td>
    </tr>
	<tr>
    <td>Tarifa Códec</td>
    <td><input type="text" name="tarifa2" id="tarifa2" onKeyPress="return soloLetras(event)" maxlength="21" /></td>
    </tr>
    <tr>
     <td>Tarifa Monitor</td>
    <td><input type="text" name="tarifa3" id="tarifa3" onKeyPress="return soloLetras(event)" maxlength="21" /></td>
    </tr> 
    <tr>
    <td>Entrega</td>
    <td width="749"><input type="text" name="entrega" id="entrega" maxlength="15" /></td><td width="0"></td>
    </tr> 
    <td></td>
    <td> <br/><input type="button" name="Enviar" id="Enviar" value="Enviar" onClick="javascript:validar2()"/> &nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Borrar" ></td>
    </tr>                    
	</table>                                                                 
</form>
</blockquote>
</body>
</html>