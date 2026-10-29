<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");?>
<title>Inv_usado_Control</title>
<script type="text/javascript" src="fun_inv.js"></script>
<script language='javascript' src='popcalendar.js'></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
</head>

<body>
<blockquote>
<form name="form1" method="post" >
<table width="600" cellpadding="3" cellspacing="3">
<tr>
           <td width="189"><font size=2>Nro Guía de Despacho Retiro</font></td>
           <td width="388"><input type="text" name="despacho" id="despacho" onkeypress="return soloLetras(event)" maxlength="8"/></br></td>
      </tr>
      <td><font size=2>Nro Factura Venta</font> </td>
           <td><input type="text" name="factura" id="factura" onkeypress="return soloLetras(event)" maxlength="8" /></br></td>
            </tr>
        <td><font size=2>Cliente</font></td>
           <td> <?php echo Cliente_Combo(); ?></br></td>
      </tr>
       <tr>
           <td><font size=2>Fecha Salida</font></td>
           <td> <input name="fecha" type="text" id = "dateArrival" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo date("d/m/Y"); ?>"/></td>
           </tr>
            <tr>
           <td><font size=2>Encargado de Salida</font></td>
           <td> <input type="text" readonly="readonly" name="encargadosalida" id="encargadosalida" style="color:#00C; font-weight:bold;" value="<?php echo $_SESSION['name']?>" /></td>
           </tr>
            <tr>
              <td><font size=2>Encargado Control</font> </td>
              <td><input type="text" readonly="readonly" name="encargado1" id="encargado1" style="color:#00C; font-weight:bold;" value="<?php echo $_SESSION['name']?>" /></td>
            </tr>
            <tr>
              <td><font size=2>Fecha Control </font></td>
              <td><input name="fecha1" type="text" id = "fecha1" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')"/></td>
            </tr>
            <td height="24"></td>
           <td> </td>
 </tr> 
             <td><font size=2>Buscar  por:</font></td>
            <td> </td></tr> 
             <td><font size=2>•Categoría</font></td>
           <td> <?php echo Categoria_Combo(); ?></td>
 </tr> 
    <td><font size=2>•Nombre</font></td>
           <td> <input type="text" name="nombre" id="nombre" /></td>
 </tr> 
 <td><font size=2>•Nro Guía Despacho</font></td>
           <td> <input type="text" name="despacho1" id="despacho1" /></td>
 </tr> 
 <tr>
             <td><font size=2>•Nro Serie</font></td>
           <td> <input type="text" name="serie" id="serie" /></td>
 </tr> 
            <tr>
           <td></td>
           <td>  <br/><a href='#' title="enviar" onClick="retirar_control();"><img src='enviar.png' height="29"></a>&nbsp;&nbsp;&nbsp; <img src="borrar.png" onclick="document.form1.reset()" style="CURSOR:hand" title="borrar"></td>
          </tr>
           </table>  
           </form>

</body>
</html>
