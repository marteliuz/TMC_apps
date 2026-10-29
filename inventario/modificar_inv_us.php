<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");?>
<title>modificar</title>
<script type="text/javascript" src="fun_inv.js"></script>
<script language='javascript' src='popcalendar.js'></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
</head>

<body>
<blockquote>
<form name="form1" method="post">
<table width="600" cellpadding="3" cellspacing="3">
       <tr>
           <td width="254"><font size=2>Fecha de Modificación</font></td>
           <td width="323"> <input name="fecha" type="text" id = "dateArrival" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo date("d/m/Y"); ?>"/></td>
           </tr>
            <tr>
           <td><font size=2>Encargado de Modificación</font></td>
           <td>  <input type="text" readonly="readonly" name="encargadoingreso" id="encargadoingreso" style="color:#00C; font-weight:bold;" value="<?php echo $_SESSION['name']?>" /></td>
           </tr>
           <td height="24"></td>
           <td> </td>
 </tr> 
           <td><font size=2>Buscar  por:&nbsp; &nbsp;•Categoría</font></td>
           <td> <?php echo Categoria_Combo(); ?></td>
 </tr> 
    <td><font size=2> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;•Nombre</font></td>
           <td> <input type="text" name="nombre" id="nombre" /></td>
 </tr> 
 <td><font size=2> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;•Nro Guía Despacho Retiro</font></td>
           <td> <input type="text" name="despacho1" id="despacho1" /></td>
 </tr> 
 <tr>
             <td><font size=2>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;•Nro Serie</font></td>
           <td> <input type="text" name="serie" id="serie" /></td>
 </tr> 
            <tr>
           <td></td>
           <td>  <br/><a href='#' title="enviar" onClick="modificar_inv_us();"><img src='enviar.png' height="29"></a>&nbsp;&nbsp;&nbsp; <img src="borrar.png" onclick="document.form1.reset()" style="CURSOR:hand" title="borrar"></td>
         </tr>
           </table>  
           </form>
</blockquote>
</body>
</html>
