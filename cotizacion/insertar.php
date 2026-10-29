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

<title>Mantenedor tbproductos</title>
</head>

<body> 
<h1>&nbsp;&nbsp; Ingresar Nuevo Producto</h1>
<font color="#FF0000" size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Todos los valores deben ser ingresados sin IVA</font>
<blockquote>
<form method="post" action="subir_cotizacion.php" enctype="multipart/form-data">
	<table width="825" cellpadding="3" cellspacing="3">
	<tr>
    <td width="157">Nombre de equipo </td>
    <td width="625"><input type="text" name="nombre" id="nombre" maxlength="60" /></td>
    </tr>
	<tr>
    <td>Part-Number</td>
    <td><input type="text" name="part" id="part" maxlength="25" /></td>
    </tr>
	<tr>
    <td>Categoría</td>
    <td> <?php echo Categoria_Combo(); ?></td>
    </tr>
	<tr>
    <td>Marca</td>
    <td> <?php echo Marca_Combo(); ?></td>
    </tr>
    <tr>
    <td>Descripción del Equipo</td>
    <td> <textarea id="descripcion" onkeyup="contar(this);" cols="60" rows="10" name="descripcion"></textarea>
      <span id="letras">800/800 caracteres</span></td>
    </tr> 
    <tr>
    <td>Valor</td>
    <td> <?php echo Tipo_Moneda_Combo(); ?><input type="text" name="precio" id="precio" onkeypress="return soloLetras(event)" maxlength="21"/> 
    Ingrese valor sin puntos. Si usa centavos agregue &quot;,&quot; (coma)</td>
    </tr> 
	<td>Valor Instalación</td>
    <td>Zona Central &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Tipo_Moneda_Combo2(); ?><input type="text" name="precio2" id="precio2" onKeyPress="return soloLetras(event)" maxlength="21"/></td>
    </tr>
	<tr> 
	<td></td>
    <td>Zona Norte y Sur &nbsp;<?php echo Tipo_Moneda_Combo3(); ?><input type="text" name="precio3" id="precio3" onKeyPress="return soloLetras(event)" maxlength="21"/></td>
    </tr>
	<tr> 
	<td></td>
    <td>Zona Sur Extremo <?php echo Tipo_Moneda_Combo4(); ?><input type="text" name="precio4" id="precio4" onKeyPress="return soloLetras(event)" maxlength="21"/></td>
    </tr>
    <tr>   
    <td>Subir Imagen (Máx. 1mb)</td>
    <td><input  type = "hidden"   name = "MAX_FILE_SIZE "  value = "1024000"  /> <input type="file" name="archivo" id="archivo"></td>
    </tr> 
    <tr>   
    <td></td>
    <td> <br/><input type="button" name="Enviar" id="Enviar" value="Enviar" onClick="javascript:validar(this.form, this.form.archivo.value)"/> &nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Borrar" ></td>
    </tr>                    
	</table>                                                                 
</form>
</blockquote>
</body>
</html>