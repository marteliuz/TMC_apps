<?php
include("config.php");
session_start();

mysql_close($conexion);
session_destroy();
header("location:../index.php");
?>