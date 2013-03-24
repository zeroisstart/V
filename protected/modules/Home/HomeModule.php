<?php

class HomeModule extends CWebModule
{
	public $defaultController = 'main';
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'Home.models.*',
			'Home.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$layoutPath = Yii::getPathOfAlias('application.views.layouts');
			$this -> setLayoutPath($layoutPath);
			$controller->layout = 'ea';
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
