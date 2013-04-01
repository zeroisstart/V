<?php
class LoginController extends Controller {
	public $layout = '//layouts/ea';
	
	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$user = Yii::app ()->user;
		if (! $user->isGuest) {
			$this->redirect ( $this->createUrl ( '/' ) );
		}
		
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
				var_dump ( $mode->erros );
			}
		}
		// display the login form
		$this->render ( 'login', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app ()->user->logout ();
		$this->redirect ( Yii::app ()->homeUrl );
	}
}