<?php

		// date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'PHPExcel/PHPExcel.php';
		
		include("lib_functions.php");

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("TouchMedia") //Autor
							 ->setLastModifiedBy("TouchMedia") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel")
							 ->setSubject("Reporte Excel")
							 ->setDescription("Reporte de CDR Processor")
							 ->setKeywords("reporte CDR Processor")
							 ->setCategory("Reporte excel");

		// PAGINA 1
		// PARAMETROS DEL REPORTE
		
		
		$tituloReporte = "REPORTE DE USO VIDEOCONFERENCIA";
	
		//########### COMBINAR Y CENTRAR ##############
		// $objPHPExcel->setActiveSheetIndex(0)
        		    // ->mergeCells('A6:D6');
		//########################################
		

		
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A6:D6');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A8:B8');
		
		//$objPHPExcel->getActiveSheet()
		//->getColumnDimension('A')
		//->setAutoSize(true);
		
		//$objPHPExcel->getActiveSheet()
		//->getColumnDimension('B')
		//->setAutoSize(true);++6
		
		//########### ADD A IMAGE ################
		$objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('../resources/tmc_logo.png');

        $objDrawing->setCoordinates('A1');
        $objDrawing->setHeight(10);
        $objDrawing->setWidth(150);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());		
		//########################################
		
		
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A6',$tituloReporte)
        		    ->setCellValue('A8',  "Parámetros del Reporte")
					
					->setCellValue('A9',  "Generado el:")
					->setCellValue('B9',  date("F j, Y, g:i a"))
					
					->setCellValue('A10',  "Nombre del archivo")
					->setCellValue('B10',  getFileName())
					
					->setCellValue('A11',  "Tamaño del archivo")
					->setCellValue('B11',  getFileSize())
					
		            ->setCellValue('A12',  "Total de Registros")
					->setCellValue('B12',  getCountItemsFile())
					
        		    ->setCellValue('A13',  "Total de Intentos Fallidos")
					->setCellValue('B13',  getCountFailedAttempr())
					
					->setCellValue('A14',  "total de llamadas concretadas")
					->setCellValue('B14',  (getCountAllItems() - getCountFailedAttempr()))
					
					->setCellValue('A15',  "Primer Registro")
					->setCellValue('B15',  getDateFirstRecord())
					
            		->setCellValue('A16',  "Ultimo Registro")
					->setCellValue('B16',  getDateLastRecord());
		
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Parametros');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		// $objPHPExcel->setActiveSheetIndex(0);
		
		
		
		// PAGINA 2
		// INCOMING - DETALLE DE LLAMADOS POR DIA
		$objPHPExcel->createSheet(NULL, 1);
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setTitle("INC_por_dia");



		// PAGINA 3
		// INCOMING - GRAFICO DE LLAMADOS POR DIA
		$objPHPExcel->createSheet(NULL, 2);
		$objPHPExcel->setActiveSheetIndex(2);
		$objPHPExcel->getActiveSheet()->setTitle("INC_por_dia_chart");		


        // PAGINA 4
		// INCOMING - GRAFICO DE LLAMADOS POR DIA
		$objPHPExcel->createSheet(NULL, 3);
		$objPHPExcel->setActiveSheetIndex(3);
		$objPHPExcel->getActiveSheet()->setTitle("INC_test");		

		$objPHPExcel->setActiveSheetIndex(3)
					->setCellValue('A1',"qoeprueba")
        		    ->setCellValue('A2',"Nombre de sitio")
					
					->setCellValue('B2',  "Sumatoria packetlost rx")
					->setCellValue('C2',  "Promedio packet lost rx")
					
					->setCellValue('D2',  "Sumatoria packet lost tx")
					->setCellValue('E2',  "Promedio packet lost tx");
					
					

        $qry = "SELECT name, SUM(avg_packets_lost_rx), AVG(avg_percent_packeT_loss_rx), SUM(avg_packets_lost_tx),AVG(avg_percent_packet_loss_tx) FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY NAME;";
		$result = mysql_query ($qry, $conexion);
         
        $y=3;

		while($Reg = mysql_fetch_array($result))
		{

			$objPHPExcel->setActiveSheetIndex(3)
			            ->setCellValue('A'.$y,$Reg['name'])
			            ->setCellValue('B'.$y,$Reg['SUM(avg_packets_lost_rx)'])
			            ->setCellValue('C'.$y,$Reg['AVG(avg_percent_packeT_loss_rx)'])
			            ->setCellValue('D'.$y,$Reg['SUM(avg_packets_lost_tx)'])
			            ->setCellValue('E'.$y,$Reg['AVG(avg_percent_packet_loss_tx)']);

			$y=$y+1;
			//echo "<tr><td>".$Reg['name']."</td><td align='center'>".$Reg['SUM(avg_packets_lost_rx)']."</td><td align='center'>".$Reg['AVG(avg_percent_packeT_loss_rx)']."</td><td align='center'>".$Reg['SUM(avg_packets_lost_tx)']."</td><td align='center'>".$Reg['AVG(avg_percent_packet_loss_tx)']."</td></tr>";
		}


	//########### SEND HEADERS ################	
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="New_Reporte.xls"');
	header('Cache-Control: max-age=0');

	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
	$objWriter->save('php://output');
	exit;
?>