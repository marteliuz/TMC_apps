<?php

@session_start();

include ("libreria.php");

$id        = $_POST['id'];
$precio	   = $_POST['precio'];
$cantidad  = $_POST['cantidad'];
$margen    = $_POST['margen'];


echo $id.$precio.$cantidad.$margen;






?>