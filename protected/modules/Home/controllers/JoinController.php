<?php
class JoinController extends Controller {
	public function actionMain() {
		$model = News::model ();
		$data = $model->findByAttributes ( array (
				'category' => 16 
		) );
		
		$this->render ( 'main', array (
				'data' => $data 
		) );
	}
}