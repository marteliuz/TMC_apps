<?php
//@date:    : 2014/08/23
//@autor:   : Marteliuz
//@Modified : Paulo Ossandon
//@Date     : 2014/12/04
session_start();

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

        /** Se agrega la libreria PHPExcel */
        require_once 'PHPExcel/PHPExcel.php';

        //Include lib_function.php for extrac values        
        include("lib_functions.php");
         
        //Se crea el objeto PHPExcel
        $objPHPExcel = new PHPExcel();

        //Exec query sql and save in variable php - TITLE CLIENT
        $nombrecliente = getNameTtitleClient();
  
        //Obtiene ultimo registro tabla tbfile
        $idtbclient = getLastRecordIdClient();

        $qry = "SELECT path_logo from dbpolycom.tbclientes WHERE idtbcliente = '$idtbclient'";

        $result = mysql_query ($qry, $conexion);

        $Reg = mysql_fetch_assoc($result);
        $Reg0 = mysql_fetch_assoc($result);
        
        //Logo existence of valid - 'No tengo logo'
        if ($Reg['path_logo'] == $Reg0['path_logo'])
        {

		//Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("TouchMedia") //Autor
							 ->setLastModifiedBy("TouchMedia") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel")
							 ->setSubject("Reporte Excel")
							 ->setDescription("Reporte de CDR Processor")
							 ->setKeywords("reporte CDR Processor")
							 ->setCategory("Reporte excel");

		// PAGINA 1
		// REPORTE DE USO VIDEOCONFERENCIA
		// PARAMETROS DEL REPORTE
        $tituloReporte = "REPORTE DE USO VIDEOCONFERENCIA";

        //Aply colors a cell pagina 1
        function cellColor($cells,$color){
              	 global $objPHPExcel;
                 $objPHPExcel->getActiveSheet(0)->getStyle($cells)->getFill()
                 ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'startcolor' => array('rgb' => $color)
                  ));
            }
            cellColor('A6:B6','C0C0C0');
            cellColor('A8:B8','C0C0C0');
            cellColor('A15:B15','C0C0C0');
            cellColor('C15','C0C0C0');
            cellColor('A16:B16','C0C0C0');
            cellColor('C16','C0C0C0');

		//########### AJUSTAR COLUMNA ##############
		$objPHPExcel->getActiveSheet()
        ->getColumnDimension('A')
        ->setWidth(27);
		
		$objPHPExcel->getActiveSheet()
        ->getColumnDimension('B')
        ->setWidth(18);
        
        //Size Font
        $objPHPExcel->getActiveSheet(0)->getStyle("A6:A6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A8:A8")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A9:A9")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A10:A10")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A11:A11")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A12:A12")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A13:A13")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A15:C15")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A16:B16")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("C16:B9")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A17:B17")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("C17:B10")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A18:B18")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("C18:B11")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("B12:B13")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A7:B7")->getFont()->setSize(8);

		//Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A6:B6');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A8:B8');

		//########### ADD A IMAGE TOUCH MEDIA################
		$objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('../resources/tmc_logo.png');
        $objDrawing->setCoordinates('A1');
        $objDrawing->setHeight(10);
        $objDrawing->setWidth(150);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());		
		//########################################

		//Center title report of use video conference
		$objPHPExcel->getActiveSheet(0)->mergeCells('A6:A6');
        $objPHPExcel->getActiveSheet(0)->getStyle('A6:A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        /** Borders for heading -  title report of use video conference */
        $objPHPExcel->getActiveSheet()->getStyle('A6:B6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //Bold
        $objPHPExcel->getActiveSheet()->getStyle('A6:A6')->getFont()->setBold(true);

		//Center title parameter of report
		$objPHPExcel->getActiveSheet(0)->mergeCells('A8:A8');
        $objPHPExcel->getActiveSheet(0)->getStyle('A8:A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        /** Borders for heading -  title parameter of report */
        $objPHPExcel->getActiveSheet()->getStyle('A8:B8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //Bold
        $objPHPExcel->getActiveSheet()->getStyle('A8:A8')->getFont()->setBold(true);

        //Center title total registers
		$objPHPExcel->getActiveSheet(0)->mergeCells('A8:A8');
        $objPHPExcel->getActiveSheet(0)->getStyle('A8:A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        /** Borders for heading -  total registers */
        $objPHPExcel->getActiveSheet()->getStyle('A9:B9')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        /** Borders for heading -  title total failed  attempts */
        $objPHPExcel->getActiveSheet()->getStyle('A10:B10')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        /** Borders for heading -  title total calls concretized */
        $objPHPExcel->getActiveSheet()->getStyle('A11:B11')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        /** Borders for heading -  title first records*/
        $objPHPExcel->getActiveSheet()->getStyle('A12:B12')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        /** Borders for heading -  title second records */
        $objPHPExcel->getActiveSheet()->getStyle('A13:B13')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //Thousands separator 
        $objPHPExcel->getActiveSheet(0)->getStyle('B9')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
        $objPHPExcel->getActiveSheet(0)->getStyle('B11')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
        $objPHPExcel->getActiveSheet(0)->getStyle('B12')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;$#,##0');
        $objPHPExcel->getActiveSheet(0)->getStyle('B17')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
        $objPHPExcel->getActiveSheet(0)->getStyle('B18')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A6',$tituloReporte.' '.$nombrecliente)
        		    ->setCellValue('A8','Parametros del reporte')
					
		            ->setCellValue('A9',  "Total de Registros")
					->setCellValue('B9',  getCountItemsFile())
					
        		    ->setCellValue('A10',  "Total de Intentos Fallidos")
					->setCellValue('B10',  getCountFailedAttempr())
					
					->setCellValue('A11',  "total de llamadas concretadas")
					->setCellValue('B11',  (getCountAllItems() - getCountFailedAttempr()))
					
					->setCellValue('A12',  "Primer Registro")
					->setCellValue('B12',  getDateFirstRecord())

            		->setCellValue('A13',  "Ultimo Registro")
					->setCellValue('B13',  getDateLastRecord())

                    ->setCellValue('A7',  "Fecha y Hora Actual")
                    ->setCellValue('B7',  getDateActual())

					//Title Total calls
                    ->mergeCells('A15:C15')
					->setCellValue('A15','Total de llamadas')
                    //Sub-title calls
					->setCellValue('A16','Direccion')
		            //Sub-title calls
		            ->setCellValue('B16','Cantidad')
		            //Sub-title calls
		            ->setCellValue('C16','Tiempo')

		            ->setCellValue('A17','Entrantes')
		            ->setCellValue('A18','Salientes');

                    //Align a right
                    $objPHPExcel->getActiveSheet(0)->getStyle('B12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    $objPHPExcel->getActiveSheet(0)->getStyle('B13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    
                    //Align a right
                    $objPHPExcel->getActiveSheet(0)->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		            // Se asigna el nombre a la hoja
		            $objPHPExcel->getActiveSheet()->setTitle('Reporte');

		            //Center title total of call 
		            $objPHPExcel->getActiveSheet(0)->mergeCells('A15:B15');
                    $objPHPExcel->getActiveSheet(0)->getStyle('A15:B15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                       
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A15:A15')->getFont()->setBold(true);

                    /** Borders for heading -  title total of call */
                     $objPHPExcel->getActiveSheet()->getStyle('A15:C15')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    
                    //Center sub-title total of call address 
		            $objPHPExcel->getActiveSheet(0)->mergeCells('A16:A16');
                    $objPHPExcel->getActiveSheet(0)->getStyle('A16:A16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A16:A16')->getFont()->setBold(true);

                    /** Borders for heading -  sub-title total of call addrress */
                    $objPHPExcel->getActiveSheet()->getStyle('A16:A16')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    //Center sub-title total of call quantity
		            $objPHPExcel->getActiveSheet(0)->mergeCells('B16:B16');
                    $objPHPExcel->getActiveSheet(0)->getStyle('B16:B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B16:B16')->getFont()->setBold(true);

                    /** Borders for heading -  sub-title total of call quantity */
                    $objPHPExcel->getActiveSheet()->getStyle('B16:B16')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                     //Center sub-title total of call time
		            $objPHPExcel->getActiveSheet(0)->mergeCells('C16:C16');
                    $objPHPExcel->getActiveSheet(0)->getStyle('C16:C16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C16:C16')->getFont()->setBold(true);

                    /** Borders for heading -  title parameter of report */
                    $objPHPExcel->getActiveSheet()->getStyle('C16:C16')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    /** Borders for heading -  title call address incoming */
                    $objPHPExcel->getActiveSheet()->getStyle('A17:A17')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    /** Borders for heading -  title quantity incoming */
                    $objPHPExcel->getActiveSheet()->getStyle('B17:B17')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);    

                    /** Borders for heading -  title time incoming */
                    $objPHPExcel->getActiveSheet()->getStyle('C17:C17')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    /** Borders for heading -  title call address outgoing */
                    $objPHPExcel->getActiveSheet()->getStyle('A18:A18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    /** Borders for heading -  title quantity outgoing */
                    $objPHPExcel->getActiveSheet()->getStyle('B18:B18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);    

                    /** Borders for heading -  title time outgoing */
                    $objPHPExcel->getActiveSheet()->getStyle('C18:C18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   
                    
                    /** Borders for heading -  title time outgoing */
                    $objPHPExcel->getActiveSheet()->getStyle('A7:B7')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //Exec query sql and save in variable php
		$qry = "SELECT call_direction, COUNT(call_direction) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata GROUP BY call_direction;";

		$result = mysql_query ($qry, $conexion);

		$y=17;

		while($Reg = mysql_fetch_array($result))

		{

			$objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A'.$y,$Reg['call_direction'])
			            ->setCellValue('B'.$y,$Reg['cantidad'])
			            ->setCellValue('C'.$y,$Reg['tiempo']);

                        $objPHPExcel->getActiveSheet(0)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $y=$y+1;

		}

            // create sheet for pie charts
            $objWorksheet = $objPHPExcel->getActiveSheet();

            // grafico pie - cantidad por direccion

            // Set the Labels for each data series we want to plot
            $dataSeriesLabels1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'Reporte!$B$16', NULL, 1),         // direccion
            );
            // Set the X-Axis Labels
            $xAxisTickValues1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'Reporte!$A$17:$A$18', NULL, 4),    // values Incoming - Outcoming
            );
            // Set the Data values for each data series we want to plot
            $dataSeriesValues1 = array(new PHPExcel_Chart_DataSeriesValues('Number', 'Reporte!$B$17:$B$18', NULL, 4),); // values cantidad
            //  Build the dataseries
            $series1 = new PHPExcel_Chart_DataSeries(
            PHPExcel_Chart_DataSeries::TYPE_PIECHART,               // plotType
            NULL,                                                   // plotGrouping
            range(0, count($dataSeriesValues1)-1),                  // plotOrder
            $dataSeriesLabels1,                                     // plotLabel
            $xAxisTickValues1,                                      // plotCategory
            $dataSeriesValues1                                      // plotValues
            );
            // Set up a layout object for the Pie chart
            $layout1 = new PHPExcel_Chart_Layout();
            $layout1->setShowVal(TRUE);
            $layout1->setShowPercent(TRUE);
            // Set the series in the plot area
            $plotArea1 = new PHPExcel_Chart_PlotArea($layout1, array($series1));
            // Set the chart legend
            $legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
            $title1 = new PHPExcel_Chart_Title('Cantidad por Direccion'); 
            // Create the chart
            $chart1 = new PHPExcel_Chart(
            'chart1',       // name
            $title1,        // title
            $legend1,       // legend
            $plotArea1,     // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel       - Pie charts don't have a Y-Axis
            );
            // Set the position where the chart should appear in the worksheet
            $chart1->setTopLeftPosition('A20');
            $chart1->setBottomRightPosition('E30');
            // Add the chart to the worksheet
            $objWorksheet->addChart($chart1);
			
		// PAGINA 2
		// DETALLE DE LLAMADAS ENTRANTES POR DIA - Llamadas por dia
		$objPHPExcel->createSheet(NULL, 1);
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setTitle("INC_por_dia");

        //Ajust column
		$objPHPExcel->getActiveSheet(1)
        ->getColumnDimension('A')
        ->setWidth(12);
        $objPHPExcel->getActiveSheet(1)
        ->getColumnDimension('C')
        ->setWidth(10);
        
        //Size font
        $objPHPExcel->getActiveSheet(0)->getStyle("A2:D2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("C5")->getFont()->setSize(8);

		$objPHPExcel->setActiveSheetIndex(1)
		            //->mergeCells('A2:D2')
        		    ->setCellValue('A2','DETALLE DE LlAMADAS ENTRANTES POR DIA')
					//->mergeCells('A4:C4')
		            ->setCellValue('A4','Llamadas por dia')
					->mergeCells('A5:A5')
        		    ->setCellValue('A5','Fecha')
                    //->mergeCells('B5:B5')
					->setCellValue('B5','Cantidad')
                    //->mergeCells('C5:C5')
					->setCellValue('C5','Tiempo');

		//Center title details entry for day
		$objPHPExcel->getActiveSheet(1)->mergeCells('A2:D2');
        $objPHPExcel->getActiveSheet(1)->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('A2:B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        //Bold
        $objPHPExcel->getActiveSheet()->getStyle('A2:D2')->getFont()->setBold(true);

        /** Borders for heading -  title details entry for day */
        $objPHPExcel->getActiveSheet()->getStyle('A2:D2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //Center title calls for day
		$objPHPExcel->getActiveSheet(1)->mergeCells('A4:C4');
        $objPHPExcel->getActiveSheet(1)->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('A4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        //Bold
        $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);

        /** Borders for heading -  title total of call */
        $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //Center title date
		$objPHPExcel->getActiveSheet(1)->mergeCells('A5:A5');
        $objPHPExcel->getActiveSheet(1)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('A5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        //Bold
        $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);

        /** Borders for heading -  date */
        $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        
        //Center title quantity
		$objPHPExcel->getActiveSheet(1)->mergeCells('B5:B5');
        $objPHPExcel->getActiveSheet(1)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        //Bold
        $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);

        /** Borders for heading -  quantity */
        $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //Center title time
		$objPHPExcel->getActiveSheet(1)->mergeCells('C5:C5');
        $objPHPExcel->getActiveSheet(1)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        //Bold
        $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);

        /** Borders for heading -  time */
        $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

	    
        //Exec query sql and save in variable php - calls entry for day
	    $qry = "SELECT start_date AS fecha, COUNT(start_date) AS cantidad_llamadas, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) AS tiempo_total FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' GROUP BY start_date ORDER BY start_date ASC;";
		
		$result = mysql_query ($qry, $conexion);

		$y=6;
		
		while($Reg = mysql_fetch_array($result))
			
			{

				$objPHPExcel->setActiveSheetIndex(1)
			            ->setCellValue('A'.$y,$Reg['fecha'])
			            ->setCellValue('B'.$y,$Reg['cantidad_llamadas'])
			            ->setCellValue('C'.$y,$Reg['tiempo_total']);

			    $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			    $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			    $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			    $objPHPExcel->getActiveSheet(1)->getStyle('A'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			    $objPHPExcel->getActiveSheet(1)->getStyle('B'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			    $objPHPExcel->getActiveSheet(1)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $objPHPExcel->getActiveSheet(1)->getStyle('A'.$y)->getFont()->setSize(8);
                $objPHPExcel->getActiveSheet(1)->getStyle('B'.$y)->getFont()->setSize(8);
                $objPHPExcel->getActiveSheet(1)->getStyle('C'.$y)->getFont()->setSize(8);

                $objPHPExcel->getActiveSheet(1)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
			
			$y=$y+1;
			
			
			}

        // PAGINA 3
        // GRAFICO CANTIDAD LLAMADAS ENTRANTES POR DIA
        $objPHPExcel->createSheet(NULL, 2);
        $objPHPExcel->setActiveSheetIndex(2);
        $objPHPExcel->getActiveSheet()->setTitle("INC_por_dia_chart");

        // char bar - cantidad llamadas entrantes por dia

        // create sheet for pie charts 
        $objWorksheet = $objPHPExcel->getActiveSheet(2);

        //  Set the Labels for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker

        $dataSeriesLabels2 = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'INC_por_dia!$B$5', NULL, 1), // quantity
        );

        //  Set the X-Axis Labels
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $xAxisTickValues = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'INC_por_dia!$A$6:$A$'.$y, NULL, 12), // date
        );

        //  Set the Data values for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $dataSeriesValues1 = array(
        new PHPExcel_Chart_DataSeriesValues('Number', 'INC_por_dia!$B$6:$B$'.$y, NULL, 12), // values quantity
        );

        //  Build the dataseries
        $series1 = new PHPExcel_Chart_DataSeries(
           PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
           PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  // plotGrouping
           range(0, count($dataSeriesValues1)-1),          // plotOrder
           $dataSeriesLabels1,                             // plotLabel
           $xAxisTickValues,                               // plotCategory
           $dataSeriesValues1                              // plotValues
           );

        //  Set additional dataseries parameters
        //  Make it a vertical column rather than a horizontal bar graph
        $series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

        //  Set the series in the plot area
        $plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series1));
        //  Set the chart legend
        $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
        $title = new PHPExcel_Chart_Title('Cantidad de llamadas entrantes por dia');

        //  Create the chart
        $chart = new PHPExcel_Chart(
           'chart1',       // name
            $title,         // title
            $legend,        // legend
            $plotArea,      // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel
            );

        //  Set the position where the chart should appear in the worksheet
        $chart->setTopLeftPosition('A1', 24, 24);
        $chart->setBottomRightPosition('M33', -24);

        $objPHPExcel->getActiveSheet(2)->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        //  Add the chart to the worksheet
        $objWorksheet->addChart($chart);

		// PAGINA 4
		// DETALLE LLAMADAS ENTRANTES POR TIPO DE TERMINAL - Total de llamadas y duración por Tipo de Sitio								
		$objPHPExcel->createSheet(NULL, 3);
		$objPHPExcel->setActiveSheetIndex(3);
		$objPHPExcel->getActiveSheet()->setTitle("INC_por_tipo");
       
        // ajustar columna
		$objPHPExcel->getActiveSheet(3)
        ->getColumnDimension('A')
        ->setWidth(30);
         
        // size font
        $objPHPExcel->getActiveSheet(3)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("C5:C5")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(3)
		            // title
		            ->mergeCells('A2:C2')
		            ->setCellValue('A2','LlAMADAS ENTRANTES POR TIPO DE TERMINAL')
                    // sub-title
					->mergeCells('A4:C4')
                    ->setCellValue('A4','Total de llamadas y duracion por Tipo de sitio')
                    // title site
                    ->mergeCells('A5:A5')   
        		    ->setCellValue('A5','Tipo Sitio')
                    // title quantity
        		    ->mergeCells('B5:B5')
        		    ->setCellValue('B5','Cantidad')
                    // name time
        		    ->mergeCells('C5:C5')
        		    ->setCellValue('C5','Tiempo');

                    // center title totals entry for tipe of terminal
		            $objPHPExcel->getActiveSheet(3)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(3)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    // center title totals calls and duration for tipe of site
		            $objPHPExcel->getActiveSheet(3)->mergeCells('A4:C4');
                    $objPHPExcel->getActiveSheet(3)->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('A4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    // center title type site
		            $objPHPExcel->getActiveSheet(3)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(3)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    // center title quantity
		            $objPHPExcel->getActiveSheet(3)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(3)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    // center title time
		            $objPHPExcel->getActiveSheet(3)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(3)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

        // exec query sql and save in variable php
        $qry = "SELECT endpoint_type, COUNT(endpoint_type) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY endpoint_type;";
        
        $result = mysql_query ($qry, $conexion);

        $y=6;

        while($Reg = mysql_fetch_array($result))

        {
            $endpoint_type = $Reg['endpoint_type'];
            if($endpoint_type == " "){
                $endpoint_type = "Software";
            }elseif($endpoint_type == "user:terminal"){
                $endpoint_type = "Terminal";
            }
            
            $objPHPExcel->setActiveSheetIndex(3)
                         ->setCellValue('A'.$y,$Reg['endpoint_type'])
                         ->setCellValue('B'.$y,$Reg['cantidad'])
                         ->setCellValue('C'.$y,$Reg['tiempo']);

            $objPHPExcel->getActiveSheet(3)->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet(3)->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet(3)->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet(3)->getStyle('A'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet(3)->getStyle('B'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet(3)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $objPHPExcel->getActiveSheet(3)->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(3)->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(3)->getStyle("C".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet(3)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
            
            $y=$y+1;
        }

          // create sheet for pie charts 
         $objWorksheet = $objPHPExcel->getActiveSheet(3);

        // grafico pie pagina 4 - llamadas entrantes por tipo de terminal

            // set the Labels for each data series we want to plot
            $dataSeriesLabels1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'INC_por_tipo!$A$5', NULL, 1),        // tipo sitio
            );
            // set the X-Axis Labels
            $xAxisTickValues1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'INC_por_tipo!$A$6:$A$8', NULL, 4),    // values tipo de sitio
            );
            // set the Data values for each data series we want to plot
            $dataSeriesValues1 = array(new PHPExcel_Chart_DataSeriesValues('Number', 'INC_por_tipo!$B$6:$B$8', NULL, 4),); // values cantidad
            // build the dataseries
            $series1 = new PHPExcel_Chart_DataSeries(
            PHPExcel_Chart_DataSeries::TYPE_PIECHART,               // plotType
            NULL,                                                   // plotGrouping
            range(0, count($dataSeriesValues1)-1),                  // plotOrder
            $dataSeriesLabels1,                                     // plotLabel
            $xAxisTickValues1,                                      // plotCategory
            $dataSeriesValues1                                      // plotValues
            );
            // set up a layout object for the Pie chart
            $layout1 = new PHPExcel_Chart_Layout();
            $layout1->setShowVal(TRUE);
            $layout1->setShowPercent(TRUE);
            // set the series in the plot area
            $plotArea1 = new PHPExcel_Chart_PlotArea($layout1, array($series1));
            // set the chart legend
            $legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
            $title1 = new PHPExcel_Chart_Title('Cantidad de llamadas por tipo de terminal'); 
            // create the chart
            $chart1 = new PHPExcel_Chart(
            'chart1',       // name
            $title1,        // title
            $legend1,       // legend
            $plotArea1,     // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel       - Pie charts don't have a Y-Axis
            );
            // set the position where the chart should appear in the worksheet
            $chart1->setTopLeftPosition('A10');
            $chart1->setBottomRightPosition('E30');
            // add the chart to the worksheet
            $objWorksheet->addChart($chart1);
             
		// PAGINA 5
		// DETALLE LLAMADAS ENTRANTES POR SITIO - Total de llamadas y duración por Sitio
		$objPHPExcel->createSheet(NULL, 4);
		$objPHPExcel->setActiveSheetIndex(4);
		$objPHPExcel->getActiveSheet()->setTitle("INC_por_sitio");

		 //########### COMBINAR Y CENTRAR ##############
    
        //Ajust column
		$objPHPExcel->getActiveSheet(4)
        ->getColumnDimension('A')
        ->setWidth(34);

        //Size font
        $objPHPExcel->getActiveSheet(3)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("A4:A4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("B4:B4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("C4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("C5:C5")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(4)
		            //Title
		            ->mergeCells('A2:C2')
		            ->setCellValue('A2','LlAMADAS ENTRANTES POR SITIO')
                    //Sub-title
					->mergeCells('A4:A4')
                    ->setCellValue('A4','Total de llamadas y duracion por sitio')
                    //Title vacio
                    ->mergeCells('B4:B4')   
        		    ->setCellValue('B4','')
                    //Title vacio
        		    ->mergeCells('C4:C4')
        		    ->setCellValue('C4','')
                    //Name site 
        		    ->mergeCells('A5:A5')
        		    ->setCellValue('A5','Nombre Sitio')
        		    //Title quantity
        		    ->mergeCells('B5:B5')
        		    ->setCellValue('B5','Cantidad')
        		    //Title time
        		    ->mergeCells('C5:C5')
        		    ->setCellValue('C5','Tiempo');

                    //Center title calls entry for site
		            $objPHPExcel->getActiveSheet(4)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(4)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title total calls and duration for site
		            $objPHPExcel->getActiveSheet(4)->mergeCells('A4:A4');
                    $objPHPExcel->getActiveSheet(4)->getStyle('A4:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('A4:A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:A4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:A4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title vacio
		            $objPHPExcel->getActiveSheet(4)->mergeCells('B4:B4');
                    $objPHPExcel->getActiveSheet(4)->getStyle('B4:B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('B4:B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title vacio
		            $objPHPExcel->getActiveSheet(4)->mergeCells('C4:C4');
                    $objPHPExcel->getActiveSheet(4)->getStyle('C4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('C4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C4:C4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title name site
		            $objPHPExcel->getActiveSheet(4)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(4)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title quantity
		            $objPHPExcel->getActiveSheet(4)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(4)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title time
		            $objPHPExcel->getActiveSheet(4)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(4)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                   
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                   
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                   
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

        //Exec query sql and save in variable php
        $qry = "SELECT name, count(name) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info not like 'Fail%' GROUP BY name ORDER BY cantidad DESC;";
        
        $result = mysql_query ($qry, $conexion);

        $y=6;

        while($Reg = mysql_fetch_array($result))
        
        {   

            $objPHPExcel->setActiveSheetIndex(4)
                         ->setCellValue('A'.$y,$Reg['name'])
                         ->setCellValue('B'.$y,$Reg['cantidad'])
                         ->setCellValue('C'.$y,$Reg['tiempo']);

            $objPHPExcel->getActiveSheet(4)->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet(4)->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet(4)->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
             
            $objPHPExcel->getActiveSheet(4)->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(4)->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(4)->getStyle("C".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet(4)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');

            $objPHPExcel->getActiveSheet(4)->getStyle('A'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet(4)->getStyle('B'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet(4)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $y=$y+1;

        }
        
        // TITULO PAGINA 6
		// PARAMETROS DEL REPORTE	
		$objPHPExcel->createSheet(NULL, 5);
		$objPHPExcel->setActiveSheetIndex(5);
		$objPHPExcel->getActiveSheet()->setTitle("INC_QOE");		

		//########### COMBINAR Y CENTRAR ##############

		//Ajustar columna
        $objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('A')
        ->setWidth(27);
		
		$objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('B')
        ->setWidth(10); 

		$objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('C')
        ->setWidth(10);

        $objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('D')
        ->setWidth(10);

        $objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('E')
        ->setWidth(10);
        
        //Size font
        $objPHPExcel->getActiveSheet(5)->getStyle("A2:E2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A5:A6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("C5:C6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("D5:D6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("E5:E6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B6:B6")->getFont()->setSize(8);

		$objPHPExcel->setActiveSheetIndex(5)
		            //Title
		            ->mergeCells('A2:E2')
		            ->setCellValue('A2','DETALLE DE EXPERIENCIA POR SITIO ENTRANTES')
                    //Sub-title
					->mergeCells('A4:E4')
                    ->setCellValue('A4','QoE - Calidad de la Experiencia')
                    //Name site
                    ->mergeCells('A5:A6')   
        		    ->setCellValue('A5','Nombre de sitio')
					//Title sumatory rx
					->mergeCells('B5:B5')
					->setCellValue('B5','Sumatoria')
                    //Sub-title sumatory rx
                    ->mergeCells('B5:B5')
					->setCellValue('B6','Packet Lost RX')
					//Title Promedio rx
                    ->setCellValue('C5','Promedio %')
                    //Sub-title promedio rx
					->setCellValue('C6','Packet Lost RX')
				    //Title sumatory tx
					->setCellValue('D5','Sumatoria')
					//Sub-title sumatory tx
					->setCellValue('D6','Packet Lost TX')
                    //Title promedio tx
                    ->setCellValue('E5','Promedio %')
                    //Sub-title promedio tx
                    ->setCellValue('E6','Packet Lost TX');

                    //Center title detalle de experienciea por sitio entrantes
		            $objPHPExcel->getActiveSheet(5)->mergeCells('A2:E2');
                    $objPHPExcel->getActiveSheet(5)->getStyle('A2:E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('A2:E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title Quality of the experience
		            $objPHPExcel->getActiveSheet(5)->mergeCells('A4:E4');
                    $objPHPExcel->getActiveSheet(5)->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title site name
		            $objPHPExcel->getActiveSheet(5)->mergeCells('A5:A6');
                    $objPHPExcel->getActiveSheet(5)->getStyle('A5:A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('A5:A6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title sumatory
		            $objPHPExcel->getActiveSheet(5)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(5)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(5)->getStyle('B6:B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('B6:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title packet lost rx
                    $objPHPExcel->getActiveSheet(5)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(5)->getStyle('C6:C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('C6:C6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(5)->getStyle('D5:D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('D5:D5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('D5:D5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('D5:D5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(5)->getStyle('D6:D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('D6:D6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('D6:D6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('D6:D6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(5)->getStyle('E5:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('E5:E5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('E5:E5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('E5:E5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(5)->getStyle('E6:E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('E6:E6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 


		//Exec query sql and save value in variable php			
        $qry = "SELECT name, SUM(avg_packets_lost_rx), AVG(avg_percent_packeT_loss_rx), SUM(avg_packets_lost_tx),AVG(avg_percent_packet_loss_tx) FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY NAME;";
		
        $result = mysql_query ($qry, $conexion);
         
        $y=7;

		while($Reg = mysql_fetch_array($result))
		{

			$objPHPExcel->setActiveSheetIndex(5)
			            ->setCellValue('A'.$y,$Reg['name'])
			            ->setCellValue('B'.$y,$Reg['SUM(avg_packets_lost_rx)'])
			            ->setCellValue('C'.$y,$Reg['AVG(avg_percent_packeT_loss_rx)'])
			            ->setCellValue('D'.$y,$Reg['SUM(avg_packets_lost_tx)'])
			            ->setCellValue('E'.$y,$Reg['AVG(avg_percent_packet_loss_tx)']);
			            
			$objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet()->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet()->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet()->getStyle("C".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet()->getStyle("D".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet()->getStyle("E".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');

            $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$y)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

			$y=$y+1;

	     }       

	    // PAGINA 7
		// DETALLE DE LLAMADAS SALIENTES POR DIA
		$objPHPExcel->createSheet(NULL, 6);
		$objPHPExcel->setActiveSheetIndex(6);
		$objPHPExcel->getActiveSheet()->setTitle("OUT_por_dia");

        //Ajustar columna
        $objPHPExcel->getActiveSheet(6)
        ->getColumnDimension('A')
        ->setWidth(20);

        //Size font
        $objPHPExcel->getActiveSheet(6)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A4:A4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("C5:C5")->getFont()->setSize(8);         

        $objPHPExcel->setActiveSheetIndex(6)
                    //Title
                    ->mergeCells('A2:C2')
                    ->setCellValue('A2','DETALLE DE LLAMADAS SALIENTES POR DIA')
                    //Sub-title
                    ->mergeCells('A4:C4')
                    ->setCellValue('A4','Llamadas por dia')
                    //Title site
                    ->mergeCells('A5:A5')   
                    ->setCellValue('A5','Fecha')
                    //Title quantity
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Cantidad')
                    //Name time
                    ->mergeCells('C5:C5')
                    ->setCellValue('C5','Tiempo');

                    //Center title details of calls salientes for day
                    $objPHPExcel->getActiveSheet(6)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(6)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    //Center title calls for day
                    $objPHPExcel->getActiveSheet(6)->mergeCells('A4:C4');
                    $objPHPExcel->getActiveSheet(6)->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('A4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    //Center title date
                    $objPHPExcel->getActiveSheet(6)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(6)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title quantity
                    $objPHPExcel->getActiveSheet(6)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(6)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title time
                    $objPHPExcel->getActiveSheet(6)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(6)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            //Exec query sql and save in variable php
            $qry = "SELECT start_date AS fecha, COUNT(start_date) AS cantidad_llamadas, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) AS tiempo_total FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY start_date ORDER BY start_date ASC;";
            
            $result = mysql_query ($qry, $conexion);

            $y=6;
            
            while($Reg = mysql_fetch_array($result))

            {     
                $objPHPExcel->setActiveSheetIndex(6)
                            ->setCellValue('A'.$y,$Reg['fecha'])
                            ->setCellValue('B'.$y,$Reg['cantidad_llamadas'])
                            ->setCellValue('C'.$y,$Reg['tiempo_total']);

                $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                $objPHPExcel->getActiveSheet(6)->getStyle("A".$y)->getFont()->setSize(8);
                $objPHPExcel->getActiveSheet(6)->getStyle("B".$y)->getFont()->setSize(8);
                $objPHPExcel->getActiveSheet(6)->getStyle("C".$y)->getFont()->setSize(8);

                $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');

                $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
                $y=$y+1;
            }
             
		// PAGINA 8
		// GRAFICO CANTIDAD DE LLAMADAS SALIENTES POR DIA
		$objPHPExcel->createSheet(NULL, 7);
		$objPHPExcel->setActiveSheetIndex(7);
		$objPHPExcel->getActiveSheet()->setTitle("OUT_por_dia_chart");

        // char bar - cantidad llamadas entrantes por dia

        // create sheet for pie charts 
        $objWorksheet = $objPHPExcel->getActiveSheet(7);

        //  Set the Labels for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker

        $dataSeriesLabels2 = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'OUT_por_dia!$B$5', NULL, 1), // quantity
        );

        //  Set the X-Axis Labels
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $xAxisTickValues = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'OUT_por_dia!$A$6:$A$'.$y, NULL, 12), // date
        );

        //  Set the Data values for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $dataSeriesValues1 = array(
        new PHPExcel_Chart_DataSeriesValues('Number', 'OUT_por_dia!$B$6:$B$'.$y, NULL, 12), // values quantity
        );

        //  Build the dataseries
        $series1 = new PHPExcel_Chart_DataSeries(
           PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
           PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  // plotGrouping
           range(0, count($dataSeriesValues1)-1),          // plotOrder
           $dataSeriesLabels1,                             // plotLabel
           $xAxisTickValues,                               // plotCategory
           $dataSeriesValues1                              // plotValues
           );

        //  Set additional dataseries parameters
        //  Make it a vertical column rather than a horizontal bar graph
        $series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

        //  Set the series in the plot area
        $plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series1));
        //  Set the chart legend
        $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
        $title = new PHPExcel_Chart_Title('Cantidad de llamadas salientes por dia');

        //  Create the chart
        $chart = new PHPExcel_Chart(
           'chart1',       // name
            $title,         // title
            $legend,        // legend
            $plotArea,      // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel
            );

        //  Set the position where the chart should appear in the worksheet
        $chart->setTopLeftPosition('A1', 24, 24);
        $chart->setBottomRightPosition('M33', -24);

        $objPHPExcel->getActiveSheet(2)->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        //  Add the chart to the worksheet
        $objWorksheet->addChart($chart);

		// PAGINA 9
		// DETALLE LLAMADAS SALIENTES POR TIPO DE TERMINAL - Total de llamadas y duración por Tipo de Sitio		
		$objPHPExcel->createSheet(NULL, 8);
		$objPHPExcel->setActiveSheetIndex(8);
		$objPHPExcel->getActiveSheet()->setTitle("OUT_por_tipo");

         // ajust column
        $objPHPExcel->getActiveSheet(8)
        ->getColumnDimension('A')
        ->setWidth(30);

        // size font
        $objPHPExcel->getActiveSheet(8)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("C5:C5")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(8)
                    // title
                    ->mergeCells('A2:C2')
                    ->setCellValue('A2','LlAMADAS SALIENTES POR TIPO DE TERMINAL')
                    // sub-title
                    ->mergeCells('A4:C4')
                    ->setCellValue('A4','Total de llamadas y duracion por Tipo de sitio')
                    // title site
                    ->mergeCells('A5:A5')   
                    ->setCellValue('A5','Tipo Sitio')
                    // title quantity
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Cantidad')
                    // name time
                    ->mergeCells('C5:C5')
                    ->setCellValue('C5','Tiempo');

                    // center title totals salientes for tipe of terminal
                    $objPHPExcel->getActiveSheet(8)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(8)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    // center title totals calls and duration for tipe of site
                    $objPHPExcel->getActiveSheet(8)->mergeCells('A4:C4');
                    $objPHPExcel->getActiveSheet(8)->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('A4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    // center title type site
                    $objPHPExcel->getActiveSheet(8)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(8)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    // center title quantity
                    $objPHPExcel->getActiveSheet(8)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(8)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    // center title time
                    $objPHPExcel->getActiveSheet(8)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(8)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

        // exec query sql and save in variable php
        $qry = "SELECT endpoint_type, COUNT(endpoint_type) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY endpoint_type;";
        
        $result = mysql_query ($qry, $conexion);

        $y=6;

        while($Reg = mysql_fetch_array($result))

        {
            $endpoint_type = $Reg['endpoint_type'];
            if($endpoint_type == " "){
                $endpoint_type = "Software";
            }elseif($endpoint_type == "user:terminal"){
                $endpoint_type = "Terminal";
            }

            $objPHPExcel->setActiveSheetIndex(8)
                        ->setCellValue('A'.$y,$Reg['endpoint_type'])
                        ->setCellValue('B'.$y,$Reg['cantidad'])
                        ->setCellValue('C'.$y,$Reg['tiempo']);
                        
            $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet(8)->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(8)->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(8)->getStyle("C".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet(8)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');

            $objPHPExcel->getActiveSheet(8)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $y=$y+1;
        }

          // create sheet for pie charts 
         $objWorksheet = $objPHPExcel->getActiveSheet(7);

        // grafico pie pagina 4 - llamadas entrantes por tipo de terminal

            // set the Labels for each data series we want to plot
            $dataSeriesLabels1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'OUT_por_tipo!$A$5', NULL, 1),        // tipo sitio
            );
            // set the X-Axis Labels
            $xAxisTickValues1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'OUT_por_tipo!$A$6:$A$8', NULL, 4),    // values tipo de sitio
            );
            // set the Data values for each data series we want to plot
            $dataSeriesValues1 = array(new PHPExcel_Chart_DataSeriesValues('Number', 'OUT_por_tipo!$B$6:$B$8', NULL, 4),); // values cantidad
            // build the dataseries
            $series1 = new PHPExcel_Chart_DataSeries(
            PHPExcel_Chart_DataSeries::TYPE_PIECHART,               // plotType
            NULL,                                                   // plotGrouping
            range(0, count($dataSeriesValues1)-1),                  // plotOrder
            $dataSeriesLabels1,                                     // plotLabel
            $xAxisTickValues1,                                      // plotCategory
            $dataSeriesValues1                                      // plotValues
            );
            // set up a layout object for the Pie chart
            $layout1 = new PHPExcel_Chart_Layout();
            $layout1->setShowVal(TRUE);
            $layout1->setShowPercent(TRUE);
            // set the series in the plot area
            $plotArea1 = new PHPExcel_Chart_PlotArea($layout1, array($series1));
            // set the chart legend
            $legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
            $title1 = new PHPExcel_Chart_Title('Cantidad de llamadas por tipo de terminal'); 
            // create the chart
            $chart1 = new PHPExcel_Chart(
            'chart1',       // name
            $title1,        // title
            $legend1,       // legend
            $plotArea1,     // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel       - Pie charts don't have a Y-Axis
            );
            // set the position where the chart should appear in the worksheet
            $chart1->setTopLeftPosition('A10');
            $chart1->setBottomRightPosition('E30');
            // add the chart to the worksheet
            $objWorksheet->addChart($chart1);

		// PAGINA 10
		// DETALLE LLAMADAS SALIENTES POR SITIO - Total de llamadas y duración por Sitio		
		$objPHPExcel->createSheet(NULL, 9);
		$objPHPExcel->setActiveSheetIndex(9);
		$objPHPExcel->getActiveSheet()->setTitle("OUT_por_sitio");

        // ajust column
        $objPHPExcel->getActiveSheet(9)
        ->getColumnDimension('A')
        ->setWidth(38);
        
        // font size
        $objPHPExcel->getActiveSheet(8)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("A4:A4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("C5:C5")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(9)
                    //Title
                    ->mergeCells('A2:C2')
                    ->setCellValue('A2','LlAMADAS SALIENTES POR SITIO')
                    //Sub-title
                    ->mergeCells('A4:A4')
                    ->setCellValue('A4','Total de llamadas y duracion por sitio')
                    //Title vacio
                    ->mergeCells('B4:B4')   
                    ->setCellValue('B4','')
                    //Title vacio
                    ->mergeCells('C4:C4')
                    ->setCellValue('C4','')
                    //Name site 
                    ->mergeCells('A5:A5')
                    ->setCellValue('A5','Nombre Sitio')
                    //Title quantity
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Cantidad')
                    //Title time
                    ->mergeCells('C5:C5')
                    ->setCellValue('C5','Tiempo');

                    //Center title calls entry for site
                    $objPHPExcel->getActiveSheet(9)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(9)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title total calls and duration for site
                    $objPHPExcel->getActiveSheet(9)->mergeCells('A4:A4');
                    $objPHPExcel->getActiveSheet(9)->getStyle('A4:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('A4:A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:A4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:A4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title vacio
                    $objPHPExcel->getActiveSheet(9)->mergeCells('B4:B4');
                    $objPHPExcel->getActiveSheet(9)->getStyle('B4:B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('B4:B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title vacio
                    $objPHPExcel->getActiveSheet(9)->mergeCells('C4:C4');
                    $objPHPExcel->getActiveSheet(9)->getStyle('C4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('C4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C4:C4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title name site
                    $objPHPExcel->getActiveSheet(9)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(9)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title quantity
                    $objPHPExcel->getActiveSheet(4)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(4)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title time
                    $objPHPExcel->getActiveSheet(9)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(9)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                   
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                   
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                   
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

        //Exec query sql and save in variable php
        $qry = "SELECT name, count(name) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info not like 'Fail%' GROUP BY name ORDER BY cantidad DESC;";
        
        $result = mysql_query ($qry, $conexion);

        $y=6;
        
        while($Reg = mysql_fetch_array($result))

        {    

            $objPHPExcel->setActiveSheetIndex(9)
                        ->setCellValue('A'.$y,$Reg['name'])
                        ->setCellValue('B'.$y,$Reg['cantidad'])
                        ->setCellValue('C'.$y,$Reg['tiempo']);
                        
            $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet(8)->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(8)->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(8)->getStyle("C".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet(8)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');

            $objPHPExcel->getActiveSheet(8)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $y=$y+1;

        }
        
		// PAGINA 11
		// DETALLE DE EXPERIENCIA POR SITIO SALIENTES - QoE - Calidad de la Experiencia				
		$objPHPExcel->createSheet(NULL, 10);
		$objPHPExcel->setActiveSheetIndex(10);
		$objPHPExcel->getActiveSheet()->setTitle("OUT_QOE");

        //Ajustar columna
        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('A')
        ->setWidth(27);
        
        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('B')
        ->setWidth(10); 

        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('C')
        ->setWidth(10);

        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('D')
        ->setWidth(10);

        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('E')
        ->setWidth(10);
        
        //Size font
        $objPHPExcel->getActiveSheet(5)->getStyle("A2:E2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A5:A6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("C5:C6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("D5:D6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("E5:E6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B6:B6")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(10)
                    //Title
                    ->mergeCells('A2:E2')
                    ->setCellValue('A2','DETALLE DE EXPERIENCIA POR SITIO SALIENTES')
                    //Sub-title
                    ->mergeCells('A4:E4')
                    ->setCellValue('A4','QoE - Calidad de la Experiencia')
                    //Name site
                    ->mergeCells('A5:A6')   
                    ->setCellValue('A5','Nombre de sitio')
                    //Title sumatory rx
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Sumatoria')
                    //Sub-title sumatory rx
                    ->mergeCells('B5:B5')
                    ->setCellValue('B6','Packet Lost RX')
                    //Title Promedio rx
                    ->setCellValue('C5','Promedio %')
                    //Sub-title promedio rx
                    ->setCellValue('C6','Packet Lost RX')
                    //Title sumatory tx
                    ->setCellValue('D5','Sumatoria')
                    //Sub-title sumatory tx
                    ->setCellValue('D6','Packet Lost TX')
                    //Title promedio tx
                    ->setCellValue('E5','Promedio %')
                    //Sub-title promedio tx
                    ->setCellValue('E6','Packet Lost TX');

                    //Center title detalle de experienciea por sitio salientes
                    $objPHPExcel->getActiveSheet(10)->mergeCells('A2:E2');
                    $objPHPExcel->getActiveSheet(10)->getStyle('A2:E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('A2:E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title Quality of the experience
                    $objPHPExcel->getActiveSheet(10)->mergeCells('A4:E4');
                    $objPHPExcel->getActiveSheet(10)->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title site name
                    $objPHPExcel->getActiveSheet(10)->mergeCells('A5:A6');
                    $objPHPExcel->getActiveSheet(10)->getStyle('A5:A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('A5:A6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(10)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(5)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(10)->getStyle('B6:B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('B6:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title packet lost rx
                    $objPHPExcel->getActiveSheet(10)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(10)->getStyle('C6:C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('C6:C6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(10)->getStyle('D5:D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('D5:D5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('D5:D5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('D5:D5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(10)->getStyle('D6:D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('D6:D6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('D6:D6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('D6:D6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(10)->getStyle('E5:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('E5:E5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('E5:E5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('E5:E5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(10)->getStyle('E6:E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('E6:E6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 


        //Exec query sql and save value in variable php         
        $qry = "SELECT name, SUM(avg_packets_lost_rx), AVG(avg_percent_packeT_loss_rx), SUM(avg_packets_lost_tx),AVG(avg_percent_packet_loss_tx) FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY NAME;";
        
        $result = mysql_query ($qry, $conexion);

        $y=7;  

        while($Reg = mysql_fetch_array($result))
        {

            $objPHPExcel->setActiveSheetIndex(10)
                        ->setCellValue('A'.$y,$Reg['name'])
                        ->setCellValue('B'.$y,$Reg['SUM(avg_packets_lost_rx)'])
                        ->setCellValue('C'.$y,$Reg['AVG(avg_percent_packeT_loss_rx)'])
                        ->setCellValue('D'.$y,$Reg['SUM(avg_packets_lost_tx)'])
                        ->setCellValue('E'.$y,$Reg['AVG(avg_percent_packet_loss_tx)']);
                        
            $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet(10)->getStyle("A".$y)->getFont()->setSize(8); 
            $objPHPExcel->getActiveSheet(10)->getStyle("B".$y)->getFont()->setSize(8); 
            $objPHPExcel->getActiveSheet(10)->getStyle("C".$y)->getFont()->setSize(8); 
            $objPHPExcel->getActiveSheet(10)->getStyle("D".$y)->getFont()->setSize(8); 
            $objPHPExcel->getActiveSheet(10)->getStyle("E".$y)->getFont()->setSize(8); 

            $objPHPExcel->getActiveSheet(10)->getStyle('C'.$y)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet(10)->getStyle('E'.$y)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            $objPHPExcel->getActiveSheet(10)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');
            $objPHPExcel->getActiveSheet(10)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');



             $y=$y+1;

         }       

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);

	//########### SEND HEADERS ################	
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="New_Reporte.xls"');
	header('Cache-Control: max-age=0');

	//$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->setIncludeCharts(TRUE);
    $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
    $objWriter->save('php://output');
	exit;
}

else {

//TENGO LOGO

        //########### ADD A IMAGE CLIENTE ################
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('../file_storage/logos/'.$Reg['path_logo']);
        $objDrawing->setCoordinates('B1');
        $objDrawing->setHeight(10);
        $objDrawing->setWidth(80);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  

        // se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("TouchMedia") // autor
                             ->setLastModifiedBy("TouchMedia") //  ultimo usuario que lo modificó
                             ->setTitle("Reporte Excel")
                             ->setSubject("Reporte Excel")
                             ->setDescription("Reporte de CDR Processor")
                             ->setKeywords("reporte CDR Processor")
                             ->setCategory("Reporte excel");

        // PAGINA 1
        // REPORTE DE USO VIDEOCONFERENCIA
        // PARAMETROS DEL REPORTE
        $tituloReporte = "REPORTE DE USO VIDEOCONFERENCIA";

        // aply colors a cell pagina 1
        function cellColor($cells,$color){
                 global $objPHPExcel;
                 $objPHPExcel->getActiveSheet(0)->getStyle($cells)->getFill()
                 ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                 'startcolor' => array('rgb' => $color)
                  ));
            }
            cellColor('A6:B6','C0C0C0');
            cellColor('A8:B8','C0C0C0');
            cellColor('A15:B15','C0C0C0');
            cellColor('C15','C0C0C0');
            cellColor('A16:B16','C0C0C0');
            cellColor('C16','C0C0C0');

        //########### AJUSTAR COLUMNA ##############
        $objPHPExcel->getActiveSheet()
        ->getColumnDimension('A')
        ->setWidth(27);
        
        $objPHPExcel->getActiveSheet()
        ->getColumnDimension('B')
        ->setWidth(18);
        
        // size Font
        $objPHPExcel->getActiveSheet(0)->getStyle("A6:A6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A8:A8")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A9:A9")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A10:A10")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A11:A11")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A12:A12")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A13:A13")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A15:C15")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A16:B16")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("C16:B9")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A17:B17")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("C17:B10")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A18:B18")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("C18:B11")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("B12:B13")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A7:B7")->getFont()->setSize(8);

        // se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A6:B6');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A8:B8');

        //########### ADD A IMAGE TOUCH MEDIA################
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('../resources/tmc_logo.png');
        $objDrawing->setCoordinates('A1');
        $objDrawing->setHeight(10);
        $objDrawing->setWidth(150);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());      
        //########################################

        // center title report of use video conference
        $objPHPExcel->getActiveSheet(0)->mergeCells('A6:A6');
        $objPHPExcel->getActiveSheet(0)->getStyle('A6:A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        /** Borders for heading -  title report of use video conference */
        $objPHPExcel->getActiveSheet()->getStyle('A6:B6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        // bold
        $objPHPExcel->getActiveSheet()->getStyle('A6:A6')->getFont()->setBold(true);

        // center title parameter of report
        $objPHPExcel->getActiveSheet(0)->mergeCells('A8:A8');
        $objPHPExcel->getActiveSheet(0)->getStyle('A8:A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        /** Borders for heading -  title parameter of report */
        $objPHPExcel->getActiveSheet()->getStyle('A8:B8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        // bold
        $objPHPExcel->getActiveSheet()->getStyle('A8:A8')->getFont()->setBold(true);

        // center title total registers
        $objPHPExcel->getActiveSheet(0)->mergeCells('A8:A8');
        $objPHPExcel->getActiveSheet(0)->getStyle('A8:A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        /** borders for heading -  total registers */
        $objPHPExcel->getActiveSheet()->getStyle('A9:B9')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        /** borders for heading -  title total failed  attempts */
        $objPHPExcel->getActiveSheet()->getStyle('A10:B10')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        /** borders for heading -  title total calls concretized */
        $objPHPExcel->getActiveSheet()->getStyle('A11:B11')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        /** borders for heading -  title first records*/
        $objPHPExcel->getActiveSheet()->getStyle('A12:B12')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        /** borders for heading -  title second records */
        $objPHPExcel->getActiveSheet()->getStyle('A13:B13')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        // thousands separator 
        $objPHPExcel->getActiveSheet(0)->getStyle('B9')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
        $objPHPExcel->getActiveSheet(0)->getStyle('B11')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
        $objPHPExcel->getActiveSheet(0)->getStyle('B12')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;$#,##0');
        $objPHPExcel->getActiveSheet(0)->getStyle('B17')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
        $objPHPExcel->getActiveSheet(0)->getStyle('B18')->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A6',$tituloReporte.' '.$nombrecliente)
                    ->setCellValue('A8','Parametros del reporte')
                    
                    ->setCellValue('A9',  "Total de Registros")
                    ->setCellValue('B9',  getCountItemsFile())
                    
                    ->setCellValue('A10',  "Total de Intentos Fallidos")
                    ->setCellValue('B10',  getCountFailedAttempr())
                    
                    ->setCellValue('A11',  "total de llamadas concretadas")
                    ->setCellValue('B11',  (getCountAllItems() - getCountFailedAttempr()))
                    
                    ->setCellValue('A12',  "Primer Registro")
                    ->setCellValue('B12',  getDateFirstRecord())

                    ->setCellValue('A13',  "Ultimo Registro")
                    ->setCellValue('B13',  getDateLastRecord())

                    ->setCellValue('A7',  "Fecha y Hora Actual")
                    ->setCellValue('B7',  getDateActual())

                    // title Total calls
                    ->mergeCells('A15:C15')
                    ->setCellValue('A15','Total de llamadas')
                    // sub-title calls
                    ->setCellValue('A16','Direccion')
                    // sub-title calls
                    ->setCellValue('B16','Cantidad')
                    // sub-title calls
                    ->setCellValue('C16','Tiempo')

                    ->setCellValue('A17','Entrantes')
                    ->setCellValue('A18','Salientes');

                    // align a right
                    $objPHPExcel->getActiveSheet(0)->getStyle('B12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    $objPHPExcel->getActiveSheet(0)->getStyle('B13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    
                    // align a right
                    $objPHPExcel->getActiveSheet(0)->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                    // se asigna el nombre a la hoja
                    $objPHPExcel->getActiveSheet()->setTitle('Reporte');

                    // center title total of call 
                    $objPHPExcel->getActiveSheet(0)->mergeCells('A15:B15');
                    $objPHPExcel->getActiveSheet(0)->getStyle('A15:B15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                       
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A15:A15')->getFont()->setBold(true);

                    /** borders for heading -  title total of call */
                     $objPHPExcel->getActiveSheet()->getStyle('A15:C15')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    
                    // center sub-title total of call address 
                    $objPHPExcel->getActiveSheet(0)->mergeCells('A16:A16');
                    $objPHPExcel->getActiveSheet(0)->getStyle('A16:A16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A16:A16')->getFont()->setBold(true);

                    /** borders for heading -  sub-title total of call addrress */
                    $objPHPExcel->getActiveSheet()->getStyle('A16:A16')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    // center sub-title total of call quantity
                    $objPHPExcel->getActiveSheet(0)->mergeCells('B16:B16');
                    $objPHPExcel->getActiveSheet(0)->getStyle('B16:B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('B16:B16')->getFont()->setBold(true);

                    /** borders for heading -  sub-title total of call quantity */
                    $objPHPExcel->getActiveSheet()->getStyle('B16:B16')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                     // center sub-title total of call time
                    $objPHPExcel->getActiveSheet(0)->mergeCells('C16:C16');
                    $objPHPExcel->getActiveSheet(0)->getStyle('C16:C16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('C16:C16')->getFont()->setBold(true);

                    /** borders for heading -  title parameter of report */
                    $objPHPExcel->getActiveSheet()->getStyle('C16:C16')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    /** borders for heading -  title call address incoming */
                    $objPHPExcel->getActiveSheet()->getStyle('A17:A17')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    /** borders for heading -  title quantity incoming */
                    $objPHPExcel->getActiveSheet()->getStyle('B17:B17')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);    

                    /** borders for heading -  title time incoming */
                    $objPHPExcel->getActiveSheet()->getStyle('C17:C17')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    /** borders for heading -  title call address outgoing */
                    $objPHPExcel->getActiveSheet()->getStyle('A18:A18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    /** borders for heading -  title quantity outgoing */
                    $objPHPExcel->getActiveSheet()->getStyle('B18:B18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);    

                    /** borders for heading -  title time outgoing */
                    $objPHPExcel->getActiveSheet()->getStyle('C18:C18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   
                    
                    /** borders for heading -  title time outgoing */
                    $objPHPExcel->getActiveSheet()->getStyle('A7:B7')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

        // exeC query sql and save in variable php
        $qry = "SELECT call_direction, COUNT(call_direction) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata GROUP BY call_direction;";

        $result = mysql_query ($qry, $conexion);

        $y=17;

        while($Reg = mysql_fetch_array($result))

        {

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$y,$Reg['call_direction'])
                        ->setCellValue('B'.$y,$Reg['cantidad'])
                        ->setCellValue('C'.$y,$Reg['tiempo']);

                        $objPHPExcel->getActiveSheet(0)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $y=$y+1;

        }
    
    // create sheet for pie charts 
    $objWorksheet = $objPHPExcel->getActiveSheet(0);

    // grafico pie pagina 1 - cantidad por direccion

            // set the Labels for each data series we want to plot
            $dataSeriesLabels1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'Reporte!$B$16', NULL, 1),         // direccion
            );
            // set the X-Axis Labels
            $xAxisTickValues1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'Reporte!$A$17:$A$18', NULL, 4),    // values Incoming - Outcoming
            );
            // set the Data values for each data series we want to plot
            $dataSeriesValues1 = array(new PHPExcel_Chart_DataSeriesValues('Number', 'Reporte!$B$17:$B$18', NULL, 4),); // values cantidad
            // build the dataseries
            $series1 = new PHPExcel_Chart_DataSeries(
            PHPExcel_Chart_DataSeries::TYPE_PIECHART,               // plotType
            NULL,                                                   // plotGrouping
            range(0, count($dataSeriesValues1)-1),                  // plotOrder
            $dataSeriesLabels1,                                     // plotLabel
            $xAxisTickValues1,                                      // plotCategory
            $dataSeriesValues1                                      // plotValues
            );
            // set up a layout object for the Pie chart
            $layout1 = new PHPExcel_Chart_Layout();
            $layout1->setShowVal(TRUE);
            $layout1->setShowPercent(TRUE);
            // set the series in the plot area
            $plotArea1 = new PHPExcel_Chart_PlotArea($layout1, array($series1));
            // set the chart legend
            $legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
            $title1 = new PHPExcel_Chart_Title('Cantidad por Direccion'); 
            // create the chart
            $chart1 = new PHPExcel_Chart(
            'chart1',       // name
            $title1,        // title
            $legend1,       // legend
            $plotArea1,     // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel       - Pie charts don't have a Y-Axis
            );
            // set the position where the chart should appear in the worksheet
            $chart1->setTopLeftPosition('A20');
            $chart1->setBottomRightPosition('E30');
            // add the chart to the worksheet
            $objWorksheet->addChart($chart1);
     
        // PAGINA 2
        // DETALLE DE LLAMADAS ENTRANTES POR DIA - Llamadas por dia

        $objPHPExcel->createSheet(NULL, 1);
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setTitle("INC_por_dia");

        // ajust column
        $objPHPExcel->getActiveSheet(1)
        ->getColumnDimension('A')
        ->setWidth(12);
        $objPHPExcel->getActiveSheet(1)
        ->getColumnDimension('C')
        ->setWidth(10);
        
        // size font
        $objPHPExcel->getActiveSheet(0)->getStyle("A2:D2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("A5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(0)->getStyle("C5")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('A2','DETALLE DE LlAMADAS ENTRANTES POR DIA')
                    ->setCellValue('A4','Llamadas por dia')
                    ->mergeCells('A5:A5')
                    ->setCellValue('A5','Fecha')
                    ->setCellValue('B5','Cantidad')
                    ->setCellValue('C5','Tiempo');

        // center title details entry for day
        $objPHPExcel->getActiveSheet(1)->mergeCells('A2:D2');
        $objPHPExcel->getActiveSheet(1)->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('A2:B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        // bold
        $objPHPExcel->getActiveSheet()->getStyle('A2:D2')->getFont()->setBold(true);

        /** borders for heading -  title details entry for day */
        $objPHPExcel->getActiveSheet()->getStyle('A2:D2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //Center title calls for day
        $objPHPExcel->getActiveSheet(1)->mergeCells('A4:C4');
        $objPHPExcel->getActiveSheet(1)->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('A4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        // bold
        $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);

        /** Borders for heading -  title total of call */
        $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        // center title date
        $objPHPExcel->getActiveSheet(1)->mergeCells('A5:A5');
        $objPHPExcel->getActiveSheet(1)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('A5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        // bold
        $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);

        /** Borders for heading -  date */
        $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        
        // center title quantity
        $objPHPExcel->getActiveSheet(1)->mergeCells('B5:B5');
        $objPHPExcel->getActiveSheet(1)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        // bold
        $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);

        /** borders for heading -  quantity */
        $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        // center title time
        $objPHPExcel->getActiveSheet(1)->mergeCells('C5:C5');
        $objPHPExcel->getActiveSheet(1)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // aply colors a cell       
        $objPHPExcel->getActiveSheet(1)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                       
        // bold
        $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);

        /** Borders for heading -  time */
        $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        
        // exec query sql and save in variable php - calls entry for day
        $qry = "SELECT start_date AS fecha, COUNT(start_date) AS cantidad_llamadas, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) AS tiempo_total FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' GROUP BY start_date ORDER BY start_date ASC;";
        
        $result = mysql_query ($qry, $conexion);

        $y=6;
        
        while($Reg = mysql_fetch_array($result))
            
            {

                $objPHPExcel->setActiveSheetIndex(1)
                        ->setCellValue('A'.$y,$Reg['fecha'])
                        ->setCellValue('B'.$y,$Reg['cantidad_llamadas'])
                        ->setCellValue('C'.$y,$Reg['tiempo_total']);

                $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                $objPHPExcel->getActiveSheet(1)->getStyle('A'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $objPHPExcel->getActiveSheet(1)->getStyle('B'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $objPHPExcel->getActiveSheet(1)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $objPHPExcel->getActiveSheet(1)->getStyle('A'.$y)->getFont()->setSize(8);
                $objPHPExcel->getActiveSheet(1)->getStyle('B'.$y)->getFont()->setSize(8);
                $objPHPExcel->getActiveSheet(1)->getStyle('C'.$y)->getFont()->setSize(8);

                $objPHPExcel->getActiveSheet(1)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
            
            $y=$y+1;
            
            
            }

            $y;

        // PAGINA 3
        // GRAFICO CANTIDAD LLAMADAS ENTRANTES POR DIA
        $objPHPExcel->createSheet(NULL, 2);
        $objPHPExcel->setActiveSheetIndex(2);
        $objPHPExcel->getActiveSheet()->setTitle("INC_por_dia_chart");

        // char bar - cantidad llamadas entrantes por dia

        // create sheet for pie charts 
        $objWorksheet = $objPHPExcel->getActiveSheet(2);

        //  Set the Labels for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker

        $dataSeriesLabels2 = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'INC_por_dia!$B$5', NULL, 1), // quantity
        );

        //  Set the X-Axis Labels
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $xAxisTickValues = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'INC_por_dia!$A$6:$A$'.$y, NULL, 12), // date
        );

        //  Set the Data values for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $dataSeriesValues1 = array(
        new PHPExcel_Chart_DataSeriesValues('Number', 'INC_por_dia!$B$6:$B$'.$y, NULL, 12), // values quantity
        );

        //  Build the dataseries
        $series1 = new PHPExcel_Chart_DataSeries(
           PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
           PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  // plotGrouping
           range(0, count($dataSeriesValues1)-1),          // plotOrder
           $dataSeriesLabels1,                             // plotLabel
           $xAxisTickValues,                               // plotCategory
           $dataSeriesValues1                              // plotValues
           );

        //  Set additional dataseries parameters
        //  Make it a vertical column rather than a horizontal bar graph
        $series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

        //  Set the series in the plot area
        $plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series1));
        //  Set the chart legend
        $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
        $title = new PHPExcel_Chart_Title('Cantidad de llamadas entrantes por dia');

        //  Create the chart
        $chart = new PHPExcel_Chart(
           'chart1',       // name
            $title,         // title
            $legend,        // legend
            $plotArea,      // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel
            );

        //  Set the position where the chart should appear in the worksheet
        $chart->setTopLeftPosition('A1', 24, 24);
        $chart->setBottomRightPosition('M33', -24);

        $objPHPExcel->getActiveSheet(2)->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        //  Add the chart to the worksheet
        $objWorksheet->addChart($chart);

        // PAGINA 4
        // DETALLE LLAMADAS ENTRANTES POR TIPO DE TERMINAL - Total de llamadas y duración por Tipo de Sitio                             
        $objPHPExcel->createSheet(NULL, 3);
        $objPHPExcel->setActiveSheetIndex(3);
        $objPHPExcel->getActiveSheet()->setTitle("INC_por_tipo");
       
        // ajust column
        $objPHPExcel->getActiveSheet(3)
        ->getColumnDimension('A')
        ->setWidth(30);
         
        // size font
        $objPHPExcel->getActiveSheet(3)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("C5:C5")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(3)
                    // title
                    ->mergeCells('A2:C2')
                    ->setCellValue('A2','LlAMADAS ENTRANTES POR TIPO DE TERMINAL')
                    // sub-title
                    ->mergeCells('A4:C4')
                    ->setCellValue('A4','Total de llamadas y duracion por Tipo de sitio')
                    // title site
                    ->mergeCells('A5:A5')   
                    ->setCellValue('A5','Tipo Sitio')
                    // title quantity
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Cantidad')
                    // name time
                    ->mergeCells('C5:C5')
                    ->setCellValue('C5','Tiempo');

                    // center title totals entry for tipe of terminal
                    $objPHPExcel->getActiveSheet(3)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(3)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    // center title totals calls and duration for tipe of site
                    $objPHPExcel->getActiveSheet(3)->mergeCells('A4:C4');
                    $objPHPExcel->getActiveSheet(3)->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('A4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    // center title type site
                    $objPHPExcel->getActiveSheet(3)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(3)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    // center title quantity
                    $objPHPExcel->getActiveSheet(3)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(3)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    // center title time
                    $objPHPExcel->getActiveSheet(3)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(3)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(3)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

        // exec query sql and save in variable php
        $qry = "SELECT endpoint_type, COUNT(endpoint_type) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY endpoint_type;";
        
        $result = mysql_query ($qry, $conexion);

        $y=6;

        while($Reg = mysql_fetch_array($result))

        {
            $endpoint_type = $Reg['endpoint_type'];
            if($endpoint_type == " "){
                $endpoint_type = "Software";
            }elseif($endpoint_type == "user:terminal"){
                $endpoint_type = "Terminal";
            }
            
            $objPHPExcel->setActiveSheetIndex(3)
                         ->setCellValue('A'.$y,$Reg['endpoint_type'])
                         ->setCellValue('B'.$y,$Reg['cantidad'])
                         ->setCellValue('C'.$y,$Reg['tiempo']);

            $objPHPExcel->getActiveSheet(3)->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet(3)->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet(3)->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet(3)->getStyle('A'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet(3)->getStyle('B'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet(3)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $objPHPExcel->getActiveSheet(3)->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(3)->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(3)->getStyle("C".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet(3)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
            
            $y=$y+1;
        }

         // create sheet for pie charts 
         $objWorksheet = $objPHPExcel->getActiveSheet(3);

        // grafico pie pagina 4 - llamadas entrantes por tipo de terminal

            // set the Labels for each data series we want to plot
            $dataSeriesLabels1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'INC_por_tipo!$A$5', NULL, 1),        // tipo sitio
            );
            // set the X-Axis Labels
            $xAxisTickValues1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'INC_por_tipo!$A$6:$A$8', NULL, 4),    // values tipo de sitio
            );
            // set the Data values for each data series we want to plot
            $dataSeriesValues1 = array(new PHPExcel_Chart_DataSeriesValues('Number', 'INC_por_tipo!$B$6:$B$8', NULL, 4),); // values cantidad
            // build the dataseries
            $series1 = new PHPExcel_Chart_DataSeries(
            PHPExcel_Chart_DataSeries::TYPE_PIECHART,               // plotType
            NULL,                                                   // plotGrouping
            range(0, count($dataSeriesValues1)-1),                  // plotOrder
            $dataSeriesLabels1,                                     // plotLabel
            $xAxisTickValues1,                                      // plotCategory
            $dataSeriesValues1                                      // plotValues
            );
            // set up a layout object for the Pie chart
            $layout1 = new PHPExcel_Chart_Layout();
            $layout1->setShowVal(TRUE);
            $layout1->setShowPercent(TRUE);
            // set the series in the plot area
            $plotArea1 = new PHPExcel_Chart_PlotArea($layout1, array($series1));
            // set the chart legend
            $legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
            $title1 = new PHPExcel_Chart_Title('Cantidad de llamadas por tipo de terminal'); 
            // create the chart
            $chart1 = new PHPExcel_Chart(
            'chart1',       // name
            $title1,        // title
            $legend1,       // legend
            $plotArea1,     // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel       - Pie charts don't have a Y-Axis
            );
            // set the position where the chart should appear in the worksheet
            $chart1->setTopLeftPosition('A10');
            $chart1->setBottomRightPosition('E30');
            // add the chart to the worksheet
            $objWorksheet->addChart($chart1);
             
        // PAGINA 5
        // DETALLE LLAMADAS ENTRANTES POR SITIO - Total de llamadas y duración por Sitio
        $objPHPExcel->createSheet(NULL, 4);
        $objPHPExcel->setActiveSheetIndex(4);
        $objPHPExcel->getActiveSheet()->setTitle("INC_por_sitio");
       
        //Ajust column
        $objPHPExcel->getActiveSheet(4)
        ->getColumnDimension('A')
        ->setWidth(34);

        //Size font
        $objPHPExcel->getActiveSheet(3)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("A4:A4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("B4:B4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("C4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(3)->getStyle("C5:C5")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(4)
                    //Title
                    ->mergeCells('A2:C2')
                    ->setCellValue('A2','LlAMADAS ENTRANTES POR SITIO')
                    //Sub-title
                    ->mergeCells('A4:A4')
                    ->setCellValue('A4','Total de llamadas y duracion por sitio')
                    //Title vacio
                    ->mergeCells('B4:B4')   
                    ->setCellValue('B4','')
                    //Title vacio
                    ->mergeCells('C4:C4')
                    ->setCellValue('C4','')
                    //Name site 
                    ->mergeCells('A5:A5')
                    ->setCellValue('A5','Nombre Sitio')
                    //Title quantity
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Cantidad')
                    //Title time
                    ->mergeCells('C5:C5')
                    ->setCellValue('C5','Tiempo');

                    //Center title calls entry for site
                    $objPHPExcel->getActiveSheet(4)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(4)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title total calls and duration for site
                    $objPHPExcel->getActiveSheet(4)->mergeCells('A4:A4');
                    $objPHPExcel->getActiveSheet(4)->getStyle('A4:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('A4:A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:A4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:A4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title vacio
                    $objPHPExcel->getActiveSheet(4)->mergeCells('B4:B4');
                    $objPHPExcel->getActiveSheet(4)->getStyle('B4:B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('B4:B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title vacio
                    $objPHPExcel->getActiveSheet(4)->mergeCells('C4:C4');
                    $objPHPExcel->getActiveSheet(4)->getStyle('C4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('C4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C4:C4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title name site
                    $objPHPExcel->getActiveSheet(4)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(4)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title quantity
                    $objPHPExcel->getActiveSheet(4)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(4)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title time
                    $objPHPExcel->getActiveSheet(4)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(4)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                   
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                   
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                   
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

        //Exec query sql and save in variable php
        $qry = "SELECT name, count(name) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info not like 'Fail%' GROUP BY name ORDER BY cantidad DESC;";
        
        $result = mysql_query ($qry, $conexion);

        $y=6;

        while($Reg = mysql_fetch_array($result))
        
        {   

            $objPHPExcel->setActiveSheetIndex(4)
                         ->setCellValue('A'.$y,$Reg['name'])
                         ->setCellValue('B'.$y,$Reg['cantidad'])
                         ->setCellValue('C'.$y,$Reg['tiempo']);

            $objPHPExcel->getActiveSheet(4)->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet(4)->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet(4)->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
             
            $objPHPExcel->getActiveSheet(4)->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(4)->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(4)->getStyle("C".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet(4)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');

            $objPHPExcel->getActiveSheet(4)->getStyle('A'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet(4)->getStyle('B'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet(4)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $y=$y+1;

        }
        
        // TITULO PAGINA 6
        // PARAMETROS DEL REPORTE   
        $objPHPExcel->createSheet(NULL, 5);
        $objPHPExcel->setActiveSheetIndex(5);
        $objPHPExcel->getActiveSheet()->setTitle("INC_QOE");        

        //Ajustar columna
        $objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('A')
        ->setWidth(27);
        $objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('B')
        ->setWidth(10); 
        $objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('C')
        ->setWidth(10);
        $objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('D')
        ->setWidth(10);
        $objPHPExcel->getActiveSheet(5)
        ->getColumnDimension('E')
        ->setWidth(10);
        
        //Size font
        $objPHPExcel->getActiveSheet(5)->getStyle("A2:E2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A5:A6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("C5:C6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("D5:D6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("E5:E6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B6:B6")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(5)
                    //Title
                    ->mergeCells('A2:E2')
                    ->setCellValue('A2','DETALLE DE EXPERIENCIA POR SITIO ENTRANTES')
                    //Sub-title
                    ->mergeCells('A4:E4')
                    ->setCellValue('A4','QoE - Calidad de la Experiencia')
                    //Name site
                    ->mergeCells('A5:A6')   
                    ->setCellValue('A5','Nombre de sitio')
                    //Title sumatory rx
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Sumatoria')
                    //Sub-title sumatory rx
                    ->mergeCells('B5:B5')
                    ->setCellValue('B6','Packet Lost RX')
                    //Title Promedio rx
                    ->setCellValue('C5','Promedio %')
                    //Sub-title promedio rx
                    ->setCellValue('C6','Packet Lost RX')
                    //Title sumatory tx
                    ->setCellValue('D5','Sumatoria')
                    //Sub-title sumatory tx
                    ->setCellValue('D6','Packet Lost TX')
                    //Title promedio tx
                    ->setCellValue('E5','Promedio %')
                    //Sub-title promedio tx
                    ->setCellValue('E6','Packet Lost TX');

                    //Center title detalle de experienciea por sitio entrantes
                    $objPHPExcel->getActiveSheet(5)->mergeCells('A2:E2');
                    $objPHPExcel->getActiveSheet(5)->getStyle('A2:E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('A2:E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title Quality of the experience
                    $objPHPExcel->getActiveSheet(5)->mergeCells('A4:E4');
                    $objPHPExcel->getActiveSheet(5)->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title site name
                    $objPHPExcel->getActiveSheet(5)->mergeCells('A5:A6');
                    $objPHPExcel->getActiveSheet(5)->getStyle('A5:A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('A5:A6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(5)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(5)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(5)->getStyle('B6:B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('B6:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title packet lost rx
                    $objPHPExcel->getActiveSheet(5)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(5)->getStyle('C6:C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('C6:C6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(5)->getStyle('D5:D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('D5:D5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('D5:D5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('D5:D5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(5)->getStyle('D6:D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('D6:D6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('D6:D6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('D6:D6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(5)->getStyle('E5:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('E5:E5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('E5:E5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('E5:E5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(5)->getStyle('E6:E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(1)->getStyle('E6:E6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 


        //Exec query sql and save value in variable php         
        $qry = "SELECT name, SUM(avg_packets_lost_rx), AVG(avg_percent_packeT_loss_rx), SUM(avg_packets_lost_tx),AVG(avg_percent_packet_loss_tx) FROM dbpolycom.tbdata WHERE call_direction = 'INCOMING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY NAME;";
        
        $result = mysql_query ($qry, $conexion);
         
        $y=7;

        while($Reg = mysql_fetch_array($result))
        {

            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('A'.$y,$Reg['name'])
                        ->setCellValue('B'.$y,$Reg['SUM(avg_packets_lost_rx)'])
                        ->setCellValue('C'.$y,$Reg['AVG(avg_percent_packeT_loss_rx)'])
                        ->setCellValue('D'.$y,$Reg['SUM(avg_packets_lost_tx)'])
                        ->setCellValue('E'.$y,$Reg['AVG(avg_percent_packet_loss_tx)']);
                        
            $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet()->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet()->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet()->getStyle("C".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet()->getStyle("D".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet()->getStyle("E".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]$#,##0;#,##0');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');

            $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$y)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            $y=$y+1;

         }       

        // PAGINA 7
        // DETALLE DE LLAMADAS SALIENTES POR DIA
        $objPHPExcel->createSheet(NULL, 6);
        $objPHPExcel->setActiveSheetIndex(6);
        $objPHPExcel->getActiveSheet()->setTitle("OUT_por_dia");

        //Ajustar columna
        $objPHPExcel->getActiveSheet(6)
        ->getColumnDimension('A')
        ->setWidth(20);

        //Size font
        $objPHPExcel->getActiveSheet(6)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A4:A4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("C5:C5")->getFont()->setSize(8);         

        $objPHPExcel->setActiveSheetIndex(6)
                    //Title
                    ->mergeCells('A2:C2')
                    ->setCellValue('A2','DETALLE DE LLAMADAS SALIENTES POR DIA')
                    //Sub-title
                    ->mergeCells('A4:C4')
                    ->setCellValue('A4','Llamadas por dia')
                    //Title site
                    ->mergeCells('A5:A5')   
                    ->setCellValue('A5','Fecha')
                    //Title quantity
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Cantidad')
                    //Name time
                    ->mergeCells('C5:C5')
                    ->setCellValue('C5','Tiempo');

                    //Center title details of calls salientes for day
                    $objPHPExcel->getActiveSheet(6)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(6)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    //Center title calls for day
                    $objPHPExcel->getActiveSheet(6)->mergeCells('A4:C4');
                    $objPHPExcel->getActiveSheet(6)->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('A4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    //Center title date
                    $objPHPExcel->getActiveSheet(6)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(6)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title quantity
                    $objPHPExcel->getActiveSheet(6)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(6)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title time
                    $objPHPExcel->getActiveSheet(6)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(6)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(6)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            //Exec query sql and save in variable php
            $qry = "SELECT start_date AS fecha, COUNT(start_date) AS cantidad_llamadas, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) AS tiempo_total FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY start_date ORDER BY start_date ASC;";
            
            $result = mysql_query ($qry, $conexion);

            $y=6;
            
            while($Reg = mysql_fetch_array($result))

            {     
                $objPHPExcel->setActiveSheetIndex(6)
                            ->setCellValue('A'.$y,$Reg['fecha'])
                            ->setCellValue('B'.$y,$Reg['cantidad_llamadas'])
                            ->setCellValue('C'.$y,$Reg['tiempo_total']);

                $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                $objPHPExcel->getActiveSheet(6)->getStyle("A".$y)->getFont()->setSize(8);
                $objPHPExcel->getActiveSheet(6)->getStyle("B".$y)->getFont()->setSize(8);
                $objPHPExcel->getActiveSheet(6)->getStyle("C".$y)->getFont()->setSize(8);

                $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');

                $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
                $y=$y+1;
            }
        
        // PAGINA 8
        // GRAFICO CANTIDAD LLAMADAS SALIENTES POR DIA
        $objPHPExcel->createSheet(NULL, 7);
        $objPHPExcel->setActiveSheetIndex(7);
        $objPHPExcel->getActiveSheet()->setTitle("OUT_por_dia_chart");

        // char bar - cantidad llamadas entrantes por dia

        // create sheet for pie charts 
        $objWorksheet = $objPHPExcel->getActiveSheet(7);

        //  Set the Labels for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker

        $dataSeriesLabels2 = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'OUT_por_dia!$B$5:$B$5', NULL, 1), // quantity
        );

        //  Set the X-Axis Labels
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $xAxisTickValues = array(
        new PHPExcel_Chart_DataSeriesValues('String', 'OUT_por_dia!$A$6:$A$'.$y, NULL, 12), // date
        );

        //  Set the Data values for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $dataSeriesValues1 = array(
        new PHPExcel_Chart_DataSeriesValues('Number', 'OUT_por_dia!$B$6:$B$'.$y, NULL, 12), // values quantity
        );

        //  Build the dataseries
        $series1 = new PHPExcel_Chart_DataSeries(
           PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
           PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  // plotGrouping
           range(0, count($dataSeriesValues1)-1),          // plotOrder
           $dataSeriesLabels1,                             // plotLabel
           $xAxisTickValues,                               // plotCategory
           $dataSeriesValues1                              // plotValues
           );

        //  Set additional dataseries parameters
        //  Make it a vertical column rather than a horizontal bar graph
        $series1->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

        //  Set the series in the plot area
        $plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series1));
        //  Set the chart legend
        $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
        $title = new PHPExcel_Chart_Title('Cantidad de llamadas salientes por dia');

        //  Create the chart
        $chart = new PHPExcel_Chart(
           'chart2',       // name
            $title,         // title
            $legend,        // legend
            $plotArea,      // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel
            );

        //  Set the position where the chart should appear in the worksheet
        $chart->setTopLeftPosition('A1', 24, 24);
        $chart->setBottomRightPosition('M33', -24);

        $objPHPExcel->getActiveSheet(7)->getPageSetup(7)->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        //  Add the chart to the worksheet
        $objWorksheet->addChart($chart);
             
        // PAGINA 9
        // DETALLE LLAMADAS SALIENTES POR TIPO DE TERMINAL - Total de llamadas y duración por Tipo de Sitio     
        $objPHPExcel->createSheet(NULL, 8);
        $objPHPExcel->setActiveSheetIndex(8);
        $objPHPExcel->getActiveSheet()->setTitle("OUT_por_tipo");

         // ajust column
        $objPHPExcel->getActiveSheet(8)
        ->getColumnDimension('A')
        ->setWidth(30);

        // size font
        $objPHPExcel->getActiveSheet(8)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("C5:C5")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(8)
                    // title
                    ->mergeCells('A2:C2')
                    ->setCellValue('A2','LlAMADAS SALIENTES POR TIPO DE TERMINAL')
                    // sub-title
                    ->mergeCells('A4:C4')
                    ->setCellValue('A4','Total de llamadas y duracion por Tipo de sitio')
                    // title site
                    ->mergeCells('A5:A5')   
                    ->setCellValue('A5','Tipo Sitio')
                    // title quantity
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Cantidad')
                    // name time
                    ->mergeCells('C5:C5')
                    ->setCellValue('C5','Tiempo');

                    // center title totals salientes for tipe of terminal
                    $objPHPExcel->getActiveSheet(8)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(8)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                    // center title totals calls and duration for tipe of site
                    $objPHPExcel->getActiveSheet(8)->mergeCells('A4:C4');
                    $objPHPExcel->getActiveSheet(8)->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('A4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    // center title type site
                    $objPHPExcel->getActiveSheet(8)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(8)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    // center title quantity
                    $objPHPExcel->getActiveSheet(8)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(8)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    // center title time
                    $objPHPExcel->getActiveSheet(8)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(8)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    // aply colors a cell       
                    $objPHPExcel->getActiveSheet(8)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    // bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

        // exec query sql and save in variable php
        $qry = "SELECT endpoint_type, COUNT(endpoint_type) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY endpoint_type;";
        
        $result = mysql_query ($qry, $conexion);

        $y=6;

        while($Reg = mysql_fetch_array($result))

        {
            $endpoint_type = $Reg['endpoint_type'];
            if($endpoint_type == " "){
                $endpoint_type = "Software";
            }elseif($endpoint_type == "user:terminal"){
                $endpoint_type = "Terminal";
            }

            $objPHPExcel->setActiveSheetIndex(8)
                        ->setCellValue('A'.$y,$Reg['endpoint_type'])
                        ->setCellValue('B'.$y,$Reg['cantidad'])
                        ->setCellValue('C'.$y,$Reg['tiempo']);
                        
            $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet(8)->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(8)->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(8)->getStyle("C".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet(8)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');

            $objPHPExcel->getActiveSheet(8)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $y=$y+1;
        }

        // create sheet for pie charts 
        $objWorksheet = $objPHPExcel->getActiveSheet(8);

        // grafico pie pagina 4 - llamadas entrantes por tipo de terminal

            // set the Labels for each data series we want to plot
            $dataSeriesLabels1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'OUT_por_tipo!$A$5', NULL, 1),        // tipo sitio
            );
            // set the X-Axis Labels
            $xAxisTickValues1 = array(new PHPExcel_Chart_DataSeriesValues('String', 'OUT_por_tipo!$A$6:$A$8', NULL, 4),    // values tipo de sitio
            );
            // set the Data values for each data series we want to plot
            $dataSeriesValues1 = array(new PHPExcel_Chart_DataSeriesValues('Number', 'OUT_por_tipo!$B$6:$B$8', NULL, 4),); // values cantidad
            // build the dataseries
            $series1 = new PHPExcel_Chart_DataSeries(
            PHPExcel_Chart_DataSeries::TYPE_PIECHART,               // plotType
            NULL,                                                   // plotGrouping
            range(0, count($dataSeriesValues1)-1),                  // plotOrder
            $dataSeriesLabels1,                                     // plotLabel
            $xAxisTickValues1,                                      // plotCategory
            $dataSeriesValues1                                      // plotValues
            );
            // set up a layout object for the Pie chart
            $layout1 = new PHPExcel_Chart_Layout();
            $layout1->setShowVal(TRUE);
            $layout1->setShowPercent(TRUE);
            // set the series in the plot area
            $plotArea1 = new PHPExcel_Chart_PlotArea($layout1, array($series1));
            // set the chart legend
            $legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
            $title1 = new PHPExcel_Chart_Title('Cantidad de llamadas por tipo de terminal'); 
            // create the chart
            $chart1 = new PHPExcel_Chart(
            'chart1',       // name
            $title1,        // title
            $legend1,       // legend
            $plotArea1,     // plotArea
            true,           // plotVisibleOnly
            0,              // displayBlanksAs
            NULL,           // xAxisLabel
            NULL            // yAxisLabel       - Pie charts don't have a Y-Axis
            );
            // set the position where the chart should appear in the worksheet
            $chart1->setTopLeftPosition('A10');
            $chart1->setBottomRightPosition('E30');
            // add the chart to the worksheet
            $objWorksheet->addChart($chart1);

        // PAGINA 10
        // DETALLE LLAMADAS SALIENTES POR SITIO - Total de llamadas y duración por Sitio        
        $objPHPExcel->createSheet(NULL, 9);
        $objPHPExcel->setActiveSheetIndex(9);
        $objPHPExcel->getActiveSheet()->setTitle("OUT_por_sitio");

        //Ajust column
        $objPHPExcel->getActiveSheet(9)
        ->getColumnDimension('A')
        ->setWidth(38);
        
        //Font size
        $objPHPExcel->getActiveSheet(8)->getStyle("A2:C2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("A4:A4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("A5:A5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(8)->getStyle("C5:C5")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(9)
                    //Title
                    ->mergeCells('A2:C2')
                    ->setCellValue('A2','LlAMADAS SALIENTES POR SITIO')
                    //Sub-title
                    ->mergeCells('A4:A4')
                    ->setCellValue('A4','Total de llamadas y duracion por sitio')
                    //Title vacio
                    ->mergeCells('B4:B4')   
                    ->setCellValue('B4','')
                    //Title vacio
                    ->mergeCells('C4:C4')
                    ->setCellValue('C4','')
                    //Name site 
                    ->mergeCells('A5:A5')
                    ->setCellValue('A5','Nombre Sitio')
                    //Title quantity
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Cantidad')
                    //Title time
                    ->mergeCells('C5:C5')
                    ->setCellValue('C5','Tiempo');

                    //Center title calls entry for site
                    $objPHPExcel->getActiveSheet(9)->mergeCells('A2:C2');
                    $objPHPExcel->getActiveSheet(9)->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title total calls and duration for site
                    $objPHPExcel->getActiveSheet(9)->mergeCells('A4:A4');
                    $objPHPExcel->getActiveSheet(9)->getStyle('A4:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('A4:A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:A4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:A4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title vacio
                    $objPHPExcel->getActiveSheet(9)->mergeCells('B4:B4');
                    $objPHPExcel->getActiveSheet(9)->getStyle('B4:B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('B4:B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title vacio
                    $objPHPExcel->getActiveSheet(9)->mergeCells('C4:C4');
                    $objPHPExcel->getActiveSheet(9)->getStyle('C4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('C4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C4:C4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C4:C4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title name site
                    $objPHPExcel->getActiveSheet(9)->mergeCells('A5:A5');
                    $objPHPExcel->getActiveSheet(9)->getStyle('A5:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title quantity
                    $objPHPExcel->getActiveSheet(4)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(4)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title time
                    $objPHPExcel->getActiveSheet(9)->mergeCells('C5:C5');
                    $objPHPExcel->getActiveSheet(9)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                   
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(9)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                   
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                   
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

        //Exec query sql and save in variable php
        $qry = "SELECT name, count(name) as cantidad, SEC_TO_TIME(SUM(TIME_TO_SEC(call_duration))) as tiempo from dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info not like 'Fail%' GROUP BY name ORDER BY cantidad DESC;";
        
        $result = mysql_query ($qry, $conexion);

        $y=6;
        
        while($Reg = mysql_fetch_array($result))

        {    

            $objPHPExcel->setActiveSheetIndex(9)
                        ->setCellValue('A'.$y,$Reg['name'])
                        ->setCellValue('B'.$y,$Reg['cantidad'])
                        ->setCellValue('C'.$y,$Reg['tiempo']);
                        
            $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet(8)->getStyle("A".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(8)->getStyle("B".$y)->getFont()->setSize(8);
            $objPHPExcel->getActiveSheet(8)->getStyle("C".$y)->getFont()->setSize(8);

            $objPHPExcel->getActiveSheet(8)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');

            $objPHPExcel->getActiveSheet(8)->getStyle('C'.$y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $y=$y+1;

        }
        
        // PAGINA 11
        // DETALLE DE EXPERIENCIA POR SITIO SALIENTES - QoE - Calidad de la Experiencia             
        $objPHPExcel->createSheet(NULL, 10);
        $objPHPExcel->setActiveSheetIndex(10);
        $objPHPExcel->getActiveSheet()->setTitle("OUT_QOE");

        //Ajustar columna
        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('A')
        ->setWidth(27);    
        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('B')
        ->setWidth(10); 
        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('C')
        ->setWidth(10);
        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('D')
        ->setWidth(10);
        $objPHPExcel->getActiveSheet(10)
        ->getColumnDimension('E')
        ->setWidth(10);
        
        //Size font
        $objPHPExcel->getActiveSheet(5)->getStyle("A2:E2")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A4:C4")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("A5:A6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B5:B5")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("C5:C6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("D5:D6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("E5:E6")->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet(5)->getStyle("B6:B6")->getFont()->setSize(8);

        $objPHPExcel->setActiveSheetIndex(10)
                    //Title
                    ->mergeCells('A2:E2')
                    ->setCellValue('A2','DETALLE DE EXPERIENCIA POR SITIO SALIENTES')
                    //Sub-title
                    ->mergeCells('A4:E4')
                    ->setCellValue('A4','QoE - Calidad de la Experiencia')
                    //Name site
                    ->mergeCells('A5:A6')   
                    ->setCellValue('A5','Nombre de sitio')
                    //Title sumatory rx
                    ->mergeCells('B5:B5')
                    ->setCellValue('B5','Sumatoria')
                    //Sub-title sumatory rx
                    ->mergeCells('B5:B5')
                    ->setCellValue('B6','Packet Lost RX')
                    //Title Promedio rx
                    ->setCellValue('C5','Promedio %')
                    //Sub-title promedio rx
                    ->setCellValue('C6','Packet Lost RX')
                    //Title sumatory tx
                    ->setCellValue('D5','Sumatoria')
                    //Sub-title sumatory tx
                    ->setCellValue('D6','Packet Lost TX')
                    //Title promedio tx
                    ->setCellValue('E5','Promedio %')
                    //Sub-title promedio tx
                    ->setCellValue('E6','Packet Lost TX');

                    //Center title detalle de experienciea por sitio salientes
                    $objPHPExcel->getActiveSheet(10)->mergeCells('A2:E2');
                    $objPHPExcel->getActiveSheet(10)->getStyle('A2:E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('A2:E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title Quality of the experience
                    $objPHPExcel->getActiveSheet(10)->mergeCells('A4:E4');
                    $objPHPExcel->getActiveSheet(10)->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A4:E4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title site name
                    $objPHPExcel->getActiveSheet(10)->mergeCells('A5:A6');
                    $objPHPExcel->getActiveSheet(10)->getStyle('A5:A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('A5:A6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(10)->mergeCells('B5:B5');
                    $objPHPExcel->getActiveSheet(5)->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('B5:B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(10)->getStyle('B6:B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('B6:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title packet lost rx
                    $objPHPExcel->getActiveSheet(10)->getStyle('C5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(5)->getStyle('C5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C5:C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(10)->getStyle('C6:C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('C6:C6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(10)->getStyle('D5:D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('D5:D5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('D5:D5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('D5:D5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title sumatory
                    $objPHPExcel->getActiveSheet(10)->getStyle('D6:D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('D6:D6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('D6:D6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('D6:D6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(10)->getStyle('E5:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('E5:E5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('E5:E5')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('E5:E5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 

                    //Center title promedio %
                    $objPHPExcel->getActiveSheet(10)->getStyle('E6:E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    //Aply colors a cell       
                    $objPHPExcel->getActiveSheet(10)->getStyle('E6:E6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
                    
                    //Bold
                    $objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getFont()->setBold(true);
                    
                    /** Borders for heading */
                    $objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 


        //Exec query sql and save value in variable php         
        $qry = "SELECT name, SUM(avg_packets_lost_rx), AVG(avg_percent_packeT_loss_rx), SUM(avg_packets_lost_tx),AVG(avg_percent_packet_loss_tx) FROM dbpolycom.tbdata WHERE call_direction = 'OUTGOING' AND disconnect_info NOT LIKE 'Fail%' GROUP BY NAME;";
        
        $result = mysql_query ($qry, $conexion);

        $y=7;  

        while($Reg = mysql_fetch_array($result))
        {

            $objPHPExcel->setActiveSheetIndex(10)
                        ->setCellValue('A'.$y,$Reg['name'])
                        ->setCellValue('B'.$y,$Reg['SUM(avg_packets_lost_rx)'])
                        ->setCellValue('C'.$y,$Reg['AVG(avg_percent_packeT_loss_rx)'])
                        ->setCellValue('D'.$y,$Reg['SUM(avg_packets_lost_tx)'])
                        ->setCellValue('E'.$y,$Reg['AVG(avg_percent_packet_loss_tx)']);
                        
            $objPHPExcel->getActiveSheet()->getStyle('A'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$y)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet(10)->getStyle("A".$y)->getFont()->setSize(8); 
            $objPHPExcel->getActiveSheet(10)->getStyle("B".$y)->getFont()->setSize(8); 
            $objPHPExcel->getActiveSheet(10)->getStyle("C".$y)->getFont()->setSize(8); 
            $objPHPExcel->getActiveSheet(10)->getStyle("D".$y)->getFont()->setSize(8); 
            $objPHPExcel->getActiveSheet(10)->getStyle("E".$y)->getFont()->setSize(8); 

            $objPHPExcel->getActiveSheet(10)->getStyle('C'.$y)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet(10)->getStyle('E'.$y)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            $objPHPExcel->getActiveSheet(10)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');
            $objPHPExcel->getActiveSheet(10)->getStyle('B'.$y)->getNumberFormat()->setFormatCode('[black][>=3000]#,##0;[Red][<0]#,##0;#,##0');



             $y=$y+1;

         }       

        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);

    //########### SEND HEADERS ################ 
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="New_Reporte.xls"');
    header('Cache-Control: max-age=0');

    //$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->setIncludeCharts(TRUE);
    $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
    $objWriter->save('php://output');
    exit;
}

?>