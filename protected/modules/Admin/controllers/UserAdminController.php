<?php
/**
 * 
 * @author Top
 *
 */
class UserAdminController extends Controller {
	public $layout = 'admin';
	public $title = '用户信息管理';
	public function actionCreate() {
		$model = new RegisterForm ();
		
		$profileModel = new UserProfile ();
		// $profileModel = new
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'register-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		// collect user input data
		if (isset ( $_POST ['RegisterForm'] )) {
			$model->setAttributes ( $_POST ['RegisterForm'], false );
			$model->allowRegister = true;
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->register ()) {
				// ii::app ()->user->setFlash ( 'success', '注册成功!' );
				$this->redirect ( $this->createUrl ( '/Admin/UserAdmin/list', array (
						't' => 2 
				) ) );
			} else {
				/*var_dump ( $model->errors );*/
			}
			// $this->redirect ( Yii::app ()->user->returnUrl );
		}
		
		
		//地区
		$Competition = CompetitionRegion::model();
		
		$criteria = new CDbCriteria();
		$criteria -> order ="cate desc";
		$data = $Competition -> findAll($criteria);
		$ary_cate = array();
		foreach($data as $_model){
			$ary_cate [$_model -> cate][] = $_model -> attributes;
		}
		$ary_area_json = CJavaScript::encode($ary_cate);
		
		$this->render ( 'create', array (
				'model' => $model,
				'area_list_joson'=>$ary_area_json,
		) );
	}
	
	public function actioncreateadmin(){
		$model = new RegisterForm ();
		
		$profileModel = new UserProfile ();
		// $profileModel = new
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'register-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		// collect user input data
		if (isset ( $_POST ['RegisterForm'] )) {
			$model->setAttributes ( $_POST ['RegisterForm'], false );
			$model->allowRegister = true;
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->register ()) {
				// ii::app ()->user->setFlash ( 'success', '注册成功!' );
				$this->redirect ( $this->createUrl ( '/Admin/UserAdmin/list', array (
						't' => 9
				) ) );
			} else {
				/*var_dump ( $model->errors );*/
			}
			// $this->redirect ( Yii::app ()->user->returnUrl );
		}
		
		//地区
		$Competition = CompetitionRegion::model();
		
		$criteria = new CDbCriteria();
		$criteria -> order ="cate desc";
		$data = $Competition -> findAll($criteria);
		$ary_cate = array();
		foreach($data as $_model){
			$ary_cate [$_model -> cate][] = $_model -> attributes;
		}
		
		$ary_area_json = CJavaScript::encode($ary_cate);
		
		$this->render ( 'create', array (
				'admin' =>true,
				'model' => $model,
				'area_list_joson'=>$ary_area_json,
		) );
	}
	
	
	public function actionCreateArea(){
		#$string ="广东省、广西省、海南省、香港特别行政区、澳门特别行政区";
		#$id = 7;
		#$ary_data = explode('、', $string);
		#foreach($ary_data as $name){
	#		$com = new CompetitionRegion();
#			$com -> attributes = array('id'=>NULL,'cate'=>$id,'name'=>$name);
#			$com -> save();#
	#	}
#		var_dump($ary_data);  #
		#echo "TEST";
		#die;
		#$ary= array();
		#$this->render ( 'area_list', $ary );
	}
	
	
	public function actionListArea(){
		$ary= array();
		$this->render ( 'area_list', $ary );
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