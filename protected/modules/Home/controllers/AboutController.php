<?php
class AboutController extends Controller {
	public function actionMain() {
		
		
		$req = Yii::app() -> request;
		
		$id = $req -> getParam('id');
		
		$model = News::model ();
		
		$data = false;
		if($id){
			$data = $model -> findByPk($id);	
		}
		
		if($data){
			
		}else{
			//20 关于
			/*$data = $model->findByAttributes ( array (
					'category' => 20
			) );*/
			$data = $model -> findByPk(18);
		}
		
		$this->render ( 'main', array (
				'data' => $data 
		) );
	}
}