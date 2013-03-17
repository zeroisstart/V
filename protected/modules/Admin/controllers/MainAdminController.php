<?php

/**
 * 
 * @author Top
 *
 */
class MainAdminController extends Controller {
	
	/**
	 * 设置默认视图
	 *
	 * @var string
	 */
	public $layout = 'admin';
	public function actionsTitles() {
		return array (
				'index' => '动态信息 ' 
		);
	}
	
	/**
	 */
	public function actionIndex() {
		$user = Yii::app ()->user;
		
		if ($user->isGuest) {
			$this->redirect ( $this->createUrl ( '/admin/login' ) );
		}
		
		$PV_model = Pv::model ();
		$today = $PV_model->todayPV;
		$yesterday = $PV_model->yesterdayPV;
		$thisWeek = $PV_model -> thisWeekPV;
		$lastWeek = $PV_model->lastWeekPV;
		
		$this->render ( 'index', array (
				'user' => $user,
				'todayPV' => $today,
				'thisWeekPV'=>$thisWeek,
				'yesterdayPV' => $yesterday,
				'lastWeekPV' => $lastWeek 
		) );
	}
}