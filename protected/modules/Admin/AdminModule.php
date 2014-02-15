<?php
class AdminModule extends CWebModule {
	public $defaultContoller = 'main';
	public function init() {
		
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		
		// import the module-level models and components
		//$this->setImport ( array ('Admin.models.*') );
	}
	public function beforeControllerAction($controller, $action) {
		
		$AdminUser = AdminUser::model(); 
		$uid = Yii::app() -> user -> id;
		if(!$AdminUser -> canAdmin($uid)){
			throw new CHttpException(404);
		}
		
		if (parent::beforeControllerAction ( $controller, $action )) {
			
			$user = Yii::app ()->user;
			$req = Yii::app ()->request;
			
			#if ($user->isGuest) {
			#	header ( 'HTTP/1.1 404 Not Found' );
			#	header ( "status: 404 Not Found" );
			#	die ();
			#}
			// ar_dump($user->model->userProfile->User_category);
			// ie;
			#if ($user->model->userProfile->User_category != 5) {
			#	header ( 'HTTP/1.1 404 Not Found' );
			#	header ( "status: 404 Not Found" );
			#	die ();
			#}
			// this method is called before any module controller action is
			// performed
			// you may place customized code here
			return true;
		} else
			return false;
	}
}
