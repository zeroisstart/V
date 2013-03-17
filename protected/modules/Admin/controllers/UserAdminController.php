<?php
class UserAdminController extends Controller {
	
	public $layout ='admin';
	
	public function actionCreate() {
		$this->render ( 'create' );
	}
	
	public function actionList() {
		
		$model = User::model();
		
		if(isset($_POST['User'])){
			$model -> attributes = $_POST['User'];
		}
		
		$dataProvider = $model -> search();
		
		$ary  = array();
		$ary ['model']= $model;
		$ary ['dataProvider'] = $dataProvider;
		
		$this->render ( 'list' ,$ary);
		
	}
	
	public function actionUpdate($id) {
		$this->render ( 'update' );
	}
	
	public function actionView($id) {
		$this->render ( 'view' );
	}
	
	public function actionDelete($id) {
		$this->render ( 'delete' );
	}
}