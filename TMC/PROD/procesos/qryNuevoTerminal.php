<?php
include("config.php");
session_start();
$modelo         = $_POST['modelo'];
$nserie         = $_POST['nserie'];
$nserie_camara  = $_POST['nserie_camara'];
$nserie_mic     = $_POST['nserie_mic'];
$nserie_cremoto = $_POST['nserie_cremoto'];
$ubicacion      = $_POST['ubicacion'];

$qry = "SELECT * FROM dbtmedia.tbterminales WHERE nserie = '$nserie'";
$result   = mysql_query($qry);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
	$qry = "INSERT INTO dbtmedia.tbterminales (modelo, nserie, nserie_camara, nserie_mic, nserie_cremoto, ubicacion) VALUES ('$modelo', '$nserie', '$nserie_camara', '$nserie_mic', '$nserie_cremoto', '$ubicacion')";
	mysql_query($qry);
	$id_terminal = mysql_insert_id();
	$var = mysql_affected_rows();
	if ($var==1)
	{
		echo "OK|".$id_terminal;
	}else{
		echo "NO|";
	}
}else{
	echo "ERROR NSERIE|";
}
?>