<?php
class WebUser extends CWebUser {
	
	private $_model = null;
	
	public $loginUrl = array (
			'/UserCenter/login/login' 
	);
	public function getRole() {
		if ($user = $this->getModel ()) {
			return $user->role;
		} else {
			return User::ROLE_GUEST;
		}
	}
	public static function setRole($role) {
		self::$_role = $role;
	}
	public function isRootRole() {
		if ($user = $this->getModel ()) {
			return $user->isRootRole ();
		}
	}
	public function getModel() {
		if (! $this->isGuest && $this->_model === null) {
			$this->_model = User::model ()->findByPk ( $this->id );
		}
		
		return $this->_model;
	}
	public function checkAccess($auth_item_name, $params = array(), $allow_caching = true) {
		return true;
		if (Yii::app ()->user->isRootRole ())
			return true;
		
		$auth_item = AuthItem::model ()->findByPk ( $auth_item_name );
		if ($auth_item && $auth_item ['allow_for_all']) {
			return true;
		}
		
		return parent::checkAccess ( $auth_item_name, $params, $allow_caching );
	}
	public function __get($attribute) {
		try {
			return parent::__get ( $attribute );
		} catch ( CException $e ) {
			$model = $this->getModel ();
			if ($model) {
				return $model->__get ( $attribute );
			} else {
				throw $e;
			}
		}
	}
	
	/**
	 * 获取个人信息
	 */
	public function getProfile(){
		$id = $this -> id;
		if($id)
			return UserProfile::model()->findAllByPk($id);
		return false;
	}
	
	/**
	 * 返回用户是否报名
	 *
	 * @param int $uid        	
	 */
	public function isBooked($uid = false) {
		if (! $uid) {
			$uid = $this->getModel ()->id;
		}
		if (! $uid)
			return false;
		$user = User::model ()->findByPk ( $uid );
		
		if (! $user)
			return false;
		$model = UserBooked::model ()->findByAttributes ( array (
				'UID' => $user->id 
		) );
		
		if ($model)
			return $model->attributes;
		return false;
	}
}
