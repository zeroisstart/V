<?php
class UserAdminController extends Controller {
	public $layout = 'admin';
	public function actionCreate() {
		$this->render ( 'create' );
	}
	public function actionList() {
		$model = User::model ();
		
		if (isset ( $_POST ['User'] )) {
			$model->attributes = $_POST ['User'];
		}
		
		$dataProvider = $model->search ();
		
		$ary = array ();
		$ary ['model'] = $model;
		$ary ['dataProvider'] = $dataProvider;
		
		$this->render ( 'list', $ary );
	}
	public function actionUpdate($id) {
		$this->render ( 'update' );
	}
	public function actionView($id) {
		$model = false;
		if($id){
			$user_info_model = User::model();
			$user_info_model -> findByPk($id);
			if($user_info_model){
				var_dump($user_info_model);
			}
			die;
		}
		if($model)
			$this->render ( 'view' );
		else{
			$url = $this -> createUrl('/Admin/UserAdmin/list');
			header("Location:$url");
		} 
	}
	public function actionDelete($id) {
		$this->render ( 'delete' );
	}
}