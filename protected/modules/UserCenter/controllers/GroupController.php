<?php
class GroupController extends Controller {
	public function accessRules() {
		return array (
				array (
						'deny',
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	
	/**
	 *
	 * @var int 
	 */
	public $defaultAction = 'list';
	public function actionAdd() {
		$this->render ( 'add' );
	}
	public function actionCreate() {
		$model = UserGroup::model ();
		
		if (isset ( $_POST ['UserGroup'] )) {
			
			$model->attributes = $_POST ['UserGroup'];
			$model->uid = Yii::app ()->user->id;
			$model->state = 0;
			$model->create_time = date ( 'Y-m-d H:i:s', time () );
			$model -> save();
			
			$model-> members = new UserGroupMember();
			$model-> members ->  uid = Yii::app() -> user -> id;
			$model -> members -> gid = $model -> id;
			$model -> members -> state = 1;
			$model -> members -> create_time =date('Y-m-d H:i:s',time());
			$modle -> members -> save();
			
		}
		
		$ary = array ();
		$ary ['model'] = $model;
		
		$this->render ( 'create', $ary );
	}
	public function actionDelete() {
		$this->render ( 'delete' );
	}
	public function actionList() {
		$model = UserGroup::model ();
		
		if (isset ( $_REQUEST ['UserGroup'] )) {
			$model->attributes = $_REQUEST ['UserGroup'];
		}
		$dataProvider = $model->search ();
		$ary = array ();
		$ary ['dataProvider'] = $dataProvider;
		$ary ['model'] = $model;
		
		$this->render ( 'list', $ary );
	}
	public function actionUpdate() {
		$this->render ( 'update' );
	}
	public function actionView() {
		$this->render ( 'view' );
	}
}