<?php

class MainController extends Controller
{
	public $defaultAction = 'main';
	
	public function actionMain()
	{
		$this->render('main');
	}

}