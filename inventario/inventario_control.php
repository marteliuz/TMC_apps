<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>inventario_control</title>
<script type="text/javascript" src="fun_inv.js"></script>
<script language='javascript' src='popcalendar.js'></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
</head>

<body><blockquote>
<form name="form2" method="post">
<table width="678" cellpadding="3" cellspacing="3">
		<tr>
           <td width="207"><font size=2>Nro Guía de Despacho o Factura </font></td>
           <td width="448"><?php echo Tipo_Guia_Combo(); ?><input type="text" name="despacho" id="despacho" onKeyPress="return soloLetras(event)" maxlength="8" /></br></td>
      </tr>
      <tr>
           <td><font size=2>Código de Barras </font></td>
           <td width="448"><input type="text" name="codigo" id="codigo" onChange="javascript:completar()" maxlength="15" /></br></td>
      </tr>
		 <tr>
           <td><font size=2>Nro Serie</font></td>
           <td><input type="text" name="serie" id="serie" maxlength="25" /></td>
         </tr>
		 <tr>
           <td><font size=2>Nombre</font></td>
           <td> <input type="text" name="nombre" id="nombre" maxlength="50" /></td>
         </tr>
		 <tr>
           <td><font size=2>Categoría</font></td>
           <td> <?php echo Categoria_Combo(); ?></td>
         </tr> 
         <tr>
           <td><font size=2>Marca</font></td>
           <td> <?php echo Marca_Combo(); ?></td>
         </tr>   
          <tr>   
         <td><font size=2>Valor</font></td>
           <td><?php echo Tipo_Moneda_Combo(); ?><input type="text" name="valor" id="valor" onKeyPress="return soloLetras(event)" maxlength="21"/>
           <font size=2>valor sin puntos <br /></td>
         </tr>  
         <tr>   
         <td><font size=2>Fecha ingreso</font> </td>
           <td><input name="fecha" type="text" id = "dateArrival" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo date("d/m/Y"); ?>"/><font size=2></td>
         
		 </tr> 
         <tr>   
         <td><font size=2>Descripción</font></td>
           <td><font size=2><textarea name="textarea" id="textarea" onKeyUp="contar(this);"cols="45" rows="5"></textarea><span id="letras">200/200</span></font></td>
         </tr> 
          <td><font size=2>Lugar donde se encuentra:</font></td>
           <td> <?php echo Lugar_Combo(); ?></td>
         </tr>
         <tr>   
         <td> <font size=2>Encargado de Ingreso </font></td>
           <td> <input type="text" readonly="readonly" name="ingreso" id="ingreso" style="color:#00C; font-weight:bold;" value="<?php echo $_SESSION['name']?>" /></td>
         </tr> 
          <tr>   
         <td></td>
           <td> <br/><a href='#' title="enviar" onClick="eleccion();"><img src='enviar.png' height="29"></a>&nbsp;&nbsp;&nbsp; <img src="borrar.png" onclick="document.form1.reset()" style="CURSOR:hand" title="borrar"></td>
         </tr>              
	</table>                                                                 
	</form>
    </blockquote>
   
</body>
</html>
