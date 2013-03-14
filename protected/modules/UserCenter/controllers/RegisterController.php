<?php
class RegisterController extends Controller {
	public $defaultAction = 'register';
	public function actionRegister() {
		$model = new RegisterForm ();
		
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'register-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		// collect user input data
		if (isset ( $_POST ['RegisterForm'] )) {
			$model->attributes = $_POST ['RegisterForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->register ()){
				var_dump($model -> attributes);
			}
				//$this->redirect ( Yii::app ()->user->returnUrl );
		}
		
		$this->render ( 'register', array (
				'model' => $model 
		) );
	}
}