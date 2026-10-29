<?php
require('config.php');
require("lib_functions.php");

$id_region = $_POST['id_region'];
$cmb_id    = $_POST['cmbid'];

$cmb = getCmbComunasByCmbRegiones($id_region, $cmb_id);

return $cmb;
?>