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
	public $layout = 'adminLogin';
	
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
		
		$url = $this->module->getAssetsUrl ();
		$model = user::model ();
		
		if (isset ( $_POST ['User'] )) {
			$model->attributes = $_POST ['User'];
			if ($model->validate ()) {
				$user_identity = new UserIdentity ( $model->username, $model->password );
				if ($user_identity->authenticate ()) {
					$this->redirect ( $this->createUrl ( '/admin' ) );
					// var_dump(Yii::app() -> user);
					// die;
				} else {
					$auth_error = array (
							'code' => $user_identity->errorCode,
							'msg' => $user_identity->errorMessage 
					);
				}
			} else {
				var_dump ( $model->errors );
			}
		}
		
		$this->render ( 'login', array (
				'model' => $model,
				'auth_error' => isset ( $auth_error ) ? $auth_error : null 
		) );
	}
	public function actionLogout() {
		$user = Yii::app ()->user;
		if (! $user->isGuest) {
			Yii::app ()->user->logout ( true );
			$this->redirect ( $this->createUrl ( '/' ) );
		}
	}
}