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

<title>Mantenedor tbmantención</title>
</head>

<body> 
<h1>&nbsp;&nbsp; Ingresar Servicio Mantención</h1>
<font color="#FF0000" size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Todos los valores deben ser ingresados sin IVA</font>
<blockquote>
<form>
	<table width="976" cellpadding="3" cellspacing="3">
	<tr>
    <td width="226">Nombre Equipo con Mantención</td>
    <td width="727"><input type="text" name="nombre" id="nombre" maxlength="50" /></td>
    </tr>
	<tr>
    <td>Part-Number</td>
    <td><input type="text" name="part" id="part" maxlength="25" /></td>
    </tr>
	<tr>
    <td>Categoría</td>
    <td> <?php echo Categoria_Combo1(); ?></td>
    </tr>
	<tr>
    <td>Part-Number Asociado</td>
    <td><input type="text" name="part2" id="part2" maxlength="25" /></td>
    </tr>
    <tr>
    <td>Descripción del Equipo</td>
    <td><textarea id="descripcion" onKeyUp="contar(this);" cols="60" rows="10" name="descripcion"></textarea>
      <span id="letras">800/800 caracteres</span></td>
    </tr> 
    <tr>
    <td>Valor Mantención</td>
    <td> <?php echo Tipo_Moneda_Combo1(); ?><input type="text" name="precio" id="precio" onKeyPress="return soloLetras(event)" maxlength="21"/>Ingrese valor sin puntos. Si usa centavos agregue &quot;,&quot; (coma)</td>
    </tr> 
    <td></td>
    <td> <br/><input type="button" name="Enviar" id="Enviar" value="Enviar" onClick="javascript:validar1()"/> &nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Borrar" ></td>
    </tr>                    
	</table>                                                                 
</form>
</blockquote>
</body>
</html>