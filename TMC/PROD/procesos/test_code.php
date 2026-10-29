<?php
include("config.php");

function getNewIDContrato()
{
	$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	for($i=0; $i<10; $i++){
		$var = $var.$str[mt_rand(0,34)];
	}
	return $var;
}


echo getNewIDContrato();


?>