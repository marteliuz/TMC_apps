<?php
session_start();
//require file config.php for connection bd
require('../cnfg/config.php');
//include library lib_functions.php for extrac values
include("lib_functions.php");
//include library lib_log.php for create log
include("lib_log.php");
// create_log();
/** Se agrega la libreria PHPExcel */
require_once 'PHPExcel/PHPExcel.php';


// obter acesso à classe PHPExcel

// inicialização da classe PHPExcel e definições básicas da folha
$objPHPExcel = new PHPExcel();

//Crear instancia de archivo excel
$ea = new \PHPExcel(); // ea is short for Excel Application

//Referencia a hoja de calculo
$ews = $ea->getSheet(0);
$ews->setTitle('Data');

//Aplica nombre a una celda
$ews->setCellValue('a1', 'ID'); // Sets cell 'a1' to value 'ID 
$ews->setCellValue('b1', 'Season');

//Aplicar nombre a datos estructurados provenientes de una sentencia SQL 
//$data="";
//$ews->fromArray($data, ' ', 'A2');

/*The fromArray method takes 3 parameters: 
1. the data source, in array form; 
2. a “filler” value in case the data is NULL; 
3. a cell reference to start the filling (from left to right, then up to down).
NOTE: When we use PDO to fetch the data, a simple $res = $q->fetchAll(\PDO::FETCH_ASSOC); call will force the returned result data set to contain an
associated array only, without index. If fetchall is called without the option PDO::FETCH_ASSOC, the result set will actually contain two sets of
identical data, one in associated array form, one in indexed form and will create duplicates in the Excel file when using fromArray.
We may also want to style the header row (ID, Season, etc). To do that, we also have two ways:*/

$header = 'a1:h1';
$ews->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
$style = array(
    'font' => array('bold' => true,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
    );
$ews->getStyle($header)->applyFromArray($style);

/*One way is to use some get methods to retrieve the style object that we want to change and change it. We do this for the “background fill” style.
The other is to declare a “style” array and specify the styles we want to change and what to change them to. Then, we use applyFromArray to apply the styles in a batch. 
Here we changed the font and the alignment.Both methods support range as their parameter ($header='a1:h1';), which is very convenient.
Finally, we may want to adjust the column width so they will fit the max displayed length in each column:*/

for ($col = ord('a'); $col <= ord('h'); $col++)
{
    $ews->getColumnDimension(chr($col))->setAutoSize(true);
}

?>