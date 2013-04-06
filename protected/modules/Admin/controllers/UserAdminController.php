<?php
class UserAdminController extends Controller {
	public $layout = 'admin';
	public $title = '用户信息管理';
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
		
		// data = $dataProvider -> data;
		// row = end($data);
		// ar_dump($row);
		// ar_dump($row->userProfile->userCategory);
		// ar_dump($data);
		// ie;
		
		$this->render ( 'list', $ary );
	}
	/**
	 *
	 * @param int $id        	
	 */
	public function actionUpdate($id) {
		$model = User::model ();
		$model = $model->findByPk ( $id );
		if ($model) {
			if (isset ( $_POST ['id'] )) {
				$model->password = md5 ( '123456' );
				$model->save ();
			}
			$this->render ( 'update', array (
					'model' => $model 
			) );
		} else {
			$this->run ( 'list' );
		}
	}
	/**
	 *
	 * @param int $id        	
	 */
	public function actionView($id) {
		$model = false;
		if ($id) {
			$user_info_model = User::model ();
			$user_info_model->findByPk ( $id );
			if ($user_info_model) {
				var_dump ( $user_info_model );
			}
			die ();
		}
		if ($model)
			$this->render ( 'view' );
		else {
			$url = $this->createUrl ( '/Admin/UserAdmin/list' );
			header ( "Location:$url" );
		}
	}
	public function actionDelete($id) {
		$this->render ( 'delete' );
	}
}