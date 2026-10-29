<?php
include("config.php");

$myusername = $_POST['username']; 
$mypassword = $_POST['password'];
$myusername = trim($myusername);
$mypassword = trim($mypassword);

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$qry      = "SELECT * FROM dbtmedia.tbusuarios WHERE username = '$myusername' AND password = '$mypassword' AND tipo = 2 AND estatus ='1'";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows==1)
{
	//To Do
	session_start();
	$_SESSION['UserType'] = "Cliente";
	$_SESSION['Usuario']  = $myusername;
	echo "OK";
}else{
	echo "NO";
}
?>