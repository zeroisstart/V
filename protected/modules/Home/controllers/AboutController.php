<?php
class AboutController extends Controller {
	public function actionMain() {
		$model = News::model ();
		
		
		//20 关于
		$data = $model->findByAttributes ( array (
				'category' => 20	 
		) );
		
		$this->render ( 'main', array (
				'data' => $data 
		) );
	}
}