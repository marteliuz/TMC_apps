<?php
header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
header("Content-Disposition: filename=Reporte.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo utf8_decode($_POST['datos_a_enviar']);
?>