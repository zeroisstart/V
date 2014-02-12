<?php
class MainController extends Controller {
	public function actionIndex() {
		
		//$this -> redirect($this -> createUrl('/forum'));
		
		
		$cdbcriteria = new CDbCriteria ();
		$cdbcriteria->compare ( 'category', 19 );
		$cdbcriteria->limit = 10;
		$cdbcriteria->order = "create_time desc";
		
		$news = News::model ()->findAll ( $cdbcriteria );
		
		$slider_model = Slider::model ();
		$dataProvider = $slider_model->search ();

		// header("Location:/V/admin");
		
		// var_dump($slider_model);
		// die;
		
		// $user = Yii::app() ->user;
		
		// var_dump($user -> name);
		
		// var_dump($user-> id);
		
		//$img = array ();
		//Yii::app() -> user -> setFlash('success','注册成功!');
		#var_dump(Yii::app() -> params -> imgAccessPath);
		#die;
		
		foreach ( $dataProvider->data as $_model ) {
			$img [] = (Yii::app ()->params->imgAccessPath . 'img/' . $_model->img);
		}
		
		$left = array_slice($news, 0,5);
		$right = array_slice($news, 5,5);
		
		$this->render ( 'main', array (
				'left'=>$left,
				'right'=>$right,
				'img' => $img,
				'news' => $news 
		) );
	}
}