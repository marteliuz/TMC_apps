<?php include ("fecha.php");?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>busqueda</title>
<script type="text/javascript" src="fun_inv.js"></script>
<script language='javascript' src='popcalendar.js'></script>
</head>

<body>
<blockquote>
<form name="form1" method="post">
<font size=3>Búsqueda por: (puede buscar por uno o más campos)</font><br><br>
	<table width="600" cellpadding="3" cellspacing="3">
		<tr>
           <td width="213"><font size=2>Tipo de Guía de Despacho</font></td>
           <td width="364"><?php echo Tipo_Guia_Combo(); ?></td>
      </tr>
		 <tr>
           <td><font size=2>Nro Guía de Despacho  Ingreso</font></td>
           <td><input type="text" name="despacho1" id="despacho1" />
           </br></td>
      </tr>
		 <tr>
           <td><font size=2>Nro Serie</font></td>
           <td><input type="text" name="serie" id="serie" /></td>
         </tr>
		 <tr>
           <td><font size=2>Nombre</font></td>
           <td> <input type="text" name="nombre" id="nombre" /></td>
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
         <td><font size=2>Fecha ingreso </font></td>
           <td><input name="fecha" type="text" id = "dateArrival" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')"/> </td>
         </tr>  
          <td><font size=2>Lugar donde se encuentra:</font></td>
           <td><?php echo Lugar_Combo(); ?></td>
         </tr>
         <tr>   
         <td> <font size=2>Encargado de Ingreso</font> </td>
           <td> <input type="text" name="ingreso" id="ingreso" /></td>
         </tr> 
          <tr>   
         <td></td>
           <td> <a href='#' title="enviar" onClick="busqueda_visita();"><img src='enviar.png' height="29"></a>&nbsp;&nbsp;&nbsp; <img src="borrar.png" onclick="document.form1.reset()" style="CURSOR:hand" title="borrar"></td>
         </tr>                    
	</table>                                                                 
	</form>
</blockquote>
</body>
</html>
