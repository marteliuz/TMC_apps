<?php

//@date        : 2014/08/23
//@autor       : Marteliuz
//@Modified by : Paulo Ossandon
//@Date        : 2014/11/29

//include file config.php for connection bd
include("../cnfg/config.php");
//include library file lib_log.php for create log
include("lib_log.php");

//Control excepcion
try{
	//Extrac value and save in variable php
	$myusername = $_POST['username']; 
	$mypassword = $_POST['password'];
	$myusername = trim($myusername);
	$mypassword = trim($mypassword);
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	//Exec query sql and save value in variable php		
	$qry 		= "SELECT * FROM dbpolycom.tbusers WHERE username='$myusername' and password='$mypassword' and activo ='1'";
	$result 	= mysql_query($qry);
	$Reg   	 	= mysql_fetch_array($result);
	$count  	= mysql_num_rows($result);
	if($count==1){
		session_start();
		$_SESSION['username'] = $myusername;
		echo "YES";
	}else{
		echo "NO";
	}
}catch(Exception $e){
	echo "Exception :".$e->getMessage();
}
?>