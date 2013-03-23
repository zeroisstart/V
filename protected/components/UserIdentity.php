<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=User::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validateMd5Password($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * 
	 */
	public function getErrMsg(){
		switch($this->errorCode){
			case self::ERROR_USERNAME_INVALID:
				return '用户名不存在!';
				break;
			case self::ERROR_PASSWORD_INVALID:
				return '密码错误!';	
				break;
			default :
				return true;
				break;
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see CUserIdentity::getId()
	 */
	public function getId(){
		return $this -> _id;
	}
	
	
	
}