<?php
class ExportController extends Controller {
	/**
	 *
	 * @var string
	 */
	public $defaultAction = 'main';
	
	/**
	 *
	 * @var string
	 */
	public $layout = 'admin';
	
	/**
	 */
	public function actionMain() {
		Yii::import ( 'application.libs.phpexcel.Classes.PHPExcel' );
		
		
		#error_reporting ( E_ALL );
		
		/**
		 * Include path *
		 */
		// ni_set ( 'include_path', ini_get ( 'include_path' ) . ';/Classes/' );
		
		/**
		 * PHPExcel
		 */
		
		/**
		 * PHPExcel_Writer_Excel2007
		 */
		// nclude 'PHPExcel/Writer/Excel2007.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel ();
		
		// Set properties
		#echo date ( 'H:i:s' ) . " Set properties\n";
		$objPHPExcel->getProperties ()->setCreator ( "Maarten Balliauw" );
		$objPHPExcel->getProperties ()->setLastModifiedBy ( "Maarten Balliauw" );
		$objPHPExcel->getProperties ()->setTitle ( "Office 2007 XLSX Test Document" );
		$objPHPExcel->getProperties ()->setSubject ( "Office 2007 XLSX Test Document" );
		$objPHPExcel->getProperties ()->setDescription ( "Test document for Office 2007 XLSX, generated using PHP classes." );
		
		// Add some data
		#echo date ( 'H:i:s' ) . " Add some data\n";
		$sheet = $objPHPExcel->setActiveSheetIndex ( 0 );
		$objPHPExcel->getActiveSheet ()->SetCellValue ( 'B2', 'world!' );
		$objPHPExcel->getActiveSheet ()->SetCellValue ( 'A1', 'Hello' );
		$objPHPExcel->getActiveSheet ()->SetCellValue ( 'C1', 'Hello' );
		$objPHPExcel->getActiveSheet ()->SetCellValue ( 'D2', 'world!' );
		$objPHPExcel->getActiveSheet ()->SetCellValue ( 'E1', '中文' );
		$objPHPExcel->getActiveSheet ()->setTitle ( 'Simple' );
		$a1 = $sheet->getCell ( "A1" );
		$sheet->getStyle ( 'A1' )->getFont ()->getColor ()->setARGB ( PHPExcel_Style_Color::COLOR_BLUE );
		
		$a1->getHyperlink ()->setUrl ( "sheet://'3'!A1" );
		
		$a2 = $sheet->getCell ( "A1" );
		$a2->getHyperlink ()->setUrl ( "sheet://'2'!A1" );
		
		$sheet1 = $objPHPExcel->createSheet ( 1 );
		$sheet1->SetCellValue ( 'A1', 'Hello' );
		$sheet1->SetCellValue ( 'B2', 'world!' );
		$sheet1->SetCellValue ( 'C1', 'Hello' );
		$sheet1->SetCellValue ( 'D2', 'world!' );
		$sheet1->setTitle ( '2' );
		
		$sheet1 = $objPHPExcel->createSheet ( 1 );
		$sheet1->SetCellValue ( 'A1', 'Hello' );
		$sheet1->SetCellValue ( 'B2', 'world!' );
		$sheet1->SetCellValue ( 'C1', 'Hello' );
		$sheet1->SetCellValue ( 'D2', 'world!' );
		$sheet1->setTitle ( '3' );
		
		// Rename sheet
		#echo date ( 'H:i:s' ) . " Rename sheet\n";
		
		// Save Excel 2007 file
		#echo date ( 'H:i:s' ) . " Write to Excel2007 format\n";
		
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		
		header("Content-Disposition: attachment; filename=\"test.xls\"");
		
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
		/*
		$objWriter = new PHPExcel_Writer_Excel2007 ( $objPHPExcel );
		#$objWriter ->
		$objWriter->save ( str_replace ( '.php', '.xlsx', __FILE__ ) );
		die ();
		// Echo done
		echo date ( 'H:i:s' ) . " Done writing file.\r\n";*/
	}
	
	/**
	 */
	public function actionGrade() {
	}
}