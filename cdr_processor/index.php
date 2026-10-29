<?php

//@date        : 2014/08/23
//@autor       : Marteliuz
//@Modified by : Paulo Ossandon
//@Date        : 2014/11/29

//Start session
session_start();

if($_SESSION['username']=="")
{ 
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html>
    <head>
		<meta charset="utf-8"> 
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>CDR Processing...</title>
		<!--Called logo img ico-->
		<link href='resources/tmc.ico' rel='shortcut icon' type='image/x-icon'>
		<!--Called css metro-boostrap-->
        <link rel="stylesheet" href="css/metro-bootstrap.css">
        <!--Called ccs boostrap-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!--Called css-->
		<link href="css/main.css" rel="stylesheet">
		<link href="css/alertify/alertify.core.css" rel="stylesheet">
		<link href="css/alertify/alertify.default.css" rel="stylesheet">
		<!--Called js-->
		<script src="js/alertify/alertify.min.js"></script>
        <script src="js/jquery/jquery.min.js"></script>
        <script src="js/jquery/jquery.widget.min.js"></script>
        <!--Called js metro-boostrap-->
        <script src="js/metro/metro.min.js"></script>
        <!--Called library lib_ajax.js-->
		<script src="js/lib_ajax.js"></script>
		<!--Called function js-->
		<script language="javascript">
		$( document ).ready(function() {
			document.getElementById("username").focus();
		});
		$(document).keypress(function(e) {
			if(e.which == 13) {
				checklogin();
			}
		});
		</script>
    </head>
    <body class="metro">

		<br><br>
		
		<div id="header">
			<table style="background-color:transparent;">
				<tr>
					<td><img src="resources/tm2.png" alt="tm" height="50" width="50" /></td>
					<td width="10"> </td>
					<td><p class="header"><font color="#FFFFFF"> Procesamiento CDR</font></p></td>
					<td width="10"> </td>
					<td><h2><font color="#FFFFFF">Touch Media</font></h2></td>
				</tr>
		</table>
		</div>

		<br><br>

			<div id="container" align="center" class="jumbotron">
				
				<tr> 
				<div class="col-xs-4">
					<td width=300>
						<!--<input type="text"  id="username" placeholder="username" class="form-control"/>-->
						<div class="input-control text">
						<input type="text" value="" placeholder="Username" id="username"/>
						<button class="btn-clear"></button>
					 </div>
					</td>
				</div>
				</tr>
				<tr> 
				  <div class="col-xs-4">	
					<td>
						<!--<input type="password" id="password" placeholder="password" class="form-control"/>-->
						<div class="input-control text"><input type="text" value="" placeholder="Password" id="password"/>
						<button class="btn-clear"></button>
					    </div>
					</td>
				</div>	
				</tr>
				<div class="form-group">
					<td align="center">
						<!--Called function ckecklogin.php-->
						<!--<input class="btn btn-success" value="Iniciar Sesi&oacute;n" onclick="javascript:checklogin();"/>-->
						<button class="success" onclick="javascript:checklogin();" class="form-control"></i>Iniciar Session</button>
					</td>
				</tr>
			    </div>
		    </div>
        <br><br><br><br><br><br>
	
	<div id="response"></div>
    </body>
</html>
<?php
}else{
	header("location:../cdr_processor/procedures/selectafile.php");
}
?>