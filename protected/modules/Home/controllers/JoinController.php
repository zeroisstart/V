<?php
class JoinController extends Controller {
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
			/*$data = $model->findByAttributes ( array (
					'category' => 19
			) );*/
			
			$data = $model -> findByPk(22);
		}
		
		$this->render ( 'main', array (
				'data' => $data 
		) );
	}
}