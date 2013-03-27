<?php
class MainController extends Controller {
	public function actionIndex() {
		$slider_model = Slider::model ();
		$dataProvider = $slider_model->search ();
		
		// header("Location:/V/admin");
		
		// var_dump($slider_model);
		// die;
		
// 		$user = Yii::app() ->user;
		
// 		var_dump($user -> name);
		
// 		var_dump($user-> id);
		
		$img = array ();
		
		// var_dump(Yii::app() -> params -> imgAccessPath);
		// die;
		
		foreach ( $dataProvider->data as $_model ) {
			$img [] = (Yii::app ()->params->imgAccessPath . $_model->img);
		}
		
		$this->render ( 'main', array (
				'img' => $img 
		) );
	}
}