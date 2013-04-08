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
		
		/**
		 * Include path *
		 */
		// ini_set ( 'include_path', ini_get ( 'include_path' ) . ';/Classes/'
		// );
		
		$groupModel = UserGroup::model ();
		$groupModels = $groupModel->findAllByAttributes ( array (
				'state' => '1' 
		) );
		
		$ary_group = array ();
		
		$title = '2013全国移动互联网创新大赛';
		
		$ary_title = array (
				'序号',
				'作品类型',
				'作品名称',
				'身份',
				'姓名',
				'单位名称',
				'职务',
				'电话',
				'邮件',
				'身份证号' 
		);
		
		foreach ( $groupModels as $_model ) {
			foreach ( $_model->members as $_member ) {
				$ary_group [$_model->ID] [] = $_member;
			}
		}
		
		foreach ( $ary_group as $group ) {
			foreach ( $group as $g ) {
				// ar_dump($g->attributes->);
				// ar_dump($g->user);
				// ar_dump($g->user->userProfile);
			}
		}
		
		/*
		 * $groupList $groupCriteria = new CDbCriteria(); $groupCriteria ->
		 * compare('is_checked', 1); $groupCriteria -> order = "check_time
		 * desc"; $groupCriteria -> with =array('product'); $groupModels =
		 * $groupModel -> findAll($groupCriteria);
		 */
		
		/**
		 * PHPExcel
		 */
		
		/**
		 * PHPExcel_Writer_Excel2007
		 */
		// include 'PHPExcel/Writer/Excel2007.php';
		
		$objPHPExcel = new PHPExcel ();
		
		$objPHPExcel->getProperties ()->setCreator ( "Maarten Balliauw" );
		$objPHPExcel->getProperties ()->setLastModifiedBy ( "Maarten Balliauw" );
		$objPHPExcel->getProperties ()->setTitle ( "Office 2007 XLSX Test Document" );
		$objPHPExcel->getProperties ()->setSubject ( "Office 2007 XLSX Test Document" );
		$objPHPExcel->getProperties ()->setDescription ( "Test document for Office 2007 XLSX, generated using PHP classes." );
		
		$sheet = $objPHPExcel->setActiveSheetIndex ( 0 );
		
		foreach ( $ary_title as $key => $val ) {
			$key = $this->Integer2Char ( $key ) . '1';
			$objPHPExcel->getActiveSheet ()->SetCellValue ( $key, $val );
		}
		
		$start = 2;
		foreach ( $ary_group as $key => $group ) {
			
			$c_num = count ( $group );
			//合并B  	'作品类型', '作品名称'
			$b = sprintf("B%d:B%d",$start,$start+$c_num-1);
			$c = sprintf("C%d:C%d",$start,$start+$c_num-1);
			
			$sheet->setCellValue ( 'B' . $start, '文档');
			$objStyle =$sheet -> getStyle('B' . $start);
			$objStyle -> getAlignment() -> setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			
			$groupProduct = UserProductGrade::model()->findByAttributes(array('gid'=>$key));
			
			
			$sheet->setCellValue ( 'C' . $start, $groupProduct -> title);
			$objStyle =$sheet -> getStyle('C' . $start);
			$objStyle -> getAlignment() -> setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			
			$sheet->mergeCells ( $b );
			$sheet->mergeCells ( $c );
			foreach ( $group as $_k => $member ) {
				$sheet->setCellValue ( 'A' . $start, $start+1 );
				
				$sheet->setCellValue ( 'D' . $start, $member -> user->userProfile -> User_category);
				$sheet->setCellValue ( 'E' . $start, $member -> user->userProfile -> Realname );
				$sheet->setCellValue ( 'F' . $start, $member -> user->userProfile -> Company_name);
				/* '职务',
				'电话',
				'邮件',
				'身份证号' */
				$sheet->setCellValue ( 'G' . $start, $member -> user->userProfile -> Company_name);
				$sheet->setCellValueExplicit ( 'H' . $start, $member -> user->userProfile -> Mobile );
				$sheet->setCellValue ( 'I' . $start, $member -> user->userProfile -> Email );
				$sheet->setCellValueExplicit ( 'J' . $start, $member -> user->userProfile -> IDNum,PHPExcel_Cell_DataType::TYPE_STRING );
				$start +=1;
			}
		}
		
		// ie;
		
		// Add some data
		// cho date ( 'H:i:s' ) . " Add some data\n";
		
		$objPHPExcel->getActiveSheet ()->setTitle ( $title );
		
		// a1 = $sheet->getCell ( "A1" );
		// sheet->getStyle ( 'A1' )->getFont ()->getColor ()->setARGB (
		// PHPExcel_Style_Color::COLOR_BLUE );
		
		$sheet->getColumnDimension ( 'A' )->setWidth ( 10 );
		$sheet->getColumnDimension ( 'B' )->setWidth ( 20 );
		$sheet->getColumnDimension ( 'C' )->setWidth ( 20 );
		$sheet->getColumnDimension ( 'D' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'E' )->setWidth ( 15 );
		$sheet->getColumnDimension ( 'F' )->setWidth ( 25 );
		$sheet->getColumnDimension ( 'G' )->setWidth ( 25 );
		$sheet->getColumnDimension ( 'H' )->setWidth ( 20 );
		$sheet->getColumnDimension ( 'I' )->setWidth ( 25 );
		$sheet->getColumnDimension ( 'J' )->setWidth ( 30 );
		
		// $objPHPExcel->getActiveSheet()->mergeCells('A2:A3');
		// $a1->getHyperlink ()->setUrl ( "sheet://'3'!A1" );
		//
		// $a2 = $sheet->getCell ( "A1" );
		// $a2->getHyperlink ()->setUrl ( "sheet://'2'!A1" );
		
		header ( 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
		
		header ( "Content-Disposition: attachment; filename=\"$title.xls\"" );
		
		header ( 'Cache-Control: max-age=0' );
		
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		$objWriter->save ( 'php://output' );
		
		/*
		 * $objWriter = new PHPExcel_Writer_Excel2007 ( $objPHPExcel );
		 * #$objWriter -> $objWriter->save ( str_replace ( '.php', '.xlsx',
		 * __FILE__ ) ); die (); // Echo done echo date ( 'H:i:s' ) . " Done
		 * writing file.\r\n";
		 */
	}
	/**
	 *
	 * @param string $string        	
	 * @return string
	 */
	public function gbk2utf8($string) {
		return mb_convert_encoding ( $string, 'utf-8', 'gbk' );
	}
	/**
	 * 整型转字母
	 *
	 * @param int $num        	
	 * @return string
	 */
	public function Integer2Char($num) {
		$ASCII_A = 65;
		$prefix = floor ( $num / 26 );
		if ($prefix) {
			$prefix = chr ( $ASCII_A + $prefix - 1 );
		}
		$prefix = $prefix ? $prefix : '';
		return $prefix . chr ( $ASCII_A + ($num % 26) );
	}
	
	/**
	 */
	public function actionGrade() {
	}
}
