<?php
class AdminModule extends CWebModule {
	public $defaultContoller = 'main';
	
	public $layout = 'admin';
	
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
			$controller -> layout = 'admin';
			// this method is called before any module controller action is
			// performed
			// you may place customized code here
			return true;
		} else
			return false;
	}
}
