<?php
class MainController extends Controller {
	public function actionIndex() {
		
		//$this -> redirect($this -> createUrl('/forum'));
		
		
		$news = News::model();
		//竞赛资讯
		$data19 = $news -> getByCategory(19);
		//承办学校
		$data11 = $news -> getByCategory(11);
		
		//优秀作品展示
		$data12 = $news -> getByCategory(12);
		//合作伙伴
		$data13 = $news -> getByCategory(13);

		//参赛队风采   14
		
		$news = array(13=>$data13,19=>$data19);

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
		
		$slider_model = Slider::model ();
		$dataProvider = $slider_model->search ();
		
		foreach ( $dataProvider -> data as $_model ) {
			$img [] = (Yii::app ()->params->imgAccessPath . 'img/' . $_model->img);
		}
		
		foreach($news as $key => $_val){
			unset($news[$key]);
			$news[$key]['left'] = array_slice($_val, 0,5);
			$news[$key]['right'] = array_slice($_val, 5,5);
		}
		
		$news['11'] = $data11;
		$news['12'] =$data12;
		
		$this->render ( 'main', array (
				'news'=>$news,
				#'left'=>$left,
				#'right'=>$right,
				'img' => $img,
				'news' => $news 
		) );
	}
}