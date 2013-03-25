<?php
class MainController extends Controller {
	public function actionIndex() {
		$slider_model = Slider::model ();
		$dataProvider = $slider_model->search ();
		
		// ar_dump($slider_model);
		// ie;
		
		$img = array ();
		
		// ar_dump(Yii::app() -> params -> imgAccessPath);
		// ie;
		
		foreach ( $dataProvider->data as $_model ) {
			$img [] = (Yii::app ()->params->imgAccessPath . $_model->img);
		}
		
		$this->render ( 'main', array (
				'img' => $img 
		) );
	}
}