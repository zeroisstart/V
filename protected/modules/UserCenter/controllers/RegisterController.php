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
		
		// collect user input data
		if (isset ( $_POST ['RegisterForm'] )) {
			$model->setAttributes ( $_POST ['RegisterForm'], false );
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->register ()) {
				Yii::app ()->user->setFlash ( 'success', '注册成功!' );
				$this->redirect ( $this->createUrl ( '/' ) );
			}
			// $this->redirect ( Yii::app ()->user->returnUrl );
		}
		
		$this->render ( 'register', array (
				'model' => $model,
				'profileModel' => $profileModel 
		) );
	}
}