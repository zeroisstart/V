<?php
class AdminModule extends CWebModule {
	public $defaultContoller = 'main';
	public function init() {
		
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		
		// import the module-level models and components
		$this->setImport ( array (
				'Admin.models.*',
				'Admin.components.*' 
		) );
	}
	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction ( $controller, $action )) {
			$user = Yii::app ()->user;
			$req = Yii::app ()->request;
			if ($user->isGuest) {
				header ( 'HTTP/1.1 404 Not Found' );
				header ( "status: 404 Not Found" );
				die ();
			}
			#var_dump($user->model->userProfile->User_category);
			#die;
			if ($user->model->userProfile->User_category != 5) {
				header ( 'HTTP/1.1 404 Not Found' );
				header ( "status: 404 Not Found" );
				die ();
			}
			
			// this method is called before any module controller action is
			// performed
			// you may place customized code here
			return true;
		} else
			return false;
	}
}
