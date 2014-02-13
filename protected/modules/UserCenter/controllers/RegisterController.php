<?php
class RegisterController extends Controller {
	public $defaultAction = 'register';
	public $layout = '//layouts/ea';
	public function actionRegister() {
		if (! Yii::app ()->user->isGuest) {
			$this->redirect ( $this->createUrl ( '/' ) );
		}

		$model = new RegisterForm ();
		$profileModel = new UserProfile ();
		// $profileModel = new
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'register-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		$Competition = CompetitionRegion::model();
		
		$criteria = new CDbCriteria();
		$criteria -> order ="cate desc";
		$data = $Competition -> findAll($criteria);
		$ary_cate = array();
		foreach($data as $_model){
			$ary_cate [$_model -> cate][] = $_model -> attributes;
		}
		$ary_area_json = CJavaScript::encode($ary_cate);
		
		// collect user input data
		if (isset ( $_POST ['RegisterForm'] )) {
			$model->setAttributes ( $_POST ['RegisterForm'], false );
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->register ()) {
				$_identity=new UserIdentity($model->username,$model->password);
				if($_identity->authenticate()){
					Yii::app()->user->login($_identity,0);
					Yii::app ()->user->setFlash ( 'success', '注册成功!' );
				}
				$this->redirect ( $this->createUrl ( '/' ) );
			}
			// $this->redirect ( Yii::app ()->user->returnUrl );
		}
		
		$this->render ( 'register', array (
				'model' => $model,
				'area_list_joson'=>$ary_area_json,
				'profileModel' => $profileModel 
		) );
	}
}