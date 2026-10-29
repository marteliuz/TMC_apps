<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}
include ("fecha.php"); 
?>
<script type="text/javascript" src="fun_inv.js"></script>
<script language='javascript' src='popcalendar.js'></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/fuente1.css" media="screen" />
<style type="text/css">
#apDiv1 {
	position:absolute;
	left:1px;
	top:191px;
	width:492px;
	height:270px;
	z-index:1;
}
</style>
</head>

<body>
<blockquote>
<form name="form1" method="post">
<table width="400" cellpadding="3" cellspacing="3">
	<tr>
           <td><font size=2>Encargado Control </font></td>
           <td><input type="text" readonly="readonly" name="encargado1" id="encargado1" style="color:#00C; font-weight:bold;" value="<?php echo $_SESSION['name']?>" /></td>
      </tr>
      <tr>
           <td><font size=2>Fecha Control</font> </td>
           <td><input name="fecha1" type="text" id = "fecha1" onclick = "popCalendar.show (this,this,'dd/mm/yyyy','es')" value="<?php echo date("d/m/Y"); ?>"/></td>
      </tr>
       <td><font size=2>Lugar de control</font></td>
           <td> <?php echo Lugar_Combo(); ?></td>
             </tr>
      <tr>
           <td><font size=2> ¿Está correcto el Inventario?</font></td>
           <td><input type="checkbox" name="checkbox" id="checkbox" /></td>
    
      <tr>
      </tr>
       <tr>
           <td></td>
           <td> <br/><a href='#' title="enviar" onClick="control1();"><img src='enviar.png' height="29"></a>&nbsp;&nbsp;&nbsp; <img src="borrar.png" onclick="document.form1.reset()" style="CURSOR:hand" title="borrar"></td>
         </tr>
      </table> 
  </form>
</blockquote>
</body>
</html>