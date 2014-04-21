<?php

class InfoController extends Controller
{
	
	public function actionMain()
	{
		
		$news = News::model();
		//竞赛资讯
		$news -> category = 19;
		$news_list = $news -> search();
		
		//var_dump($data19);
		
		$this->render('index',array('news_list'=>$news_list));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}