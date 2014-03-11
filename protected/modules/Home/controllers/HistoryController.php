<?php

class HistoryController extends Controller
{
	public function actionMain()
	{
		
		
		$req = Yii::app() -> request;
		
		$id = $req -> getParam('id');
		
		$model = News::model ();
		
		$data = false;
		if($id){
			$data = $model -> findByPk($id);
		}
		
		if($data){
		
		}else{
			/*$data = $model->findByAttributes ( array (
			 'category' => 19
			) );*/
				
			$data = $model -> findByPk(22);
		}
		
		$this->render ( 'main', array (
				'data' => $data
		) );
		
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