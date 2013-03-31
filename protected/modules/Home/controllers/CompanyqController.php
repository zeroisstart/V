<?php
class CompanyqController extends Controller {
	public function actionMain() {
		$current_model = false;
		$req = Yii::app ()->request;
		if ($req->getParam ( 'id' )) {
			$_model = News::model ();
			$id = $req->getParam ( 'id' );
			$_model = $_model->findByPk ( $id );
			if (! empty ( $_model )) {
				$current_model = $_model;
			}
		}
		
		// var_dump($current_model);
		
		$model = News::model ();
		$model->category = 21;
		$dataProvider = $model->search ();
		
		$data = $dataProvider->data;
		
		$ary_title = array ();
		
		foreach ( $data as $key => $model ) {
			$ary_title [] = array (
					'ID' => $model->ID,
					'title' => $model->title 
			);
		}
		$current_model = $current_model ? $current_model : reset ( $data );
		
		$this->render ( 'main', array (
				'dataProvider' => $dataProvider,
				'titles' => $ary_title,
				'current_model' => $current_model,
				'model' => $model 
		) );
	}
}