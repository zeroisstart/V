<?php

class MainController extends Controller {
	
	public $layout = 'admin';
	
	public $defaultAction = 'main';
	
	public function actionMain() {
		$user = Yii::app ()->user;
		if ($user->isGuest) {
			$this->redirect ( $this->createUrl ( '/admin/login' ) );
		}
		
		$this->render ( 'main' );
	}

}