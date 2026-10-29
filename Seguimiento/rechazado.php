<?php @session_start();

if($_SESSION["autentica"] != "SIP"){

header("Location: index.php");
exit();
}

include ("fecha.php");

$id        = $_GET['id'];

	$con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("inventario",$con);

	$result= mysql_query("SELECT * FROM facturacion WHERE ID_Facturacion='$id'", $con);

 
	$data=mysql_fetch_array($result); 
	
	
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript" language='javascript' src="fun_seg.js"></script>
</head>

<body> 

<blockquote>
<form name="form" action="rechazado2.php">
		<table width="678" cellpadding="3" cellspacing="3">
		<tr>
        <td>Detalle de la causa del rechazo</td>
		</tr>
		<tr>
		<td><textarea onKeyUp="contar1(this);" name="descripcion" id="descripcion" cols="60" rows="10"><?php echo $data["Detalle"]?></textarea><span id="letras">200/200 caracteres</span></td>
		</tr>
		<tr>
		<td><input type="hidden" name="id" value="<?php echo $id ?>"></td>	
		</tr>
		<tr>
        <td>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;<input type="submit" name="Enviar" id="Enviar" value="Enviar"/>
&nbsp; &nbsp; &nbsp; &nbsp;
<input type="reset" value="Borrar" ></td>
        </tr>                    
		</table>                                                                 
</form>
</blockquote>
   
   
  