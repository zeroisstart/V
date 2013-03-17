<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel {
	public $username;
	public $password;
	public $password_confirm;
	public $email;
	private $_identity;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules() {
		return array (
				// username and password are required
				array (
						'username, password,password_confirm,email',
						'required' 
				),
				array (
						'username',
						'_isExists' 
				),
				
				array (
						'email',
						'email',
				),
				array('email','_isExistsEmail'),
				array (
						'password',
						'_password_confirm' 
				) 
		);
	}
	
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels() {
		return array (
				'username' => '用户名',
				'password' => '密码',
				'password_confirm' => '重复密码',
				'email' => '邮箱' 
		);
	}
	/**
	 * 返回用户名是否有人注册
	 * 
	 * @param string $_username        	
	 * @return boolean
	 */
	public function _isExists($attribute_name) {
		$user = User::model ();
		if ($user->exists ( 'LOWER(username)=?', array (
				strtolower ( $this->$attribute_name ) 
		) )) {
			$this->addError ( 'username', '用户名已存在' );
			return false;
		} else {
			return true;
		}
	}
	/**
	 * 返回邮箱是否有人注册
	 * 
	 * @param
	 *        	$attribute_name
	 * @return boolean
	 */
	public function _isExistsEmail($attribute_name) {
		$user = User::model ();
		if ($user->exists ( 'LOWER(email)=?', array (
				strtolower ( $this->$attribute_name ) 
		) )) {
			$this->addError ( 'email', '注册邮箱已存在' );
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * 验证两次密码是否正确
	 *
	 * @param string $_password_confirm        	
	 * @return boolean
	 */
	public function _password_confirm($attribute_name) {
		if ($this->password_confirm === $this->$attribute_name)
			return true;
		else {
			$this->addError ( 'password_confirm', '两次密码输入不同' );
			return false;
		}
	}
	
	/**
	 * 注册用户
	 *
	 * @return boolean
	 */
	public function register() {
		$user = new User ();
		$user->username = $this->username;
		$user->password = md5 ( $this->password );
		$user->email = $this->email;
		if ($user->validate ()) {
			$user->save ();
		} else {
			YII_DEBUG && var_dump ( $user->errors );
		}
	}
	
	/**
	 * Logs in the user using the given username and password in the model.
	 *
	 * @return boolean whether login is successful
	 */
	public function login() {
		if ($this->_identity === null) {
			$this->_identity = new UserIdentity ( $this->username, $this->password );
			$this->_identity->authenticate ();
		}
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
			$duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
			Yii::app ()->user->login ( $this->_identity, $duration );
			return true;
		} else
			return false;
	}
}
