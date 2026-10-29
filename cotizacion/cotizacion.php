<?php
@session_start();
 include ("libreria.php");?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="fun_cotizacion.js"></script>
<script>
var contador=isNaN(parseInt(window.name))?1:parseInt(window.name);
contador++;
window.name=contador;
document.cookie ='contador='+contador+'; expires=Thu, 2 Aug 2021 20:47:11 UTC; path=/';
</script>
</head>
<?php 
$contador =  $_COOKIE["contador"];
if ($contador>="1"){
$_SESSION['$id'] ="";
$_SESSION['$rows'] ="";
$_SESSION['$cantidad'] ="";
$_SESSION['data']="";
$_SESSION['$i']="";
} ?>
<style type="text/css">
body {
margin: 5%;
font-family: verdana, arial;
font-size: 100%;
}
.tabla_actores {
font-size: 0.8em;
border-spacing:0;
border-collapse: collapse;
}
.tabla_actores th {
border: 1px solid #666;
background-color: #999;
color: #fff;
padding: 0.4em;
width: 50px;
}
.tabla_actores td {
border: 1px solid #ccc;
margin:0;
padding: 0.4em;
}
.tabla_actores tr:nth-child(2n+1) {
background-color: #ededed;
}
</style>
</head>

<body>
<blockquote>
<form method="post" enctype="text/multipart">
	<table width="135" cellpadding="3" cellspacing="3">
    <td width="17" height="56" > <?php echo Productos_Combo(); ?></td><td width="45"> <image name="agregar" title="agregar producto" id="Add Row" value="aceptar" style="cursor:pointer" src="mas2.png" width="45" height="50" border="0" onclick="load_tablas()" alt="agregar producto"></td>
	</tr>                    
	</table>                                                                 
</form>
</blockquote>
<div id="muestra_contenido_ajax">
</div>
</body>
</html>