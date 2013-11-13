<?php
class JoinController extends Controller {
	public function actionMain() {
		$model = News::model ();
		//19 参赛
		$data = $model->findByAttributes ( array (
				'category' => 19 
		) );
		
		$this->render ( 'main', array (
				'data' => $data 
		) );
	}
}