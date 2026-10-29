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
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();
$sheet->getPageMargins()->setTop(0.6);
$sheet->getPageMargins()->setBottom(0.6);
$sheet->getPageMargins()->setHeader(0.4);
$sheet->getPageMargins()->setFooter(0.4);
$sheet->getPageMargins()->setLeft(0.4);
$sheet->getPageMargins()->setRight(0.4);
$objPHPExcel->getProperties()->setTitle("Exemplo");
$objPHPExcel->getProperties()->setCreator("Exemplo");
$objPHPExcel->getProperties()->setLastModifiedBy("Exemplo");
$objPHPExcel->getProperties()->setCompany("Exemplo");

// definir rótulos das colunas
$data = array(utf8_encode('Janeiro'), utf8_encode('Fevereiro'), utf8_encode('Março'), utf8_encode('Abril'), utf8_encode('Maio'), utf8_encode('Junho'), utf8_encode('Julho'), utf8_encode('Agosto'), utf8_encode('Setembro'), utf8_encode('Outubro'), utf8_encode('Novembro'), utf8_encode('Dezembro'));
$row = 1;
foreach($data as $point) {
	$sheet->setCellValueByColumnAndRow(0, $row++, $point);
}

// definir valores das colunas
$data = array(12.5, 56.1, 51, 89, 45, 42, 22.7, 15, 8, 2, 0.9, 10);
$row = 1;
foreach($data as $point) {
	$sheet->setCellValueByColumnAndRow(1, $row++, $point);
}

// definir origem dos valores
$values = new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$1:$B$12');

// definir origem dos rótulos das colunas
$categories = new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$1:$A$12');

// definir dados a mostrar no gráfico
$series = new PHPExcel_Chart_DataSeries(
PHPExcel_Chart_DataSeries::TYPE_BARCHART, // tipo de gráfico
PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,
array(0),
array(),
array($categories), // rótulos das colunas
array($values) // valores
);
$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

// inicializar o layout do gráfico e área do gráfico
$layout = new PHPExcel_Chart_Layout();
$plotarea = new PHPExcel_Chart_PlotArea($layout, array($series));

// inicializar o gráfico
$chart = new PHPExcel_Chart('exemplo', null, null, $plotarea);

// definir título do gráfico
$title = new PHPExcel_Chart_Title(null, $layout);
$title->setCaption(utf8_encode('Gráfico PHPExcel Chart Class'));

// definir posição do gráfico e título
$chart->setTopLeftPosition('D1');
$chart->setBottomRightPosition('K15');
$chart->setTitle($title);

// adicionar o gráfico à folha
$sheet->addChart($chart);

// indicação da criação do ficheiro
$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

// incluir o gráfico no ficheiro que vamos gerar
$writer->setIncludeCharts(TRUE);

// Encaminhar o ficheiro resultante para abrir no browser ou fazer download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="grafico_phpexcel_chart_class.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
og_warning('Error capturado '.$e);

?>