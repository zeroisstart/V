<?php
class MasterController extends Controller {
	public function actionMain() {
		$req = Yii::app ()->request;
		$id = $req->getParam ( 'id' );
		
		$model = News::model ()->findByPk ( $id );
		
		if (! empty ( $model )) {
			$data = $model->attributes;
			$this->render ( 'view', array (
					'data' => $data,
					'model' => $model 
			) );
		} else {
			
			$model = News::model ();
			$model->category = 18;
			$dataProvider = $model->search ();
			$this->render ( 'main', array (
					'dataProvider' => $dataProvider,
					'model' => $model 
			) );
		}
	}
}