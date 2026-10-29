<?php
//@date:    : 2014/08/23
//@autor:   : Marteliuz
//@Modified : Paulo Ossandon
//@Date     : 2014/11/29
//start session
?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<!-- Metadata -->
		<meta charset="utf-8"> 
		<title>Ingresar Logo</title>
		<link href='../resources/tmc.ico' rel='shortcut icon' type='image/x-icon'>
		<!-- CSS -->
		<!--Called css metro-boostrap-->
        <link rel="stylesheet" href="../css/metro-bootstrap.css">
        <!--Called css boostrap.min-->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
		<link href="../css/iconFont.css" rel="stylesheet">
		<link href="../css/main.css" rel="stylesheet">
		<style>
			#table {
				width: 500px;
			}
		</style>		
		<!-- Alertify -->
		<link href="../css/alertify/alertify.core.css" rel="stylesheet">
		<link href="../css/alertify/alertify.default.css" rel="stylesheet">
		<script src="../js/alertify/alertify.min.js"></script>
		<!-- JS -->
        <script src="../js/jquery/jquery.min.js"></script>
        <script src="../js/jquery/jquery.widget.min.js"></script>
        <script src="../js/metro/metro.min.js"></script>
        <!--Called library lib_ajax.js-->
		<script src="../js/lib_ajax.js"></script>
    </head>
    <body class="metro">
		<br><br><br><br>
		<br><br>
		<div id="container" align="center" class="jumbotron">
			<table style="background-color:transparent">
				<tr> 
					<td width=500>
						<input type="file" name="archivo" id="archivo" data-transform="input-control">
					</td>
				</tr>
				<tr>
					<td>
						<div class="input-control checkbox">
						  <label>
						   <input type="checkbox" id="checktrue" onclick="javascript:goBack();" />
						   <span class="check"></span>
						   No tengo logo
						  </label>
						</div>	
					</td>
				</tr>
				<tr>
					<td align="right">                            
						<!--<input class="btn btn-success" value="Aceptar" onclick="javascript:uploadImg();"/>-->
						 <button class="success" class="form-control" onclick="javascript:uploadImg();" value="Aceptar"><i class="icon-floppy on-left"></i>Guardar</button>
					</td>
				</tr>
			</table>
		</div>
		<!--<div id="response">Aqui va la respuesta</div>-->
    </body>
</html>