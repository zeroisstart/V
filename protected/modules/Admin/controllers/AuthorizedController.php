<?php
/**
 * 验证后天的控制器
 * @author Top
 *
 */
class AuthorizedController extends Controller {
	
	/**
	 *
	 * @var string
	 */
	public $layout = 'innovationLogin';
	
	/**
	 */
	public function actionIndex() {
		$this->render ( 'index' );
	}
	
	/**
	 */
	public function actionLogin() {
		
		if (! Yii::app ()->user->isGuest)
			$this->redirect ( $this->createUrl ( '/admin' ) );
		
		$model = new LoginForm ();
		
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'login-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		// collect user input data
		if (isset ( $_POST ['LoginForm'] )) {
			$model->attributes = $_POST ['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->login ())
				$this->redirect ( Yii::app ()->user->returnUrl );
			else {
				/*
				 * $auth_error = array ( 'msg' => $model -> errMsg, );
				 */
			}
		}
		$ary = array ('model' => $model );
		if (isset ( $auth_error ))
			$ary ['auth_error'] = $auth_error;
			
			// display the login form
		$this->render ( 'authLogin', $ary );
	}
	
	public function actionLogout() {
		$user = Yii::app ()->user;
		if (! $user->isGuest) {
			Yii::app ()->user->logout ( true );
			$this->redirect ( $this->createUrl ( '/' ) );
		}
	}
}